<?php

if($b=$_GET['u'])
{
	_::db()->insert('adsense_click',array('u'=>$_GET['u'],'kd'=>date('Y-m-d'),'km'=>date('Y-m'),'t'=>strval($_GET['t']),'r'=>strval($data['r']),'ip'=>$_SERVER['REMOTE_ADDR'],'ua'=>$_SERVER['HTTP_USER_AGENT']));
}

exit;


?>