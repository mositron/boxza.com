<?php

# check session/login
_::session();

if(!_::$path[0])
{
	_::move(array('sub'=>'social','path'=>'/'));
}
list($uid,$code)=explode('.',_::$path[0],2);

$error='';
$change=false;

$template=_::template();
$db=_::db();
if((strlen($code)==10||strlen($code)==15)&& $found=$db->findOne('user',array('_id'=>intval($uid),'ec.p'=>$code)))
{
	$status=intval($found['st']);
	if($status==0||$status==1)
	{
		if(strlen($code)==10)
		{
			if(!$found['st'])
			{
				_::user()->update($found['_id'],array('$set'=>array('st'=>1),'$unset'=>array('ec'=>1)));
				if(_::$my)
				{
					_::$my['st']=1;
				}
			}
		}
		elseif($found['ec']['em'])
		{
			$change=true;
			if($db->count('user',array('em'=>$found['ec']['em'])))
			{
				$template->assign('error','อีเมล์นี้มีผู้ใช้งานแล้ว');
				$found=false;
			}
			else
			{
				$template->assign('email',$found['ec']['em']);
				_::user()->update($found['_id'],array(
																										'$set'=>array('em'=>$found['ec']['em'],'st'=>1),
																										'$unset'=>array('ec'=>1),
																										'$push'=>array('el'=>array('o'=>$found['em'],'n'=>$found['ec']['em'],'t'=>new MongoDate()))
																										));
				_::session()->logout();
				_::$my=NULL;
			}
		}
	}
}
else
{
	$found=false;
}
_::$meta['title'] = 'ยืนยันการสมัครสมาชิก';
_::$meta['description'] = _::$meta['title'].' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ล็อคอิน, เข้าระบบ, login, signin, สังคมออนไลน์';

$template->assign('change',$change);
$template->assign('found',$found);
$template->assign('content',$template->fetch('confirm'));
_::$content = $template->fetch('signup');

?>