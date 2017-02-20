<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
);


if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.gold.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.gold.home.php');
}


echo $template->fetch('gold');
exit;
?>