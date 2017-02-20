<?php

if(_::$config['block'])
{
	if($_COOKIE[_::$config['block']])
	{
		require_once(ROOT.'modules/www/system/www.system.forward.php');
	}
	else
	{
		$db=_::db();
		$p=trim((string)$_SERVER['REMOTE_ADDR']);
		if((substr($p,0,8)!='192.168.')&&(strlen($p)>7))
		{
			if($idp=$db->findone('block_ip',array('ip'=>$p,'du'=>array('$gte'=>new mongodate(time()-(3600*24))))))
			{
				setcookie(_::$config['block'],'YES-IP',time()+2592000,'/',_::$config['domain'],false,true);
				require_once(ROOT.'modules/www/system/www.system.forward.php');
			}
		}
	}
}

# run - web application   ( 'link' => 'folder' )
require_once(
	_::run(
		array(
			'' => 'home',
			'home' => 'home',
			'login' => 'login',
			'logout' => 'logout',
			'signup' => 'signup',
			'confirm' => 'confirm',
			'forget'=>'forget',
		)
	)
);

_::template()->display('content');
?>