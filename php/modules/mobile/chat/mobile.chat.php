<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'room'=>'room'
);


if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.chat.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.chat.home.php');
}


echo $template->fetch('chat');
exit;
?>