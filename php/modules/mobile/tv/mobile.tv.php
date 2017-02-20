<?php

define('APP_VERSION','1.0');

$tv=array(
					'home'=>array()

);

$template=_::template();
$template->assign('tv',$tv);

$serv=array(
						''=>'home',
						'news'=>'news',
						'music'=>'music',
						'cartoon'=>'cartoon',
						'movie'=>'movie',
						'entertain'=>'entertain',
						'sport'=>'sport',
						'knowledge'=>'knowledge',
						'apps'=>'apps',
);


if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.tv.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.tv.home.php');
}


echo $template->fetch('tv');
exit;
?>
