<?php
function getcredit()
{
	$ajax=_::ajax();
	if(_::$my)
	{
		$now=date('Y-m-d');
		#$ava=array('2012-10-04','2012-10-05','2012-10-06','2012-10-07','2012-10-08','2012-10-09','2012-10-10');
		#if(in_array($now,$ava))
		
		$g=date('G');
		if($g>=18 && $g<=23)
		{
			$db=_::db();
			if(!$db->findone('point',array('u'=>_::$my['_id'],'ty'=>'event','da'=>array('$gte'=>new MongoDate(strtotime($now.' 00:00:00')),'$lte'=>new MongoDate(strtotime($now.' 23:59:59'))))))
			{
				$ajax->alert('ปิดบริการชั่วคราว...');
				/*
				if(intval(_::$my['st'])>0)
				{
					if(_::point()->action(_::$my['_id'],20,'event','กิจกรรม boxza.com แจกบ๊อกทุกวันฟรี 20 บ๊อก ( สำหรับสมาชิกที่ยืนยันอีเมล์แล้ว )'))
					{
						$ajax->alert('ได้รับบ๊อกเรียบร้อยแล้ว');
						$ajax->script('_.line.go("/line",true,true);');
					}
					else
					{
						$ajax->alert('คุณไม่สามารถรับบ๊อกได้');
					}
				}
				else
				{
					$ajax->alert('คุณยังไม่ได้ยืนยันการสมัครสมาชิกผ่านอีเมล์');
				}
				*/
			}
			else
			{
				$ajax->alert('คุณรับบ๊อกสำหรับวันนี้ไปแล้ว');
			}
		}
		else
		{
			#$ajax->alert('สิ้นสุดกิจกรรมรับบ๊อกแล้ว');
			$ajax->alert('ไม่สามารถรับบ๊อกในขณะนี้ กรุณารอเวลาที่กำหนด');
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอินเพื่อใช้งานในส่วนนี้');
	}
}
function savecrop($frm)
{
	_::session()->logged();
	if(_::$my['_id'])
	{
		$ajax=_::ajax();
		$q=_::upload()->send('s1','profile-crop',_::$my['if']['fd'],$frm);
		if($q['status']=='OK')
		{
			$ajax->script('_.box.close();');
			$ajax->script('$(".img-uid-'._::$my['_id'].'").attr("src","'.'http://s1.boxza.com/profile/'._::$my['if']['fd'].'/s.jpg?v='.rand(1,9999).'");');
			$ajax->script('$(".img-uid-my").attr("src","'.'http://s1.boxza.com/profile/'._::$my['if']['fd'].'/n.jpg?v='.rand(1,9999).'");');
		}
		else
		{
			$ajax->alert('ข้อมูลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
		}
	}
}

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
		 <a href="https://maps.google.com/?q='.$lat.','.$lon.'" target="_blank">
		 <img src="http://maps.googleapis.com/maps/api/staticmap?center='.$lat.','.$lon.'&markers=color:blue%7Clabel:A%7C'.$lat.','.$lon.'&zoom=15&size=539x150&maptype=roadmap&sensor=false" style="margin:5px"></a>
		<div class="mp-n">'.$n.'</div>
		<input type="hidden" name="latlon" value="'.$lat.','.$lon.'"><input type="hidden" name="geo" value="'.$n.'">
		<a href="javascript:;" onclick="$(this).parent().parent().remove();" class="del"><img src="http://s0.boxza.com/static/images/global/del.gif" class="icon"></a> </div></div>');
		}
		elseif($type=='photo')
		{
			$db=_::db();
			if(!$album=$db->findOne('line',array('u'=>_::$my['_id'],'ty'=>'album','lo'=>1),array('tt'=>1,'_id'=>1)))
			{
				$db->insert('line',array('u'=>_::$my['_id'],'tt'=>'รูปภาพบนไลน์','ty'=>'album','lo'=>1,'hi'=>1,'in'=>array(0)));
			}
			$album=$db->find('line',array('u'=>_::$my['_id'],'ty'=>'album','lo'=>array('$ne'=>2),'dd'=>array('$exists'=>false)),array('tt'=>1,'_id'=>1),array('sort'=>array('_id'=>1)));
			$tmp='อัลบั้ม: <select name="album" class="tbox">';
			for($i=0;$i<count($album);$i++)
			{
				$tmp.='<option value="'.$album[$i]['_id'].'">'.$album[$i]['tt'].'</option>';
			}
			$tmp.='</select><input type="file" class="tbox" name="photo" id="post_photo" style="width:200px"><input type="hidden" id="photo_id" name="photo_id" value=""><input type="hidden" id="photo_base64" name="photo_base64" value=""><input type="hidden" id="photo_rotate" name="photo_rotate" value=""> <select class="tbox" name="photo_act"><option value="">เผยแพร่ทันที</option><option value="edit">แก้ไขก่อนเผยแพร่</option></select>';
			_::ajax()->jquery('#lphoto','html','<div>'.$tmp.'</div>');
		}
		elseif($type=='link')
		{
			$url = trim(func_get_arg(1));
			if(!preg_match('|^http(s)?://[a-z0-9-]+\.([a-z0-9-\.]+)*(:[0-9]+)?(/.*)?$|i', $url))
			{
				_::ajax()->alert('ลิ้งค์ไม่ถูกต้อง');
				return;
			}
			elseif(stripos($url,'facebook.com')>-1)
			{
				return;
			}
			
			$bad=array('qpidradio.com','chat.boxza.com','satangame.com','dj-fluke.zz.mu','bugs3.com');
			foreach($bad as $v)
			{
				if(stripos($url,$v)>-1)
				{
					_::ajax()->script('_.post.cancel("คุณไม่สามารถโพสข้อความนี้ได้");');
					_::ajax()->alert('ไม่สามารถโพสลิ้งค์นี้ได้');
					return;
				}
			}
			
			$width = 500;
			if($opg = _::opengraph()->fetch(trim($url)))
			{
				$opg['url']=trim($url);
				$opg['title'] = htmlspecialchars(trim($opg['title']), ENT_QUOTES,'utf-8');
				$opg['description'] = htmlspecialchars(trim($opg['description']), ENT_QUOTES,'utf-8');
				
				if($opg['og:title'])$opg['title']=htmlspecialchars(trim($opg['og:title']), ENT_QUOTES,'utf-8');
				if($opg['og:description'])$opg['description']=htmlspecialchars(trim($opg['og:description']), ENT_QUOTES,'utf-8');
				if($opg['og:url']&&substr($opg['og:url'],0,1)!='/')$opg['url']=$opg['og:url'];
				$opg['og:video:width'] = intval($opg['og:video:width']);
				$opg['og:video:height'] = intval($opg['og:video:height']);
				$v = '<input type="hidden" name="attach-url" value="'.$opg['url'].'"><input type="hidden" name="attach-title" value="'.$opg['title'].'"><input type="hidden" name="attach-description" value="'.$opg['description'].'">';
				if((!$opg['og:image']) && $opg['image_src'])
				{
					$opg['og:image'] = $opg['image_src'];
				}
				if($opg['og:image'])$v .= '<input type="hidden" name="attach-image" value="'.$opg['og:image'].'">';
				if($opg['og:video']&&$opg['og:video:type']&&$opg['og:video:width']&&$opg['og:video:height'])
				{
					$v .= '<input type="hidden" name="attach-video" value="'.$opg['og:video'].'">';
					$v .= '<input type="hidden" name="attach-video-type" value="'.$opg['og:video:type'].'">';
					$v .= '<input type="hidden" name="attach-video-width" value="'.$opg['og:video:width'].'">';
					$v .= '<input type="hidden" name="attach-video-height" value="'.$opg['og:video:height'].'">';
					$r = $opg['og:video:width']/$opg['og:video:height'];
					if($opg['og:video:width']>$width)
					{
						$opg['og:video:width']=$width;
						$opg['og:video:height']=$width/$r;
					}
					if($opg['og:video:height']>$width)
					{
						$opg['og:video:height']=$width;
						$opg['og:video:width']=$width*$r;
					}
				}
				$v.='<div><strong>'.$opg['title'].'</strong></div>';
				if($opg['og:image'])
				{
					//$v.='<div align="center"><img src="http://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url='.urlencode($opg['og:image']).'&container=focus&gadget=a&rewriteMime=image/*&refresh=31536000&resize_w=500&resize_h=400&no_expand=1"></div>';
					$v.='<div align="center"><img src="'.$opg['og:image'].'" style="max-width:500px; max-height:375px;"></div>';
				}
				elseif($opg['og:video']&&$opg['og:video:type']&&$opg['og:video:width']&&$opg['og:video:height'])
				{
					$v.='<div><object width="'.$opg['og:video:width'].'" height="'.$opg['og:video:height'].'">
				 <param name="movie" value="'.$opg['og:video'].'">
				 <embed src="'.$opg['og:video'].'" width="'.$opg['og:video:width'].'" height="'.$opg['og:video:height'].'"></embed>
			</object></div>';
				}
				$v.='<div>'.$opg['description'].'</div><a href="javascript:;" onclick="$(this).parent().remove();"><img src="http://s0.boxza.com/static/images/global/del.gif" class="icon del"></a>';
				_::ajax()->jquery('#llink','html','<div>'.$v.'</div>');
				_::ajax()->jquery('#post-bt','removeProp','disabled');
				_::ajax()->script('$("#lalink_img").css("display","none");');
			}
			else
			{
				_::ajax()->alert('ลิ้งค์ไม่ถูกต้อง หรือไม่สามารถเข้าถึงข้อมูลได้');
			}
		}
	}
}


