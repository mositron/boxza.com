<?php

# check session/login
_::session();

if(_::$my)
{
	if($_GET['redirect_uri'])
	{
		_::move($_GET['redirect_uri']);
	}
	else
	{
		_::move(array('sub'=>'social','path'=>'/'));
	}
}
if(!_::$path[0])
{
	_::move(array('sub'=>'social','path'=>'/'));
}
list($uid,$forget)=explode('.',_::$path[0],2);


$template=_::template();
$db=_::db();
if(strlen($forget)==10 && $found=$db->findOne('user',array('_id'=>intval($uid),'fg'=>$forget)))
{
	$status=intval($found['st']);
	if($status==0||$status==1)
	{
		$pass=strtolower(substr(md5(rand(1,999999)),10,10));
		$u = _::user()->get($found['_id'],$found);
		_::user()->update($found['_id'],array('$set'=>array('pw'=>md5(md5($pass))),'$unset'=>array('fg'=>1)));
		$mail = _::mail();
		$mail->to=$found['em'];
		$mail->subject = 'รหัสผ่านใหม่สำหรับใช้งาน BoxZa - โซเชียลเน็ทเวิร์คสัญชาติไทย';
		$template->assign('email',$found['em']);
		$template->assign('pass',$pass);
		$template->assign('u',$u);
		$mail->message = $template->fetch('forget.password');
		$mail->send();
	}
}
else
{
	$found=false;
}
_::$meta['title'] = 'ลืมรหัสผ่าน';
_::$meta['description'] = _::$meta['title'].' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ล็อคอิน, เข้าระบบ, login, signin, สังคมออนไลน์';


$template->assign('found',$found);
$template->assign('content',$template->fetch('forget'));
_::$content = $template->fetch('signup');

?>