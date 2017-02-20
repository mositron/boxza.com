<?php
function setsc($social,$type)
{
	if($social=='fb')
	{
		if($type=='new')
		{
			require_once(ROOT.'handlers/facebook/facebook.php');	
			$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']));
			_::move($facebook->getLoginUrl(array('scope'=>'offline_access,email,publish_stream,user_birthday,user_location,manage_pages,photo_upload','redirect_uri'=>'http://boxza.com/settings/facebook/?call=facebook')));
		}
		elseif($type=='verify')
		{
			require_once(ROOT.'handlers/facebook/facebook.php');	
			$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']));
			_::move($facebook->getLoginUrl(array('scope'=>'offline_access,email,publish_stream,user_birthday,user_location,manage_pages,photo_upload','redirect_uri'=>'http://boxza.com/settings/facebook/?call=facebook&verify=1')));
		}
		elseif($type=='del')
		{
			_::user()->update(_::$my['_id'],array('$unset'=>array('sc.fb'=>1)));
			_::move('/settings/facebook');
		}
	}
	else if($social=='tw')
	{
		if($type=='new')
		{
			require(ROOT.'handlers/twitter/twitteroauth/twitteroauth.php');
			$connection = new TwitterOAuth(_::$config['social']['twitter']['appid'], _::$config['social']['twitter']['secret']);
			$tmp =  $connection->getRequestToken('http://boxza.com/settings/twitter/?call=twitter');
			_::user()->update(_::$my['_id'],array('$set'=>array('sc.tw.tmp'=>$tmp)));
			if($connection->http_code == 200)
			{
				 _::move($connection->getAuthorizeURL($tmp['oauth_token']));
			}
		}
		elseif($type=='del')
		{
			_::user()->update(_::$my['_id'],array('$unset'=>array('sc.tw'=>1)));
			_::move('/settings/twitter');
		}
	}
	elseif($social=='gg')
	{
		if($type=='new')
		{
			require_once ROOT.'handlers/google/Google_Client.php';
			require_once ROOT.'handlers/google/contrib/Google_PlusService.php';
			$client = new Google_Client();
			$client->setApplicationName("Login to BoxZa.com with Google API");
			$client->setClientId(_::$config['social']['google']['appid']);
			$client->setClientSecret(_::$config['social']['google']['secret']);
			$client->setRedirectUri('http://boxza.com/settings/google/?call=google');
			$client->setDeveloperKey(_::$config['social']['google']['key']);
			$plus = new Google_PlusService($client);
			
			  $client->setState(mt_rand());
			  _::move($client->createAuthUrl());
		}
		elseif($type=='del')
		{
			_::user()->update(_::$my['_id'],array('$unset'=>array('sc.gg'=>1)));
			_::move('/settings/google');
		}
	}
}

