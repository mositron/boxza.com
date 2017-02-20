<?php
_::session();

if(_::$my)
{
	if($_GET['appid'] && isset(_::$config['apps'][$_GET['appid']]))
	{
		$r=_::$config['apps'][$_GET['appid']];
		$data=array('_id'=>_::$my['_id']);
		$data['algorithm'] = 'HMAC-SHA256';
		$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
		$s = strtr(base64_encode(hash_hmac('sha256', $d, $r['secret'], true)), '+/', '-_');
		//echo $r['uri'].'?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d;
		//exit;
		_::move($r['uri'].'login/?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d);
	}
	elseif($_GET['redirect_uri'])
	{
		_::move($_GET['redirect_uri']);
	}
	else
	{
		_::move(array('sub'=>'social','path'=>'/'));
	}
}

_::$meta['title'] = 'สมัครสมาชิก';
_::$meta['description'] = _::$meta['title'].' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'สมัครสมาชิก, signup, สังคมออนไลน์';


$ip=$_SERVER['REMOTE_ADDR'];

$province = require(HANDLERS.'boxza/province.php');

$template = _::template();
$template->assign('q',$_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'');
$template->assign('province',$province);

$db=_::db();
/*
if($blockip=$db->findone('blockip',array('ip'=>$ip)))
{
	$template->assign('blockip',$blockip);
}
else*/
if(in_array('facebook',_::$path))
{
	
	require_once(HANDLERS.'facebook/facebook.php');	
	$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']));
	
	if(!($uid=$facebook->getUser()) || !isset($_GET['code']))
	{
		_::move($facebook->getLoginUrl(array('scope'=>'offline_access,email,publish_stream,user_birthday,user_location,manage_pages,photo_upload')));
	}
	if ($uid)
	{
		$accessToken = $facebook->getAccessToken();	
		$me = $facebook->api('/me');
		$me['email']=strtolower($me['email']);
		$value=array();
		$user=_::user();
		if(!$me['verified'] || strpos($me['email'],'facebook')>-1)
		{
			$value['error'] = 'ไม่สามารถสมัครสมาชิกด้วย Email หรือ FB Account นี้ได้';
		}
		elseif($u=$db->findOne('user',array('em'=>$me['email']),$user->fields))
		{
			_::session()->set($u,false);	
			//_::move(URI.($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:''));
			if($_GET['appid'] && isset(_::$config['apps'][$_GET['appid']]))
			{
				$r=_::$config['apps'][$_GET['appid']];
				$data=array('_id'=>_::$my['_id']);
				$data['algorithm'] = 'HMAC-SHA256';
				$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
				$s = strtr(base64_encode(hash_hmac('sha256', $d, $r['secret'], true)), '+/', '-_');
				//echo $r['uri'].'?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d;
				//exit;
				_::move($r['uri'].'login/?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d);
			}
			elseif($_GET['redirect_uri'])
			{
				_::move($_GET['redirect_uri']);
			}
			else
			{
				_::move(array('sub'=>'social','path'=>'/'));
			}
		}
		elseif($_POST['fbid']==$me['id'])
		{
			$value = $_POST;
			$value['email'] = strtolower($me['email']);
			$value['fbid'] = $me['id'];
			$value['status']=1;
			signup_facebook($value,$facebook,$accessToken);
		}
		else
		{
			$value['firstname'] = $me['first_name'];
			$value['lastname'] = $me['last_name'];
			$value['email'] = strtolower($me['email']);
			$value['fbid'] = $me['id'];
			$value['gender'] = substr($me['gender'],0,1);
			$birthday = explode('/',$me['birthday']);
			$value['bday'] = $birthday[1];
			$value['bmonth'] = $birthday[0];
			$value['byear'] = $birthday[2];
			
			$location=explode(',',$me['location']['name']);
			$loc = strtolower(trim($location[0]));
			foreach($province as $k=>$v)
			{
				if($loc==strtolower($v['name_en']))
				{
					$value['province']=$k;
					break;
				}
			}
		}
		$template->assign('value',$value);
	}
	$template->assign('content',$template->fetch('signup.facebook'));
}
else
{
	if($_POST)
	{
		signup_email($_POST);
	}
	$template->assign('content',$template->fetch('signup.email'));
}
_::$content = $template->fetch('signup');

function signup_facebook($arg,$fb,$fbtoken)
{
	_::folder()->mkdir('bin/fb');
	$arg['photo']  = FILES.'bin/fb/'.$arg['fbid'].'.jpg';
	@copy('http://graph.facebook.com/'.$arg['fbid'].'/picture/?type=large', $arg['photo']);
	signup($arg,$fb,$fbtoken);
	_::folder()->delete('bin/fb/'.$arg['fbid'].'.jpg');
}

function signup_email($arg)
{
	$arg['photo']  = $_FILES['photo']['tmp_name'];
	unset($arg['fbid']);
	signup($arg);
}

function signup($arg,$fb=false,$fbtoken=false)
{
	$arg['email']=strtolower($arg['email']);
	$error = array();
	$fields = array(
										'email'=>array('func'=>'check_email'),
										'password'=>array('min'=>6,'max'=>30),
										'firstname'=>array('min'=>2,'max'=>30),
										'lastname'=>array('min'=>2,'max'=>30),
	);
	
	$arg['firstname']=trim(just_clean($arg['firstname']));
	$arg['lastname']=trim(just_clean($arg['lastname']));
		
	foreach($fields as $key=>$val)
	{
		$v = validate(trim(strval($arg[$key])),$fields[$key]);
		if($v['status']!='OK') $error[$key]=$v['message'];
	}
	
	$invalid_domain=require(HANDLERS.'boxza/invalid-domain.php');
	$domain2=explode('@', $arg['email']);
	$domain = array_pop($domain2);
    if(in_array($domain, $invalid_domain))
    {
    	$error['email'] = 'ไม่สามารถใช้งานอีเมล์นี้ได้';
	 }
	 
	
	if(trim($arg['password'])!=$arg['password'])
	{
		$error['password'] = 'ไม่สามารถใช้ช่องว่างเป็นรหัสผ่านได้';
	}
	if(!trim($arg['terms']))
	{
		$error['terms'] = 'ยังไม่ได้ยอมรับเงื่อนไขการใช้งาน';
	}
	$_gdk=array_keys(_::$config['gender']);
	if(!in_array($arg['gender'],$_gdk))
	{
		$error['gender'] = 'กรุณาเลือกเพศ';
	}
	if(strval($arg['province'])=='')
	{
		$error['province'] = 'กรุณาเลือกจังหวัด';
	}
	$bday = intval($arg['bday']);
	$bmonth = intval($arg['bmonth']);
	$byear = intval($arg['byear']);
	if(($bday<1||$bday>31)||($bmonth<1||$bmonth>12)||($byear<date('Y')-110||$byear>date('Y')-10))
	{
		$error['birthday'] = 'กรุณาเลือกวันเดือนปีเกิด';
	}
	if(!$arg['fbid'])
	{
		if(!$arg['photo'])
		{
			$error['photo'] = 'กรุณาเลือกไฟล์รูปภาพ';
		}
		else
		{
			$ftype=getimagesize($arg['photo']);
			if(!in_array($ftype['mime'],array('image/gif','image/jpeg','image/png')))
			{
				$error['photo'] = 'ไฟล์รูปภาพไม่ถูกต้อง';
			}
		}
	}
	if(!count($error))
	{
		$insert = array(
									'if'=>array(			
													'fn'=>trim($arg['firstname']),
													'ln'=>trim($arg['lastname']),
													'gd'=>$arg['gender'],
													'pr'=>intval($arg['province']),
													'bd'=>new MongoDate(strtotime($byear.'-'.substr('0'.$bmonth,-2).'-'.substr('0'.$bday,-2).' 00:00:00')),
													'bdk'=>strval(intval($bmonth).'-'.intval($bday)),
													'fd'=>'',
													'fs'=>'',
													'ac'=>1,
													'fl'=>0
									),
									'ct'=>array(
													'fr'=>array(),
													'rq'=>array(),
													'ig'=>array(),
													'bl'=>array(),
													'fl'=>array(),
													'gp'=>array(array('n'=>'เพื่อนสนิท','u'=>array()))
									),
									'nf'=>array('fr'=>0),
									'op'=>array('ol'=>0,'sd'=>1),
									'em'=>$arg['email'],
									'pw'=>md5(md5($arg['password'])),
									'ip'=>$_SERVER['REMOTE_ADDR'],
							);
		//$insert['em']=strtolower($insert['em']);
		$insert['st'] = ($arg['status']?1:0);
		if($arg['fbid']) 
		{
			$insert['sc'] = array('fb'=>array('id'=>$arg['fbid'],'token'=>$fbtoken));
		}
		
		$db=_::db();
		if($uid=$db->insert('user',$insert))
		{
			$fs = _::folder()->fd($uid,false);
			$fd = _::folder()->fd($uid,true);
			$db->update('user',array('_id'=>$uid),array('$set'=>array('if.fd'=>$fd,'if.fs'=>$fs,'if.lk'=>strval($uid))));
			
			_::session()->set(array('_id'=>$uid,'pw'=>$insert['pw']),false);
			$db->insert('line',array('u'=>$uid,'ty'=>'signup','in'=>array(0),'ex'=>new MongoDate(time()+_::$config['line_expire'])));
			try{
				_::upload()->send('s1','upload','@'.$arg['photo'],array('name'=>'s','folder'=>'profile/'.$fd,'width'=>50,'height'=>50,'fix'=>'bothtop','type'=>'jpg'));
				_::upload()->send('s1','upload','@'.$arg['photo'],array('name'=>'n','folder'=>'profile/'.$fd,'width'=>200,'height'=>200,'fix'=>'bothtop','type'=>'jpg'));
				
				@unlink($arg['photo']);
			} catch (Exception $e) {}
			
			
			if($fb)
			{
				$attachment = array('message' => 'ได้เข้าสู่โลกของ BoxZa แล้ว',
				'name' => 'BoxZa',
				'caption' => "สมัครสมาชิกที่ boxza.com",
				'link' => 'http://boxza.com/',
				'description' => 'สมัครสมาชิกด้วย Facebook Account',
				'picture' => 'http://s1.boxza.com/profile/'.$fd.'/s.jpg',
				'actions' => array(array('name' => 'สมัครสมาชิกเดี๋ยวนี้!.','link' => 'http://oauth.boxza.com/signup/facebook/'))
				);
				try{
					$fb->api('/me/feed', 'post', $attachment);
				} catch (FacebookApiException $e) {}
			}
			
			if(!$insert['st'])
			{
				$user = _::user();
				$template = _::template();
				$mail = _::mail();
				$mail->to=$insert['em'];
				$mail->subject = 'ยืนยันการสมัครสมาชิก BoxZa - โซเชียลเน็ทเวิร์คสัญชาติไทย';
				$template->assign('u',$insert);
				$template->assign('uid',$uid);
				$template->assign('img','http://s1.boxza.com/profile/'.$fd.'/s.jpg');
				$p=strtolower(substr(md5(rand(1,999999)),10,10));
				$user->update($uid,array('$set'=>array('ec'=>array('c'=>0,'p'=>$p,'t'=>new MongoDate()))));
				$template->assign('code',$p);
				$mail->message = $template->fetch('signup.confirm.mail');
				$mail->send();		
			}
			
			
			if($_GET['appid'] && isset(_::$config['apps'][$_GET['appid']]))
			{
				$r=_::$config['apps'][$_GET['appid']];
				$data=array('_id'=>_::$my['_id']);
				$data['algorithm'] = 'HMAC-SHA256';
				$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
				$s = strtr(base64_encode(hash_hmac('sha256', $d, $r['secret'], true)), '+/', '-_');
				_::move($r['uri'].'login/?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d);
			}
			elseif($_GET['redirect_uri'])
			{
				_::move($_GET['redirect_uri']);
			}
			else
			{
				_::move(array('sub'=>'www','path'=>'/line'.($inser['ref']?'/?ref='.$inser['ref']:'')));
			}
		}
		else
		{
			#_::ajax()->alert('ไม่สามารถสมัครได้ในขณะนี้ กรุณาลองใหม่ภายหลัง.');
		}
	}
	else
	{
		_::template()->assign('error',$error);
		_::template()->assign('value',$_POST);
	}
	
	
}

function validate($val,$prop)
{
	$len = mb_strlen($val,'utf-8');
	if(is_numeric($prop['min']) && $len<$prop['min'])
	{
		return array('status'=>'FAIL','message'=>'ขั้นต่ำ '.$prop['min'].' ตัวอักษร');
	}
	if(is_numeric($prop['max']) && $len>$prop['max'])
	{
		return array('status'=>'FAIL','message'=>'ไม่เกิน '.$prop['max'].' ตัวอักษร');
	}
	if($prop['func'])
	{
		$v = call_user_func($prop['func'],$val);
		if($v['status']!='OK')return $v;
	}
	return array('status'=>'OK');
}
function check_email($email)
{
	#if(preg_match('/^[\w.-]+@([\w.-]+\.)+[a-z]{2,6}$/is', $email))
	if(filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		return _::db()->count('user',array('em'=>strtolower($email)))?array('status'=>'FAIL','message'=>'อีเมล์นี้มีผู้ใช้งานแล้ว - <a href="'._::uri(array('sub'=>'oauth','path'=>'/login/'.(in_array('site',_::$path)?'site/':''))).'">ล็อคอินด้วยอีเมลล์นี้ คลิกที่นี่</a>'):array('status'=>'OK');
	}
	else
	{
		return array('status'=>'FAIL','message'=>'กรุณากรอกอีเมล์ให้ถูกต้อง');
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
?>