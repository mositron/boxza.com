<?php


$template=_::template();

$serv=array(
						''=>'home',
						'lottery'=>'lottery',
						'set'=>'set',
						'news'=>'news',
						'apps'=>'apps',
);

if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/lotto.mobile.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/lotto.mobile.home.php');
}


echo $template->fetch('mobile');
exit;
?>