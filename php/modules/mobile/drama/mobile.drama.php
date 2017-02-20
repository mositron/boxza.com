<?php

define('APP_VERSION','1.0');


$template=_::template();

$serv=array(
						''=>'home',
						'home'=>'home',
						'sitcom'=>'sitcom',
						'variety'=>'variety',
						'series'=>'series',
						'view'=>'view',
						'apps'=>'apps',
);


if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.drama.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.drama.home.php');
}


echo $template->fetch('drama');
exit;
?>