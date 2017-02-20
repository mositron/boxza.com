<?php
define('HIDE_REQUEST',1);

//$cache=_::cache();
#if(!$data=$cache->get('ca1','app-fb'))
#{
	//$data=array();
	$db=_::db();
	$sticker=$db->find('sticker',array('pl'=>1,'dd'=>array('$exists'=>false)),array('t'=>1,'fd'=>1,'f'=>1,'img'=>1),array('sort'=>array('_id'=>-1),'limit'=>30));
	
#	$cache->set('ca1','app-fb',$data,false,600);
#}
$template=_::template();
$template->assign('sticker',$sticker);
_::$content=$template->fetch('home');

?>