function settings($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$user=_::user();
	if($arg['setting']=='name')
	{
		$arg['first']=trim(just_clean($arg['first']));
		$arg['last']=trim(just_clean($arg['last']));
		if(mb_strlen($arg['first'],'utf-8')<2)
		{
			$ajax->alert('กรุณากรอกชื่ออย่างน้อย 2 ตัวอักษร');
		}
		elseif(mb_strlen($arg['last'],'utf-8')<2)
		{
			$ajax->alert('กรุณากรอกนามสกุลอย่างน้อย 2 ตัวอักษร');
		}
		else
		{
			$user->update(_::$my['_id'],array('$set'=>array('if.fn'=>mb_substr($arg['first'],0,30,'utf-8'),'if.ln'=>mb_substr($arg['last'],0,30,'utf-8'))));
			$ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
			$ajax->alert('แก้ไขชื่อ-นามสกุลเรียบร้อยแล้ว');
		}
	}
	elseif($arg['setting']=='profile')
	{		
		$bday = intval($arg['bday']);
		$bmonth = intval($arg['bmonth']);
		$byear = intval($arg['byear']);
		$ws=array();
		$_gdk=array_keys(_::$config['gender']);
		$arg['relate']=intval($arg['relate']);
		if(!in_array($arg['gender'],$_gdk))
		{
			$ajax->alert('กรุณาเลือกเพศ');
		}
		elseif(!isset(_::$config['relate'][$arg['relate']]))
		{
			$ajax->alert('กรุณาเลือกสถานะความสัมพันธ์');
		}
		elseif(($bday<1||$bday>31)||($bmonth<1||$bmonth>12)||($byear<date('Y')-110||$byear>date('Y')-10))
		{
			$ajax->alert('กรุณาเลือกวันเดือนปีเกิด');
		}
		elseif(strval($arg['prov'])=='')
		{
			$ajax->alert('กรุณาเลือกจังหวัด');
		}
		else
		{
			if($arg['relate']!=intval(_::$my['if']['rl']))
			{
				$db->update('line',array('u'=>_::$my['_id'],'ty'=>'relate'),array('$set'=>array('hi'=>1)),array('multiple'=>true));				
				$op_rl=intval(_::$my['op']['pf']['rl']);									
				if((_::$config['relate'][$arg['relate']]) && ($op_rl<3))
				{
					$db->insert('line',array('u'=>_::$my['_id'],'tt'=>$arg['relate'],'ty'=>'relate','in'=>array($op_rl==2?-1:0)));
				}
			}
			$user->update(_::$my['_id'],array('$set'=>array(
																															'if.gd'=>$arg['gender'],
																															'if.bd'=>new MongoDate(strtotime($byear.'-'.substr('0'.$bmonth,-2).'-'.substr('0'.$bday,-2))),
																															'if.bdk'=>strval(intval($bmonth).'-'.intval($bday)),
																															'if.pr'=>intval($arg['prov']),
																															'if.rl'=>$arg['relate'],
																															'pf.if'=>mb_substr(trim(strip_tags(strval($arg['info']))),0,1000,'utf-8'),
																															'pf.ws'=>$ws,
																															)));
			$ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
			$ajax->alert('แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว');
		}
	}
	elseif($arg['setting']=='url')
	{
		$link = strtolower(trim($arg['url']));
		$invalid = require(ROOT.'handlers/boxza/invalid-sub.php');
		if(!preg_match('/^([0-9]+)$/',_::$my['link']))
		{
			$ajax->alert('คุณกำหนดลิ้งค์โปรไฟล์ไปเรียบร้อยแล้ว');
			$ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
		}
		elseif(preg_match('/^([a-z0-9]{1})([a-z0-9\.\-]{1,28})([a-z0-9]{1})$/',$link,$c))
		{
			if(strpos($link,'..')>-1 || strpos($link,'--')>-1 || strpos($link,'.-')>-1 || strpos($link,'-.')>-1)
			{
				$ajax->alert('ไม่สามารถใช้ . หรือ - ติดกันได้');
			}
			elseif(preg_match('/^([0-9]+)$/',$link))
			{
				$ajax->alert('ไม่สามารถใช้เฉพาะตัวเลขได้');
			}
			elseif(is_numeric($link))
			{
				$ajax->alert('ไม่สามารถใช้เฉพาะตัวเลขได้');
			}
			elseif(preg_match('/(.+)\.(php|js|css|htm|html|jpg|jpeg|png|gif)$/',$link))
			{
				$ajax->alert('ไม่สามารถใช้ลิ้งค์โปรไฟล์นี้ได้');
			}
			elseif(strpos($link,'boxza')>-1 || strpos($link,'google')>-1 || strpos($link,'facebook')>-1 || strpos($link,'twitter')>-1 || strpos($link,'sanook')>-1 || strpos($link,'kapook')>-1 || strpos($link,'mthai')>-1)
			{
				$ajax->alert('ไม่สามารถใช้งานลิ้งค์นี้ได้');
			}
			elseif(in_array($link,$invalid))
			{
				$ajax->alert('ไม่สามารถใช้งานลิ้งค์นี้ได้');
			}
			elseif($db->findOne('user',array('if.lk'=>$link),array('if'=>1)))
			{
				$ajax->alert('ลิ้งค์นี้มีผู้ใช้งานแล้ว กรุณาใช้ลิ้งค์อื่น');
			}
			else
			{
				$user->update(_::$my['_id'],array('$set'=>array('if.lk'=>$link)));
				$ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
				$ajax->alert('แก้ไขลิ้งค์โปรไฟล์เรียบร้อยแล้ว');
			}
		}
		else
		{
			$ajax->alert('ไม่สามารถใช้งานลิ้งค์นี้ได้');
		}
	}
	elseif($arg['setting']=='password')
	{
		$len=mb_strlen(trim($arg['password_new']),'utf-8');
		$u=$db->findOne('user',array('_id'=>_::$my['_id']),array('pw'=>1));
		if(trim($arg['password_new'])!=$arg['password_new'])
		{
			$ajax->alert('ไม่สามารถใช้งานรหัสผ่านนี้ได้');
		}
		if($len<6||$len>30)
		{
			$ajax->alert('รหัสผ่านต้องมีความยาว 6-30 ตัวอักษร');
		}
		elseif($arg['password_new']!=$arg['password_confirm'])
		{
			$ajax->alert('กรุณายืนยันรหัสผ่านให้ถูกต้อง');
		}
		elseif(md5(md5($arg['password_old']))!=$u['pw'])
		{
			$ajax->alert('รหัสผ่านเดิมไม่ถูกต้อง');
		}
		else
		{
			$user->update(_::$my['_id'],array('$set'=>array('pw'=>md5(md5($arg['password_new'])))));
			$ajax->alert('แก้ไขรหัสผ่านเรียบร้อยแล้ว');
			$mail=_::mail();
			$template=_::template();
			$template->assign('pass',$arg['password_new']);
			$mail->message=$template->fetch('settings.password.mail');
			$mail->subject='ข้อมูลรหัสผ่านใหม่';
			$mail->to=_::$my['em'];
			$mail->send();
			$ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
		}
	}
	elseif($arg['setting']=='delete')
	{
		$u=$db->findOne('user',array('_id'=>_::$my['_id']),array('pw'=>1));
		if(md5(md5($arg['password_old']))!=$u['pw'])
		{
			$ajax->alert('รหัสผ่านไม่ถูกต้อง');
		}
		elseif(_::$my['am'])
		{
			$ajax->alert('ไอดีนี้ไม่สามารถยกเลิกได้ กรุณาติดต่อ support@boxza.com');
		}
		else
		{
			$db=_::db();
			_::user()->update(_::$my['_id'],array('$set'=>array('st'=>-1)));
			$db->update('line',array('u'=>_::$my['_id']),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
			$db->update('line',array('p'=>_::$my['_id']),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
			
			$db->update('chat',array('u'=>_::$my['_id']),array('$set'=>array('c-p'=>new MongoDate(),'c-u'=>new MongoDate())),array('multiple'=>true));
			$db->update('chat',array('p'=>_::$my['_id']),array('$set'=>array('c-p'=>new MongoDate(),'c-u'=>new MongoDate())),array('multiple'=>true));
			
			$db->update('deal',array('u'=>_::$my['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
			$db->update('video',array('u'=>_::$my['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
			$db->update('forum',array('u'=>_::$my['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
					
			$db->remove('notify',array('u'=>_::$my['_id']));
			$db->remove('notify',array('p'=>_::$my['_id']));
							
			$db->update('chatroom',array('u'=>_::$my['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
	
			$db->remove('friend',array('$or'=>array(array('u'=>_::$my['_id']),array('p'=>_::$my['_id']))));
	
			$db->update('user',array(),array('$pull'=>array('ct.ig'=>_::$my['_id'],'ct.bl'=>_::$my['_id'],'ct.bl2'=>_::$my['_id'],'ct.fr'=>_::$my['_id'],'ct.fq'=>_::$my['_id'])),array('multiple'=>true));

			$ajax->redirect('http://oauth.boxza.com/logout');
		}
	}
}

function sendconfirm()
{
	$db=_::db();
	$ajax=_::ajax();
	$user=_::user();
	$template=_::template();
	$last = $db->findOne('user',array('_id'=>_::$my['_id']),array('ec'=>1,'st'=>1));
	if($last)
	{
		$c=0;
		$mail = _::mail();
		$mail->to=_::$my['em'];
		$mail->subject = 'ยืนยันการสมัครสมาชิก - BoxZa Socail Network ของคนไทย';
		$template->assign('u',_::$my);
		if($last['st'])
		{
			$ajax->alert('คุณทำการยืนยันการสมัครสมาชิกเรียบร้อยแล้ว');
		}
		elseif($last['ec'])
		{
			$c = intval($last['ec']['c']);
			if($last['ec']['t'] && ($c>3) && ($last['ec']['t']->sec > (time()-3600)))
			{
				$ajax->alert('คุณมีการร้องขอส่งอีเมล์มากเกินไป กรุณารอ 1ชมเพื่อดำเนินการใหม่อีกครั้ง');
			}
			else
			{
				$template->assign('code',$last['ec']['p']);
				$mail->message = $template->fetch('settings.confirm.mail');
				$mail->send();
				$user->update(_::$my['_id'],array('$set'=>array('ec.c'=>($c+1),'ec.t'=>new MongoDate())));
				$ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '._::$my['em'].' แล้ว');
			}
		}
		else
		{
			$p=strtolower(substr(md5(rand(1,999999)),10,10));
			$user->update(_::$my['_id'],array('$set'=>array('ec'=>array('c'=>0,'p'=>$p,'t'=>new MongoDate()))));
			
			$template->assign('code',$p);
			$mail->message = $template->fetch('settings.confirm.mail');
			$mail->send();
			$ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '._::$my['em'].' แล้ว');
		}
	}
}

function just_clean($string)
{
	// Replace other special chars
	$s = '!@#$%^&*()_+-={}[]:";\'?/.,<>`~';
	for($i=0;$i<mb_strlen($s,'utf-8');$i++)
	{
		$string = str_replace(mb_substr($s,$i,1,'utf-8'),'', $string);
		$string = str_replace('  ',' ', $string);
	}
	return trim($string);
}

function oprank($i,$max=3)
{
	$i=intval($i);
	if($i<0 || $i>$max)
	{
		$i=0;
	}
	return $i;
}


function setline($arg)
{
	if(_::$my)
	{
		$line=(in_array($arg['line'],array('hot','friends','me'))?$arg['line']:'hot');
		_::user()->update(_::$my['_id'],array('$set'=>array('op.ln'=>$line)));
		_::ajax()->alert('ตั้งค่าเริ่มต้นสำหรับไลน์เรียบร้อยแล้ว');
	}
}

function unblock($uid)
{
		$user = _::user();
		$user->update(_::$my['_id'],array('$pull'=>array('ct.bl'=>intval($uid))));
		$user->update(intval($uid),array('$pull'=>array('ct.bl2'=>_::$my['_id'])));
}

function changeemail($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$template=_::template();
	$email=strtolower($arg['email']);
	
	
	$invalid_domain=require(ROOT.'handlers/boxza/invalid-domain.php');
	
	$domain2=explode('@', $email);
	$domain = array_pop($domain2);
    
	if($email==_::$my['em'])
	{
		$ajax->alert('คุณใช้อีเมล์นี้เรียบร้อยแล้ว');
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$ajax->alert('กรุณากรอกอีเมล์ให้ถูกต้อง');
	}
	elseif(strpos($email,'facebook')>-1)
	{
		$ajax->alert('ไม่สามารถใช้อีเมล์ '.$email.' นี้ได้');
	}
	elseif(in_array($domain, $invalid_domain))
    {
    	$error['email'] = 'ไม่สามารถใช้งานอีเมล์นี้ได้';
	 }
	elseif($db->count('user',array('em'=>$email)))
	{
		$ajax->alert('อีเมล์นี้มีผู้ใช้งานแล้ว');
	}
	else
	{
		if($last = $db->findOne('user',array('_id'=>_::$my['_id']),array('ec'=>1,'st'=>1)))
		{
			$c=0;
			$mail = _::mail();
			$mail->to=$email;
			$mail->subject = 'ยืนยันการแก้ไขอีเมล์ - BoxZa Socail Network ของคนไทย';
			$template->assign('u',_::$my);
			
			$p=strtolower(substr(md5(_::$my['_id'].'-'.$email),5,15));
			$template->assign('code',$p);
			$template->assign('email',$email);
			if($last['ec'])
			{
				$c = intval($last['ec']['c']);
				if($last['ec']['t'] && ($c>3) && ($last['ec']['t']->sec > (time()-3600)))
				{
					$ajax->alert('คุณมีการร้องขอส่งอีเมล์มากเกินไป กรุณารอ 1ชมเพื่อดำเนินการใหม่อีกครั้ง');
				}
				else
				{
					$mail->message = $template->fetch('settings.change.mail');
					$mail->send();
					_::user()->update(_::$my['_id'],array('$set'=>array('ec.c'=>($c+1),'ec.p'=>$p,'ec.em'=>$email,'ec.t'=>new MongoDate())));
					$ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '.$email.' แล้ว');
				}
			}
			else
			{
				_::user()->update(_::$my['_id'],array('$set'=>array('ec'=>array('c'=>0,'p'=>$p,'em'=>$email,'t'=>new MongoDate()))));
				$mail->message = $template->fetch('settings.change.mail');
				$mail->send();
				$ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '.$email.' แล้ว');
			}
		}
	}
}
?>