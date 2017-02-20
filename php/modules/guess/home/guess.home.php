<?php
define('HIDE_REQUEST',1);

$cache=_::cache();
#if(!$data=$cache->get('ca1','app-fb'))
#{
	$data=array();
	$db=_::db();
	$data['app']=$db->find('guess',array('pl'=>1,'dd'=>array('$exists'=>false)),array('t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'do'=>1,'u'=>1,'f'=>1),array('sort'=>array('do'=>1),'limit'=>30));
	$data['appn']=$db->find('guess',array('pl'=>1,'dd'=>array('$exists'=>false)),array('t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'do'=>1,'u'=>1,'f'=>1),array('sort'=>array('_id'=>-1),'limit'=>21));
	

	
	shuffle($data['app']);
	$data['app'] = array_slice($data['app'],0,6);
#	$cache->set('ca1','app-fb',$data,false,600);
#}
$template=_::template();
$template->assign('user',_::user());
$template->assign('app',$data['app']);
$template->assign('appn',$data['appn']);
_::$content=$template->fetch('home');

?>