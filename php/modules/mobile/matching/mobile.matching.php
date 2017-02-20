<?php

_::$config['social']['facebook']['appid']='1503674803191830';

define('APP_VERSION','1.0');


$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'help'=>'help',
						'top'=>'top',
						'game'=>'game',
						'score'=>'score',
);

$cate=array();

$template->assign('cate',$cate);
if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.matching.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.matching.home.php');
}


echo $template->fetch('matching');
exit;
?>