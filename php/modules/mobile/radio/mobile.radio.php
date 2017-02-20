<?php

define('APP_VERSION','2.2');

$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
);


if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.radio.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.radio.home.php');
}


echo $template->fetch('radio');
exit;
?>