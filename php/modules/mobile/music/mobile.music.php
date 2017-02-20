<?php

define('APP_VERSION','2.1');

$template=_::template();

$serv=array(
						'' => 'home',
						'home' => 'home',
						'song'=>'song',
						'news'=>'news',
						'apps'=>'apps',
);

if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.music.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.music.home.php');
}


echo $template->fetch('music');
exit;
?>