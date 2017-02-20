<?php

_::$config['social']['facebook']['appid']='520600121372730';

define('APP_VERSION','1.0');


$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'new'=>'new',
						'recent'=>'recent',
						'share'=>'share',
						'item'=>'item',
						'view'=>'view',
);

$cate=array();

$template->assign('cate',$cate);
if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.cooked.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.cooked.home.php');
}


echo $template->fetch('cooked');
exit;
?>