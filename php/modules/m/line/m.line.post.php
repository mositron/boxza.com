<?php

_::session()->logged();
$arg = $_POST;

if(_::$my['_id']&&trim($arg['msg'])&&(is_array($arg['to'])))
{
	$db=_::db();
	$update=false;
	$_posted=false;
	$insert = array('u'=>_::$my['_id'],'ty'=>'post','ms'=>trim(mb_substr(htmlspecialchars($arg['msg'],ENT_QUOTES,'utf-8'),0,2048,'utf-8')),'rnd'=>rand(0,99),'s'=>1,'ex'=>new MongoDate(time()+_::$config['line_expire'])); // s=1 m
	$ori_msg=trim(mb_substr($arg['msg'],0,2048,'utf-8'));
	$insert['md5']=md5(mb_strtolower(preg_replace('/\s/','',$ori_msg),'utf-8'));
			
	if($arg['profile'])
	{
		if($pf = _::user()->get(intval($arg['profile']),true))
		{
			if($pf['_id']!=_::$my['_id'])
			{
				$insert['p']=$pf['_id'];
				$insert['ty']='private';
			}
			if(!$pf['link'])$pf['link']=$pf['_id'];
		}
	}
	if($arg['latlon'] && trim($arg['geo']))
	{
		list($lat,$lng) = explode(',',$arg['latlon']);
		$insert['lc']=array('n'=>trim($arg['geo']),'l'=>array(floatval($lat),floatval($lng)));
	}
	
	$fbupload=false;
	if(!is_array($arg['to']))$arg['to']=array($arg['to']);
	$insert['in']=array();
	$insert['us']=array();
	$op_to=array();
	for($i=0;$i<count($arg['to']);$i++)
	{
		if(is_numeric($arg['to'][$i]))
		{
			$insert['in'][] = intval($arg['to'][$i]);
			$op_to[] = intval($arg['to'][$i]);
		}
		elseif(substr($arg['to'][$i],0,4)=='uid-')
		{
			if($uid = intval(substr($arg['to'][$i],4)))
			{
				$insert['us'][] = $uid;
			}
		}
		else
		{
			$op_to[] = trim($arg['to'][$i]);
		}
	}
	$insert['in']=array_values(array_unique($insert['in']));
	$insert['us']=array_values(array_unique($insert['us']));
	
	if(count($insert['in']) || count($insert['us']))
	{	
		if(!count($insert['in']))unset($insert['in']);
		if(!count($insert['us']))unset($insert['us']);
		
		$_posted=true;
		
		$hashtag=preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $ori_msg);		
		if(preg_match_all('/#([\p{L}\p{Mn}]+)/u', $hashtag, $matches))
		{
			$hash=array();
			$m = $matches[1];
			$format=_::format();
			for ($i = 0; $i < count($m); $i++) 
			{
				if(($htag=mb_strtolower(trim($m[$i]),'utf-8')) && ($htag==$format->link($htag,false)))
				{
					$hash[]=$htag;
				}
			}
			if(count($hash))
			{
				$hash=array_values(array_unique(array_filter($hash)));
				if(count($hash))
				{
					$insert['hs']=$hash;
					for($k=0;$k<count($hash);$k++)
					{
						$db->update('line_hash',array('_id'=>$hash[$k]),array('$inc'=>array('c'=>1)),array('upsert'=>true));
					}
				}
			}
		}
		
		if($update=_::db()->insert('line',$insert))
		{
			$shorturl='http://boxza.com/l/'.ltrim(_::folder()->fd($update),'0');
				
			if($_FILES['photo']['tmp_name'])
			{
				if($_POST['album'])
				{
					$album=$db->findone('line',array('_id'=>intval($_POST['album']),'u'=>_::$my['_id'],'ty'=>'album'));
				}
				if(!$album)
				{
					$album=$db->findone('line',array('u'=>_::$my['_id'],'ty'=>'album','lo'=>1));
				}
				if($album)
				{
					$size=@getimagesize($_FILES['photo']['tmp_name']);
					$type=false;
					switch (strtolower($size['mime']))
					{
						case 'image/gif':
							$type="gif";
							break;
						case 'image/jpg':
						case 'image/jpeg':
						case 'image/bmp':
						case 'image/wbmp':
							$type="jpg";
							break;
						case 'image/png':
						case 'image/x-png':
							$type="png";
							break;
					}
					if(!$type)
					{
					}
					elseif($size[0]<1||$size[1]<1)
					{
					}
					else
					{
						$fd = _::folder()->fd($update);
						$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
						
						$fbupload=$_FILES['photo']['tmp_name'];
						
						$q=_::upload()->send('s1','line-photo','@'.$_FILES['photo']['tmp_name'],array('type'=>$type,'folder'=>$folder));
						if($q['status']=='OK')
						{
							$status['status']='OK';
							$status['photo']=$update;
							
							if(!$album['lo'])
							{
								if(!is_array($album['pt']))$album['pt']=array('c'=>0,'l'=>0,'f'=>array());
								if($album['ds']->sec > time()-(3600*6))
								{
									$album['pt']['l']+=1;
									$uplast=false;
								}
								else
								{
									$album['pt']['l']=1;
									$uplast=true;
								}
								array_unshift($album['pt']['f'],array('i'=>$update,'f'=>$folder,'e'=>$type,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h']));
								$album['pt']['f']=array_slice($album['pt']['f'],0,5);
								$album['pt']['c']+=1;
								if($uplast)
								{
									$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'],'ds'=>new MongoDate()),'$unset'=>array('hi'=>1)));
								}
								else
								{
									$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt']),'$unset'=>array('hi'=>1)));
								}
								$db->update('line',array('_id'=>$update),array('$set'=>array('ty'=>'photo','hi'=>1,'pt'=>array('a'=>$album['_id'],'e'=>$type,'fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
							}
							else
							{
								$db->update('line',array('_id'=>$update),array('$set'=>array('ty'=>'photo','pt'=>array('a'=>$album['_id'],'e'=>$type,'fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
							}
						}
					}
				}
			}
		}
		if($pf && ($pf['_id']!=_::$my['_id']))
		{
			_::notify()->insert($pf['_id'],'line',$update,$insert['ms']);					
			if(!$pf['op']['em']['ln'])
			{				
				if(!_::db()->findOne('cron_notifications',array('u'=>_::$my['_id'],'p'=>$pf['_id'],'ty'=>'ln','rl'=>$update)))
				{
					_::db()->insert('cron_notifications',array('u'=>_::$my['_id'],'p'=>$pf['_id'],'ty'=>'ln','rl'=>$update,'ms'=>$insert['ms']));
				}
			}
		}
		if(count($op_to))
		{
			_::user()->update(_::$my['_id'],array('$set'=>array('op.to'=>$op_to)));
		}
		if($update && count($insert['us']))
		{
			_::notify()->insert($insert['us'],'line',$update,mb_substr($insert['ms'],0,50,'utf-8'));
		}
		
	}
	if($_posted)
	{
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
						$l='';
						if(is_array($op_to) && in_array('0',$op_to) && $update)
						{
							$l=' '.$shorturl;
						}
						$sl = 140-mb_strlen($l,'utf-8');
						$m=trim($ori_msg);
						if(mb_strlen($m,'utf-8')>$sl)
						{
							$status = mb_substr($m,0,$sl-3,'utf-8').'...'.$l;
						}
						else
						{
							$status = $m.$l;
						}
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
				$facebook->setExtendedAccessToken();
				if ($uid=$facebook->getUser())
				{
					$attachment = array('message' => trim($ori_msg),'actions' => array(array('name' => _::$my['name'],'link' => 'http://boxza.com/'._::$my['link'])));
					if($fbupload)
					{
						if($n = _::photo()->thumb(_::$my['_id'],$fbupload,'bin/tmp',1200,1200,'inboth','jpg'))
						{
							$delmyimg = 'bin/tmp/'.$n;
							$attachment['image'] = '@'.realpath(FILES.$delmyimg);
						}
					}
					if(is_array($op_to)&&in_array('0',$op_to) && $update)
					{
						$attachment['message'] .= "\n\nโพสจาก... ".$shorturl;
					}						
					if($insert['at'])
					{
						if($insert['at']['t'])$attachment['name'] = $insert['at']['t'];
						$attachment['caption'] = $insert['at']['l'];
						$attachment['link'] = $insert['at']['l'];
						if($insert['at']['d'])$attachment['description'] = $insert['at']['d'];
						if($insert['at']['i'])$attachment['picture'] = $insert['at']['i'];
					}
					if($insert['lc'])
					{
						if(!$attachment['name'])$attachment['name'] = 'ที่ '.mb_substr($insert['lc']['n'],0,20,'utf-8').'...';
						if(!$attachment['caption'])$attachment['caption'] = 'boxza.com - Location / Check-in';
						if(!$attachment['link'])$attachment['link'] = 'http://maps.google.com/?q='.$insert['lc']['l'][0].','.$insert['lc']['l'][1];
						if(!$attachment['description'])$attachment['description'] = $insert['geo'];
						if(!$attachment['picture'])$attachment['picture'] = 'http://maps.googleapis.com/maps/api/staticmap?center='.$insert['lc']['l'][0].','.$insert['lc']['l'][1].'&zoom=14&size=90x90&maptype=roadmap&markers='.$insert['lc']['l'][0].','.$insert['lc']['l'][1].'&sensor=false';
					}
					
					
					//$attach['v'] = array('l'=>trim($arg['attach-video']),'t' => trim($arg['attach-video-type']),'w' => trim($arg['attach-video-width']),'h' => trim($arg['attach-video-height']));
					if($attach['v'])
					{
						$attachment['source']=$attach['v']['l'];
					}
					elseif($attach['l'])
					{
						$attachment['source']=$attach['l'];
					}
					//source=http://www.youtube.com/v/3aICB2mUu2k
					
					for($i=0;$i<count($arg['to']);$i++)
					{
						list($fb,$id)=explode('-',$arg['to'][$i]);
						if($fb=='fb')
						{
							if(is_numeric($id))
							{
								$tk=false;
								for($j=0;$j<count(_::$my['sc']['fb']['page']);$j++)
								{
									if($id==_::$my['sc']['fb']['page'][$j]['id'])
									{
										$tk = _::$my['sc']['fb']['page'][$j]['token'];
										break;
									}
								}
								if($tk)
								{
									try{
										$facebook->setAccessToken($tk);
										$facebook->api('/'.$id.'/'.($fbupload?'photos':'feed'), 'post', $attachment);
									} catch (FacebookApiException $e) {_::ajax()->alert($e->getMessage());}	
								}
							}
							elseif($id=='profile' && $pf['sc']['fb'])
							{
							try{
								$facebook->setAccessToken(_::$my['sc']['fb']['token']);
								$facebook->api('/'.$pf['sc']['fb']['id'].'/'.($fbupload?'photos':'feed'), 'post', $attachment);
								} catch (FacebookApiException $e) {_::ajax()->alert($e->getMessage());}	
							}
							elseif($id=='me')
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
	if($delmyimg)
	{
		_::folder()->delete($delmyimg);
	}
}
_::move(URL);


?>