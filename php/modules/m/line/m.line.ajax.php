<?php


function getvar($type)
{
	_::session()->logged();
	if(_::$my['_id'])
	{
		if($type=='geo')
		{
			$lat = func_get_arg(1);
			$lon = func_get_arg(2);
			$d = @file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lon.'&sensor=false&language=th');
			$s = json_decode($d,true);
			$n = $s['results'][0]['formatted_address'];
			_::ajax()->jquery('#lloc','html','<div><div class="mp">
		 <img src="http://maps.googleapis.com/maps/api/staticmap?center='.$lat.','.$lon.'&markers=color:blue%7Clabel:A%7C'.$lat.','.$lon.'&zoom=15&size=539x150&maptype=roadmap&sensor=false" style="margin:0px">
		<div class="mp-n">'.$n.'</div>
		<input type="hidden" name="latlon" value="'.$lat.','.$lon.'"><input type="hidden" name="geo" value="'.$n.'">
		<a href="javascript:;" onclick="var o=(this.parentNode.parentNode);o.parentNode.removeChild(o);" class="del"><img src="http://s0.boxza.com/static/images/global/del.gif" class="icon"></a> </div></div>');
		}
		elseif($type=='photo')
		{
			$db=_::db();
			if(!$album=$db->findOne('line',array('u'=>_::$my['_id'],'ty'=>'album','lo'=>1),array('tt'=>1,'_id'=>1)))
			{
				$db->insert('line',array('u'=>_::$my['_id'],'tt'=>'รูปภาพบนไลน์','ty'=>'album','lo'=>1,'hi'=>1,'in'=>array(0)));
			}
			$album=$db->find('line',array('u'=>_::$my['_id'],'ty'=>'album','dd'=>array('$exists'=>false)),array('tt'=>1,'_id'=>1),array('sort'=>array('_id'=>1)));
			$tmp='อัลบั้ม: <select name="album" class="tbox">';
			for($i=0;$i<count($album);$i++)
			{
				$tmp.='<option value="'.$album[$i]['_id'].'">'.$album[$i]['tt'].'</option>';
			}
			$tmp.='</select><input type="file" class="tbox" name="photo" id="post_photo" style="width:150px">';
			_::ajax()->jquery('#lphoto','html','<div>'.$tmp.'</div>');
		}
	}
}


function delline($line)
{
	_::session()->logged();
	if(_::$my['_id'])
	{
		$db=_::db();
		if($tmp = $db->findOne('line',array('_id'=>intval($line)),array('_id'=>1,'u'=>1,'s'=>1,'p'=>1,'pt'=>1,'sh'=>1,'ty'=>1,'lo'=>1,'dd'=>1)))
		{
			if(_::$my && !$tmp['lo'] && !$tmp['dd'])
			{
				if($tmp['u']==_::$my['_id']||$tmp['p']==_::$my['_id'])
				{
					$db->update('line',array('_id'=>intval($line)),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())));
					if($tmp['ty']=='album')
					{
						$db->update('line',array('pt.a'=>intval($line),'u'=>_::$my['_id']),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
					}
					if(is_array($tmp['sh']['l']) && count($tmp['sh']['l']))
					{
						#ไม่ต้องลบโพสต์ที่ทำการแชร์ แต่ไม่ต้องแสดงในที่มา
						#$db->update('line',array('_id'=>array('$in'=>$tmp['sh']['l']),'ty'=>'share'),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
					}
					if($tmp['ty']=='album')
					{
						_::ajax()->script('_.line.go("/photos",true);');
					}
					else
					{
						_::ajax()->script('$(".ln-'.$line.'").remove();');
						if($tmp['ty']=='photo')
						{
							_::ajax()->script('_.profile.pt.layout(\'.photos > li\')');
							if($tmp['pt']['a'])
							{
								if($album=$db->findOne('line',array('_id'=>intval($tmp['pt']['a']),'u'=>_::$my['_id'],'ty'=>'album'),array('_id'=>1,'pt'=>1)))
								{
									if(!is_array($album['pt']))$album['pt']=array();
									$album['pt']['c']=max(intval($album['pt']['c'])-1,0);
									if(is_array($album['pt']['f']))
									{
										for($i=0;$i<count($album['pt']['f']);$i++)
										{
											if($album['pt']['f'][$i]['i']==intval($line))
											{
												unset($album['pt']['f'][$i]);
												$album['pt']['l']=max(intval($album['pt']['l'])-1,0);
												break;
											}
										}
									}
									$album['pt']['f']=array_values((array)$album['pt']['f']);
									$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'])));
								}
							}
						}
					}
				}
			}
		}
	}
}

