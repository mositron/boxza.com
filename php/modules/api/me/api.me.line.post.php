<?php

_::session()->logged();
$arg = $_POST;
$arg['to']=array_unique(array_map('trim',explode(',',$arg['to'])));
if(_::$my['_id']&&trim($arg['msg'])&&(is_array($arg['to']))&&(in_array("0",$arg['to'])||in_array("-1",$arg['to'])))
{
	$db=_::db();
	$update=false;
	$_posted=false;
	$insert = array('u'=>_::$my['_id'],'ty'=>'post','ex'=>new MongoDate(time()+_::$config['line_expire']),'ms'=>trim(mb_substr(htmlspecialchars($arg['msg'],ENT_QUOTES,'utf-8'),0,2048,'utf-8')),'rnd'=>rand(0,99),'s'=>2); // s=1 mobile, 2=iphone, 3=ipad
	if(isset($arg['ipad'])&&intval($arg['ipad']))
	{
		$insert['s']=3;
	}
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
	
	$fbupload=false;
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
	
	if(_::$my['if']['ha'] || (!_::$my['st']) || (_::$my['st']<1))
	{
		$insert['ha']=1;
	}
	
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
			
			if($arg['photo_base64'])
			{			
				if($img = base64_decode($arg['photo_base64']))
				{
					$im = @imagecreatefromstring($img);
					if ($im !== false)
					{
						$photo_base64=true;
						if(!$album=$db->findone('line',array('u'=>_::$my['_id'],'ty'=>'album','lo'=>1)))
						{
							$album=array('tt'=>'รูปภาพบนไลน์','ty'=>'album','u'=>_::$my['_id'],'lo'=>1,'in'=>array(0),'hi'=>1);
							$album['_id']=$db->insert('line',$album);
						}
						$type='jpg';
						$fd = _::folder()->fd($update);
						$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
						
						$q=_::upload()->send('s1','line-photo','',array('type'=>$type,'folder'=>$folder,'string'=>$arg['photo_base64']));			
					
						if($q['status']=='OK')
						{
							$fbupload = $arg['photo_base64'];
							if(!$album['lo'])
							{
							
							}
							else
							{
								$_ty='photo';
								if($arg['photo_draw'])
								{
									$_ty='draw';
								}
								$db->update('line',array('_id'=>$update),array('$set'=>array('ty'=>$_ty,'pt'=>array('a'=>$album['_id'],'e'=>$type,'fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
							}
						}
					}
					imagedestroy($im);
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
						
						$img = base64_decode($arg['photo_base64']);
						$im = @imagecreatefromstring($img);
						if ($im !== false)
						{
								_::folder()->mkdir('bin/tmp');
								$delmyimg='bin/tmp/'._::$my['_id'].'.tmp';
								imagejpeg($im,FILES.$delmyimg,85);
								$attachment['image'] = '@'.realpath(FILES.$delmyimg);
						}
						imagedestroy($im);
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
	_::$content[] = array('method'=>'line','type'=>'post','data'=>['status'=>'OK']);
}
elseif(!trim($arg['msg']))
{
	_::$content[] = array('method'=>'line','type'=>'post','data'=>['status'=>'FAIL','message'=>'ไม่มีข้อความ']);
	//&&(is_array($arg['to'])
}
elseif(!is_array($arg['to']))
{
	_::$content[] = array('method'=>'line','type'=>'post','data'=>['status'=>'FAIL','message'=>'ไม่มีปลายทาง - '.$arg['to']]);
	//&&(is_array($arg['to'])
}
elseif(is_array($arg['to']))
{
	_::$content[] = array('method'=>'line','type'=>'post','data'=>['status'=>'FAIL','message'=>'ไม่มีปลายทาง - '.print_r($arg['to'],true)]);
	//&&(is_array($arg['to'])
}

?>