<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'lottery'=>'lottery',
						'lottery-last'=>'lottery-last',
						'set'=>'set',
						'news'=>'news',
						'apps'=>'apps',
);

if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.lotto.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.lotto.home.php');
}


echo $template->fetch('lotto');
exit;
?>