function postshare($arg)
{
	_::session()->logged();
	if(_::$my['_id'])
	{
		$ajax=_::ajax();
		if(_::$my['_id']&&trim($arg['msg'])&&(is_array($arg['to'])||$arg['to']!='')&&$arg['share'])
		{
			$db=_::db();
			if(!is_array($arg['to']))$arg['to']=array($arg['to']);
			if($line=$db->findOne('line',array('_id'=>intval($arg['share'])),array('_id'=>1,'sh'=>1)))
			{
				$insert = array('u'=>_::$my['_id'],'ty'=>'share','sh'=>array('l'=>array(),'c'=>0,'f'=>$line['_id']),'in'=>array(0),'ms'=>trim(mb_substr(str_replace(array('<','>'),array('&lt;','&gt;'),stripslashes($arg['msg'])),0,1024,'utf-8')));
				if($update=_::db()->insert('line',$insert))
				{
					$ajax->alert('ทำการแชร์โพสต์นี้เรียบร้อยแล้ว');
					if(!is_array($line['sh']))
					{
						$line['sh']=array('l'=>array(),'c'=>0,'f'=>0);
					}
					$line['sh']['l'][] = $update;
					$line['sh']['c']++;
					$db->update('line',array('_id'=>$line['_id']),array('$set'=>array('sh'=>$line['sh'])));
					
							
					if(_::$my['sc']['tw'])
					{
						if(_::$my['sc']['tw']['token']&&_::$my['sc']['tw']['secret'])
						{
							for($i=0;$i<count($arg['to']);$i++)
							{
								if($arg['to'][$i]=='tw')
								{
									require(HANDLERS.'twitter/twitteroauth/twitteroauth.php');
									$tw = new TwitterOAuth(_::$config['social']['twitter']['appid'], _::$config['social']['twitter']['secret'], _::$my['sc']['tw']['token'] , _::$my['sc']['tw']['secret']);
									$l=' '.PROTOCOL.'boxza.com/'._::$my['link'].'/line/'.$update;
									$sl = 140-mb_strlen($l,'utf-8');
									$m=trim(stripslashes($arg['msg']));
									$status = ((mb_strlen($m,'utf-8')>$sl?mb_substr($m,0,$sl-3,'utf-8').'...':$m).$l);
									$content = $tw->post('statuses/update', array('status' => $status)); 
									break;
								}
							}
						}
					}
					if(_::$my['sc']['fb'])
					{
						if(_::$my['sc']['fb']['token'])
						{
							require_once(HANDLERS.'facebook/facebook.php');
							$_fb=array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']);
							if($fbupload)$_fb['fileUpload']=true;
							
							$facebook=new facebook($_fb);
							$facebook->setAccessToken(_::$my['sc']['fb']['token']);
							if ($uid=$facebook->getUser())
							{
								$attachment = array('message' => trim(stripslashes($arg['msg'])),'actions' => array(array('name' => _::$my['name'],'link' => 'http://boxza.com/'._::$my['link'])));
								if($update)$attachment['message'].="\n\n".PROTOCOL.'boxza.com/'.($pf?$pf['link']:_::$my['link']).'/line/'.$update;
								for($i=0;$i<count($arg['to']);$i++)
								{
									list($fb,$id)=explode('-',$arg['to'][$i]);
									if($fb=='fb')
									{
										if($id=='me')
										{
										try{
											$facebook->setAccessToken(_::$my['sc']['fb']['token']);
											$facebook->api('/me/'.($fbupload?'photos':'feed'), 'post', $attachment);
											} catch (FacebookApiException $e) {_::ajax()->alert($e->getMessage());}	
										}
									}
								}
							}
						}
					}
				}
			}
		}
		$ajax->script('_.profile.sh.clear();');
	}
}
?>