function delline($line)
{
	_::session()->logged();
	if(_::$my['_id'])
	{
		$db=_::db();
		if($tmp = $db->findOne('line',array('_id'=>intval($line)),array('_id'=>1,'u'=>1,'s'=>1,'p'=>1,'pt'=>1,'sh'=>1,'ty'=>1,'lo'=>1,'dd'=>1,'hs'=>1)))
		{
			if(_::$my && !$tmp['lo'] && !$tmp['dd'])
			{
				if($tmp['u']==_::$my['_id']||$tmp['p']==_::$my['_id']||_::$my['am']>=9)
				{
					$db->update('line',array('_id'=>intval($line)),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())));
					
					
					if(is_array($tmp['hs']) && count($tmp['hs']))
					{
						for($k=0;$k<count($tmp['hs']);$k++)
						{
							$db->update('line_hash',array('_id'=>$tmp['hs']),array('$inc'=>array('c'=>-1)));
						}
					}
				
					if($tmp['ty']=='album')
					{
						$db->update('line',array('pt.a'=>intval($line)),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
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
								if($album=$db->findOne('line',array('_id'=>intval($tmp['pt']['a']),'ty'=>'album'),array('_id'=>1,'pt'=>1)))
								{
									if(!is_array($album['pt']))$album['pt']=array();
									if($album['pt']['cv'] && $album['pt']['cv']['i']==intval($line))
									{
										unset($album['pt']['cv']);
									}
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
				$insert = array('u'=>_::$my['_id'],'ty'=>'share','sh'=>array('l'=>array(),'c'=>0,'f'=>$line['_id']),'in'=>array(-1),'ms'=>trim(mb_substr(htmlspecialchars(stripslashes($arg['msg']),ENT_QUOTES,'utf-8'),0,2048,'utf-8')));
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

function html_callback($e)
{
	$tag=mb_strtolower($e->tag);
	$attr=$e->getAllAttributes();
	if(is_array($attr))
	{
		$arg=array();
		if($tag=='a'&&isset($e->href))
		{
			$url=$e->href;
			$ur=parse_url($url,PHP_URL_HOST);
			if(strpos($ur,'boxza.com')===false)
			{
				$url='http://out.boxza.com/#'.base64_encode($url);
			}		
			$arg=array('href'=>$url,'target'=>'_blank','rel'=>'nofollow');
		}
		elseif(in_array($tag,array('p','div')) && isset($e->align))
		{
				$arg=array('align'=>$e->align);
		}
		elseif($tag=='img'&&isset($e->src))
		{
			$arg=array('src'=>$e->src);
		}
		elseif($tag=='span')
		{
			if($style=$e->getAttribute('style'))
			{
				_::ajax()->alert($style);
				if(mb_stripos($style,'text-decoration',0,'utf-8')>-1)
				{
					if(mb_stripos($style,'underline',0,'utf-8')>-1)
					{
						$arg=['style'=>'text-decoration: underline'];
					}
					elseif(mb_stripos($style,'line-through',0,'utf-8')>-1)
					{
						$arg=['style'=>'text-decoration: line-through'];
					}
				}
			}
		}
		foreach($attr as $k=>$v)
		{
			if(isset($arg[$k]))
			{
				$e->setAttribute($k,$arg[$k]);
			}
			else
			{
				$e->removeAttribute($k);
			}
		}
	}
} 


function checkout_nofollow($arg)
{
	if(preg_match('/^http\:\/\/([a-z0-9\.]+)?boxza\.com(.*)$/',$arg[1]))
	{
		return 	'<a href="'.$arg[1].'" target="_blank">';
	}
	else
	{
		return 	'<a href="http://out.boxza.com/#'.base64_encode($arg[1]).'" target="_blank">';
	}
}

function post($arg)
{
	_::session()->logged();
	$delmyimg=false;
	if(_::$my['_id'])
	{
		$db=_::db();
		$ajax=_::ajax();
		if(_::$my['_id']&&trim($arg['msg'])&&(is_array($arg['to'])||$arg['to']!=''))
		{
			$update=false;
			$drawing=false;
			$text=trim(strip_tags($arg['msg'],'<a><strong><b><div><p><br><ol><ul><li><em><blockquote><span><img>'));
			
			$arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['d']);
			
			$bad=array('qpidradio.com','chat.boxza.com','satangame.com','dj-fluke.zz.mu','bugs3.com');
			foreach($bad as $v)
			{
				if(stripos($text,$v)>-1)
				{
					_::ajax()->script('_.post.cancel("คุณไม่สามารถโพสข้อความนี้ได้");');
					return false;
				}
			}
			require_once(HANDLERS.'libs/simple_html_dom.php');
			$html = new simple_html_dom();
			$html->load($text);
			$html->set_callback('html_callback');
			$insert = array('u'=>_::$my['_id'],'ty'=>'post','ms'=>strval($html),'rnd'=>rand(0,99),'ex'=>new MongoDate(time()+_::$config['line_expire']));
			$html->clear();
			
			/*
			if($title=trim(mb_substr(htmlspecialchars($arg['title'],ENT_QUOTES,'utf-8'),0,100,'utf-8')))
			{
				$insert['ty']='blog';
				$insert['tt']=$title;
				unset($title);
			}
			*/
			
			$ori_msg=trim(str_replace(['<br>','<br/>','<br />','&nbsp;','&gt;','&lt;'],["\n","\n","\n",' ','>','<'],strip_tags($arg['msg'],'<br>')));
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
			# location
			if($arg['latlon'] && trim($arg['geo']))
			{
				list($lat,$lng) = explode(',',$arg['latlon']);
				$insert['lc']=array('n'=>trim($arg['geo']),'l'=>array(floatval($lat),floatval($lng)));
			}
			
			
			#poll
			if(is_array($arg['poll']))
			{
				$poll=array();
				$ij=0;
				for($i=0;$i<min(15,count($arg['poll']));$i++)
				{
					$t = trim($arg['poll'][$i]);
					if($t)
					{
						$poll[]=array('i'=>$ij,'m'=>$t,'u'=>array(),'c'=>0);
						$ij++;
					}
				}
				
				if(count($poll)<2)
				{
					$ajax->alert('กรุณากรอกคำตอบอย่างน้อย 2 ตัวเลือก');
					$ajax->script('_.post.clear();');
					return;
				}
				$insert['po']=array('c'=>0,'u'=>array(),'d'=>$poll);
				$insert['ty']='poll';
			}
			
			# attach link
			$attach=array();
			if($arg['attach-video'] && $arg['attach-video-type'] && $arg['attach-video-width'] && $arg['attach-video-height'])
			{
				$attach['v'] = array('l'=>trim($arg['attach-video']),'t' => trim($arg['attach-video-type']),'w' => trim($arg['attach-video-width']),'h' => trim($arg['attach-video-height']));
			}
			if($arg['attach-title'])
			{
				$attach['t'] = trim(mb_substr(htmlspecialchars(htmlspecialchars_decode(stripslashes($arg['attach-title'])),ENT_QUOTES,'utf-8'),0,1024,'utf-8'));
			}
			if($arg['attach-description'])
			{
				$attach['d'] = trim(mb_substr(htmlspecialchars(htmlspecialchars_decode(stripslashes($arg['attach-description'])),ENT_QUOTES,'utf-8'),0,2048,'utf-8'));
			}
			if($arg['attach-url'])
			{
				$attach['l'] = trim($arg['attach-url']);
				foreach($bad as $v)
				{
					if(stripos($attach['l'],$v)>-1)
					{
						_::ajax()->script('_.post.cancel("คุณไม่สามารถโพสข้อความนี้ได้");');
						return false;
					}
				}
			}
			if($arg['attach-image'])
			{
				$attach['i'] = trim($arg['attach-image']);
			}
			if(count($attach))
			{
				$insert['at']=$attach;
			}
			
			$fbupload=false;
			if($arg['album']&&$arg['photo_id'])
			{
				if($photo=$db->findOne('line',array('_id'=>intval($arg['photo_id']),'ty'=>'photo','u'=>_::$my['_id']),array('pt'=>1,'_id'=>1)))
				{
					if($album=$db->findOne('line',array('_id'=>intval($arg['album']),'ty'=>'album','u'=>_::$my['_id']),array('_id'=>1,'lo'=>1)))
					{
						if($arg['photo_base64'])
						{
							if($img = base64_decode($arg['photo_base64']))
							{
								$im = @imagecreatefromstring($img);
								if ($im !== false)
								{
									if(imagesx($im)==$photo['pt']['w'] && imagesy($im)==$photo['pt']['h'])
									{
										$sizeup=true;
										$q=_::upload()->send('s1','fromstring','line/'.$photo['pt']['f'].'/o.'.$photo['pt']['e'],array('ext'=>$photo['pt']['e'],'string'=>$arg['photo_base64']));
									}							
								}
							}
						}
						//photo_rotate
						
						if(($rotate=intval($arg['photo_rotate'])) && $rotate>0)
						{
							$rotate = ($rotate % 4);
							if($rotate > 0)
							{
								$rotate = $rotate*90;
								$sizeup=true;
								$q=_::upload()->send('s1','rotate','line/'.$photo['pt']['f'].'/o.'.$photo['pt']['e'],array('ext'=>$photo['pt']['e'],'rotate'=>$rotate));
							}
						}
						if($album['lo'])
						{
							$db->update('line',array('_id'=>intval($arg['photo_id'])),array('$unset'=>array('hi'=>1)));
						}
						
						$fbupload='http://s1.boxza.com/line/'.$photo['pt']['f'].'/o.'.$photo['pt']['e'];
						//picture=
						$update=intval($arg['photo_id']);
						$insert['pt.a']=$album['_id'];
						$insert['ty']='photo';
						
						if($sizeup)
						{
							$q=_::upload()->send('s1','getsize','line/'.$photo['pt']['f'].'/o.'.$photo['pt']['e']);
							if($q['status']=='OK')
							{
								$db->update('line',array('_id'=>$update),array('$set'=>array('pt.w'=>$q['data']['w'],'pt.h'=>$q['data']['h'],'pt.s'=>$q['data']['s'])));
							}
							list($name,$ext)=explode('.',$p['pt']['n'],2);
							_::upload()->send('s1','line-thumb','line/'.$photo['pt']['f'].'/o.'.$photo['pt']['e'],array('to'=>$p['pt']['f'],'ext'=>$p['pt']['e']));
						}
					}
				}
			}
			elseif($arg['drawing'])
			{			
				if($img = base64_decode($arg['drawing']))
				{
					$im = @imagecreatefromstring($img);
					if ($im !== false)
					{
						$drawing=true;
					}
					imagedestroy($im);
				}
				if(!$drawing)
				{
					_::ajax()->script('_.post.cancel("ไฟล์แนบรูปวาดของคุณไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง");');
					return false;
				}
			}
			
			
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
				else
				{
					$op_to[] = trim($arg['to'][$i]);
				}
			}
			$insert['in']=array_values(array_unique($insert['in']));
			
			if(preg_match_all("/\@(([a-z0-9]{1})([a-z0-9\.\-]{1,28})([a-z0-9]{1}))/",$ori_msg,$out, PREG_PATTERN_ORDER))
			{
				if($out[1]&&is_array($out[1]))
				{
					$us=[];
					foreach($out[1] as $v)
					{
						$us[]=$v;
					}
					if(count($us))
					{
						$us=array_slice(array_values(array_unique(array_map('strtolower',array_filter($us)))),0,10);
					}
					if(count($us))
					{
						$insert['uk']=[];
						foreach($us as $s)
						{
							if($u=$db->findone('user',array('if.lk'=>$s),array('_id'=>1,'if.lk'=>1)))
							{
								$insert['us'][]=$u['_id'];
								$insert['uk'][]=$u['if']['lk'];
							}
						}
					}
				}
			}
			
			$insert['us']=array_values(array_unique($insert['us']));
			
			
			$badword = '('.implode('|',require(HANDLERS.'boxza/badword.php')).')';
			
			$_posted=false;
			if(preg_match('/'.$badword.'/i',$ori_msg,$bw))
			{
				$ajax->alert('ไม่สามารถใช้คำว่า "'.$bw[1].'" ในโพสได้');
			}
			elseif(count($insert['in']) || count($insert['us']))
			{	
				$_posted=true;
				if(!count($insert['in']))unset($insert['in']);
				if(!count($insert['us']))unset($insert['us']);
				
				if(isset($arg['hash'])&&$arg['hash'])
				{
					if(!is_array($arg['hash']))
					{
						$arg['hash']=array($arg['hash']);
					}
					$hash=array();
					$m = $arg['hash'];
					$format=_::format();
					for ($i = 0; $i < count($m); $i++) 
					{
						if(($htag=mb_strtolower(trim($m[$i]),'utf-8')))
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
				
				
				if($mypost=$db->count('line',array('u'=>_::$my['_id'],'hr'=>array('$exists'=>false),'ds'=>array('$gte'=>new MongoDate(time()-(1*3600))))))
				{
					if($mypost>=10)
					{
						$insert['hr']=1;
					}
					elseif($mypost>=5&&rand(0,9)>=5)
					{
						$insert['hr']=1;
					}
				}
				if(_::$my['if']['ha'] || (!_::$my['st']) || (_::$my['st']<1))
				{
					$insert['ha']=1;
				}
				if($update)
				{
					$db->update('line',array('_id'=>$update),array('$set'=>$insert));
				}
				else
				{
					$update=$db->insert('line',$insert);
				}
				
				
				# gif
				if($arg['gif'])
				{
					$serv = parse_url($arg['gif']);
					if(preg_match('/^([a-z0-9]*)\.boxza\.com$/',$serv['host'],$carg))
					{
						$q=_::upload()->send($carg[1],'line-gif',$serv['path'],array('line'=>$update));
						if($q['status']=='OK')
						{
							$fbupload=$q['data']['file'];
							$db->update('line',array('_id'=>$update),array('$set'=>array('ty'=>'gif','pt'=>array('e'=>'gif','fd'=>$q['data']['fd'],'f'=>$q['data']['folder'],'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
						}
					}
				}
				if($drawing)
				{
					$fd = _::folder()->fd($update);
					$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
					//$name = substr($fd,4,2);
					$q=_::upload()->send('s1','line-photo','',array('type'=>'jpg','folder'=>$folder,'string'=>$arg['drawing']));			
					if($q['status']=='OK')
					{
						$db->update('line',array('_id'=>$update),array('$set'=>array('ty'=>'draw','pt'=>array('e'=>'jpg','fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
						$fbupload='http://s1.boxza.com/line/'.$folder.'/o.jpg';
					}
				//	$ajax->alert(print_r($q,true));
				}
									
				if($pf && ($pf['_id']!=_::$my['_id']))
				{
					_::notify()->insert($pf['_id'],'line',$update,$insert['ms']);					
					if(!$pf['op']['em']['ln'])
					{				
						if(!$db->findOne('cron_notifications',array('u'=>_::$my['_id'],'p'=>$pf['_id'],'ty'=>'ln','rl'=>$update)))
						{
							$db->insert('cron_notifications',array('u'=>_::$my['_id'],'p'=>$pf['_id'],'ty'=>'ln','rl'=>$update,'ms'=>$insert['ms']));
						}
					}
				}
				if(count($op_to))
				{
					_::user()->update(_::$my['_id'],array('$set'=>array('op.to'=>$op_to)));
				}
				if($update && count($insert['us']))
				{
					_::notify()->insert($insert['us'],'line',$update,mb_substr($ori_msg,0,50,'utf-8'));
				}
			}
			if($_posted)
			{
			//$ajax->alert($db->error);	
				$shorturl='http://boxza.com/l/'.ltrim(_::folder()->fd($update),'0');
				if(isset(_::$my['sc']['tw']))
				{
					if(isset(_::$my['sc']['tw']['token'])&&isset(_::$my['sc']['tw']['secret']))
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
									//$l=' '.PROTOCOL.'boxza.com/'.($pf?$pf['link']:_::$my['link']).'/line/'.$update;
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
				if(isset(_::$my['sc']['fb']))
				{
					if(isset(_::$my['sc']['fb']['token']))
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
								_::folder()->mkdir('bin/tmp');
								$delmyimg='bin/tmp/'._::$my['_id'].'.tmp';
								copy($fbupload,FILES.$delmyimg);
								$attachment['image'] = '@'.realpath(FILES.$delmyimg);
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
							
							if($insert['po'])
							{
								$attachment['properties'] = array();
								for($j=0;$j<count($insert['po']['d']);$j++)
								{
									$attachment['properties'][$j+1]=$insert['po']['d'][$j]['m'];
								}
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
												$facebook->setExtendedAccessToken();
												$facebook->api('/'.$id.'/'.($fbupload?'photos':'feed'), 'post', $attachment);
											} catch (FacebookApiException $e) {$ajax->alert($e->getMessage());}	
										}
									}
									elseif($id=='profile' && $pf['sc']['fb'])
									{
									try{
										$facebook->setAccessToken(_::$my['sc']['fb']['token']);
										$facebook->api('/'.$pf['sc']['fb']['id'].'/'.($fbupload?'photos':'feed'), 'post', $attachment);
										} catch (FacebookApiException $e) {$ajax->alert($e->getMessage());}	
									}
									elseif($id=='me')
									{
									try{
										$facebook->setAccessToken(_::$my['sc']['fb']['token']);
										$facebook->api('/me/'.($fbupload?'photos':'feed'), 'post', $attachment);
										} catch (FacebookApiException $e) {$ajax->alert($e->getMessage());}	
									}
								}
							}
						}
					}
				}
			}
		}
		if(isset($arg['share']))
		{
			$ajax->jquery('._post','html','<div style="padding:50px; text-align:center;font-size:16px; color:#000;text-shadow:2px 2px 0px #fff">โพสต์ลิ้งค์เรียบร้อยแล้ว (<a href="http://social.boxza.com/line/'.$lid.'" target="_blank">คลิกที่นี่เพื่อไปยังหน้าไลน์</a>)');
			$ajax->script('$("._post_tmp").remove()');
		}
		else
		{
			$ajax->script('_.post.clear();');
		}
	}
	if($delmyimg)
	{
		_::folder()->delete($delmyimg);
	}
}

function getedit($line)
{
	_::session()->logged();
	$ajax=_::ajax();
	if(_::$my['_id'])
	{
		$db=_::db();
		if($l=$db->findone('line',array('_id'=>intval($line),'u'=>_::$my['_id'])))
		{
			if(in_array($l['ty'],array('post','photo')))
			{
				$ajax->script('$(".ln-'.$line.' .ct-ed").remove()');
				$ajax->jquery('.ln-'.$line.' .dt','prepend','<div class="ct-ed"><textarea class="tbox">'.$l['ms'].'</textarea><div><input type="button" class="button blue" onclick="_.post.update('.$line.')" value="บันทึก"> <input type="button" class="button" onclick="$(\'.ln-'.$line.' .ct-ed\').remove()" value="ยกเลิก"></div><h4>ข้อความเดิม</h4></div>');
			}
			else
			{
				$ajax->alert('ไม่สามารถแก้ไขข้อความนี้ได้');
			}
		}
		else
		{
			$ajax->alert('คุณไม่มีสิทธิ์แก้ไขข้อความนี้');
		}
	}
	else
	{
		_::ajax()->alert('คุณไม่มีสิทธิ์แก้ไขข้อความนี้');
	}
}
function setedit($line,$ms)
{
	_::session()->logged();
	$ajax=_::ajax();
	if(_::$my['_id'] && trim($ms))
	{
		$db=_::db();
		if($l=$db->findone('line',array('_id'=>intval($line),'u'=>_::$my['_id'])))
		{
			if(in_array($l['ty'],array('post','photo')))
			{
				$db->update('line',array('_id'=>$l['_id']),array('$set'=>array('de'=>new MongoDate(),'ms'=>trim(mb_substr(htmlspecialchars(stripslashes($ms),ENT_QUOTES,'utf-8'),0,2048,'utf-8')))));
				if($l=$db->findone('line',array('_id'=>intval($line))))
				{
					$ajax->alert('บันทึกข้อความเรียบร้อยแล้ว');
					$ajax->jquery('.ln-'.$line.' .dt','html',$l['ms']);
					$ajax->jquery('.ln-'.$line.' .dt','removeClass','ev');
					$ajax->script('$(".ln-'.$line.' .ln-ed").remove()');
					$ajax->script('$(".ln-'.$line.' .ct-s .ago").attr("datetime",'.$l['de']->sec.').parent().after(\' <span class="ln-ed">(แก้ไข)</span>\')');
				}
			}
		}
	}
	$ajax->script('$(".ln-'.$line.' .ct-ed").remove();_.line.update();');
}

function sendreport($arg)
{
	if($arg['line']&&$arg['reason'])
	{
		$reason=intval($arg['reason']);
		if($reason<1||$reason>7)return;
		_::session()->logged();
		$ajax=_::ajax();
		$db=_::db();
		if($line=$db->findOne('line',array('_id'=>intval($arg['line']),'dd'=>array('$exists'=>false))))
		{
			if(!is_array($line['sp']))
			{
				$line['sp']=array('u'=>array(),'c'=>0);
			}
			if(!in_array(_::$my['_id'],(array)$line['sp']['u']))
			{
				$db->update('line',array('_id'=>$line['_id']),array('$inc'=>array('sp.c'=>1),'$push'=>array('sp.u'=>_::$my['_id'],'sp.r'=>$reason),'$set'=>array('sp.ds'=>new MongoDate())));
				if($c=$db->findOne('notify',array('p'=>$line['u'],'rl'=>$line['_id'],'ty'=>'spam'),array('_id'=>1,'dr'=>1)))
				{
					$db->remove('notify',array('_id'=>$c['_id']));
				}
				_::notify()->insert($line['u'],'spam',$line['_id']);
			}
			$ajax->alert('แจ้งการละเมิดหรือสแปมเรียบร้อยแล้ว');
		}
		else
		{
			$ajax->alert('ไม่มีข้อความ หรือข้อความนี้อาจจะโดนลบไปแล้ว');
		}
	}
}

function unsetspam($id)
{
	_::session()->logged();
	if(_::$my['am']>0)
	{
		$ajax=_::ajax();
		$db=_::db();
		if($line=$db->findOne('line',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
		{
			$db->update('line',['_id'=>$line['_id']],['$unset'=>['sp'=>1]]);
			$ajax->alert('ยกเลิกการแจ้งสแปมเรียบร้อยแล้ว');
		}
		else
		{
			$ajax->alert('ไม่มีข้อความ หรือข้อความนี้อาจจะโดนลบไปแล้ว');
		}
		$ajax->script('$("#_line_ln'.$line['_id'].'").remove()');
	}
}

function setha($line,$status)
{
	if(_::$my['am'])
	{
		$db=_::db();
		if($status)
		{
			$db->update('line',['_id'=>intval($line)],['$set'=>['ha'=>1]]);
			_::ajax()->alert('ซ่อนโพสนี้จากหน้าแสดงทั้งหมดแล้ว');
		}
		else
		{
			$db->update('line',['_id'=>intval($line)],['$unset'=>['ha'=>1]]);
			_::ajax()->alert('แสดงโพสนี้ในหน้าแสดงทั้งหมดแล้ว');
		}
	}
}

function listgroup($arg)
{
	$ajax=_::ajax();
	$user=_::user();
	$db=_::db();
	if($arg['type']=='insert')
	{
		$count=count(_::$my['ct']['gp']);
		if($count>=10)
		{
			$ajax->alert('คุณมีรายการทั้งหมดครบ 10 รายการแล้ว');
		}
		else
		{
			$name=mb_substr(trim($arg['name']),0,30,'utf-8');
			if(!$name)
			{
				$ajax->alert('กรุณากรอกชื่อรายการ');
			}
			else
			{
				$user->update(_::$my['_id'],array('$push'=>array('ct.gp'=>array('n'=>$name,'u'=>array()))));
				$ajax->jquery('.my-list','append','<li><a href="/line/list/'.($count+1).'>" class="h"><i class="i16 nav-ln-list-'.$i.'"></i><span>'.$name.'</span></a></li>');
				$ajax->script('_.line.go("/line/list/'.($count+1).'");');
			}
		}
	}
	else
	{
		
		$c=intval($arg['list'])-1;
		if(isset(_::$my['ct']['gp'][$c]))
		{
			$l=_::$my['ct']['gp'][$c];
			if($arg['type']=='update')
			{
				$name=mb_substr(trim($arg['name']),0,30,'utf-8');
				if(!$name)
				{
					$ajax->alert('กรุณากรอกชื่อรายการ');
				}
				else
				{
					$user->update(_::$my['_id'],array('$set'=>array('ct.gp.'.$c.'.n'=>$name)));	
					$ajax->script('_.line.go("/line/list/'.($c+1).'");');
					$ajax->script('$(".nav-ln-list-'.($c+1).'").parent().find("span").html("'.$name.'");');
				}
			}
			elseif($arg['type']=='delete')
			{
				if($c==0)
				{
					$ajax->alert('คุณไม่สามารถลบรายการนี้ได้');
				}
				else
				{
					$user->update(_::$my['_id'],array('$unset'=>array('ct.gp.'.$c=>1)));	
					$user->update(_::$my['_id'],array('$pull'=>array('ct.gp'=>NULL)));
					$ajax->script('_.line.go("/line");$(".nav-ln-list-'.($c+1).'").parent().parent().remove();');
				}
			}
			else
			{
				if(intval($arg['uid']) && ($u=$user->profile($arg['uid'])))
				{
					if($arg['type']=='add')
					{
						if(!is_array($l['u'])||!in_array($u['_id'],$l['u']))
						{
							if(is_array($l['u'])&&count($l['u'])>=50)
							{
								$ajax->alert('คุณสามารถเพิ่มเพื่อนในรายการนี้ได้สูงสุด 50 คน');
							}
							else
							{
								$user->update(_::$my['_id'],array('$push'=>array('ct.gp.'.$c.'.u'=>$u['_id'])));					
								$ajax->jquery('.u-in-list p','before','<li class="av people-'.$u['_id'].'" av="'.$u['_id'].'" data-button=\'[{"text":"ลบออกจากรายการนี้","click":"delete_from_list('.$u['_id'].')"}]\'><a href="/'.$u['link'].'" title="'.$u['name'].'" class="h"><img src="'.$u['himg'].'" title="'.$u['name'].'"></a></li>');
								$ajax->script('_.people.load();');
							}
						}
						else
						{
							$ajax->alert('มีเพื่อนคนนี้อยู่ในรายการนี้แล้ว');
						}
					}
					elseif($arg['type']=='del')
					{
						$user->update(_::$my['_id'],array('$pull'=>array('ct.gp.'.$c.'.u'=>$u['_id'])));					
						$ajax->script('$(\'.u-in-list .people-'.$u['_id'].'\').remove()');
					}
				}
			}
		}
	}
}

function setannounced($arg)
{
	_::session()->logged();
	if(_::$my['am']>=9)
	{
		$db=_::db();
		$ajax=_::ajax();
	
		$cache=_::cache();
		$db->update('msg',['_id'=>'announced'],['$set'=>['msg'=>trim($arg['announced'])]],['upsert'=>true]);
		
		$cache->delete('ca1','line-rec',0);
		$cache->delete('ca1','line-',0);
		$ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
		$ajax->script('_.line.go(_.url);');
	}
}

?>