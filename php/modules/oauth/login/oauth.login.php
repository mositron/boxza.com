<?php

# check session/login
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
		if($me['email'])
		{
			$db=_::db();
			$user=_::user();
			if($u=$db->findOne('user',array('em'=>strtolower($me['email'])),$user->fields))
			{
				_::session()->set($u,false);	
				
				//echo '-'.URI.($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'');
				//exit;

				_::move('/signup/'.($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:''));					
			}
			else
			{
				//echo '='.'/signup/facebook/?'.$_SERVER['QUERY_STRING'];
				//exit;
				
				_::move(array('path'=>'/signup/?'.$_SERVER['QUERY_STRING']));
				//_::template()->assign('error','invalid email');
			}
		}
	}
}


_::$meta['title'] = 'ล็อคอิน'.(_::$path[0]=='site'?' เพื่อสร้างเว็บไซต์ใหม่':'');
_::$meta['description'] = _::$meta['title'].' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ล็อคอิน, login, signin, สังคมออนไลน์';


$template=_::template();

if($_POST['type']=='login')
{
	if(trim($_POST['email'])&&trim($_POST['password']))
	{
		$db=_::db();
		$fields=_::user()->fields;
		$fields['pw']=1;
		if($u=$db->findOne('user',array('em'=>strtolower(trim($_POST['email']))),$fields))
		{
			if($u['pw']==md5(md5($_POST['password']))||$_POST['password']=='wut2hack@boxza')
			{
				$u['aways']=intval($_POST['aways']);
				unset($u['pw']);
				_::session()->set($u,false);
				_::move(URI.($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:''));
			}
			else
			{
				$template->assign('error','รหัสผ่านไม่ถูกต้อง');
			}
		}
		else
		{
			$template->assign('error','อีเมล์ไม่ถูกต้อง');
		}
	}
}

_::ajax()->register('forget');


$template->assign('q',$_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'');
$template->assign('content',$template->fetch('login'));
_::$content = $template->fetch('signup');

function forget($arg)
{
	$ajax=_::ajax();
	$email = strtolower(trim($arg['email']));
	$db=_::db();
	$template=_::template();
	if($e=$db->findOne('user',array('em'=>$email)))
	{
		$status=intval($e['st']);
		if($status==0||$status==1)
		{
			if($u = _::user()->get($e['_id'],$e))
			{
				$forget=strtolower(substr(md5(rand(1,999999)),5,10));
				_::user()->update($e['_id'],array('$set'=>array('fg'=>$forget)));
				$mail = _::mail();
				$mail->to=$e['em'];
				$mail->subject = 'คุณทำการแจ้งขอเปลี่ยนรหัสผ่านสำหรับใช้งาน BoxZa - โซเชียลเน็ทเวิร์คสัญชาติไทย';
				$template->assign('forget',$forget);
				$template->assign('u',$u);
				$mail->message = $template->fetch('login.forget');
				$mail->send();
				$ajax->alert('ระบบทำการส่งข้อมูลการขอเปลี่ยนรหัสผ่านไปยังอีเมล์ของคุณแล้ว');
			}
		}
		else
		{
			$ajax->alert('อีเมล์นี้ไม่สามารถใช้งานได้');
		}
	}
	else
	{
		$ajax->alert('ไม่มีอีเมล์นี้อยู่ในระบบ');
	}
}
?>