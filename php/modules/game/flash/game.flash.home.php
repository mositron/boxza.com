<?php

_::$dbclick=2;

$cache=_::cache();
if(!_::$content=$cache->get('ca1','game_flash_home'))
{
	//_::time();
	$db=_::db();
	$template=_::template();

	$flash=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>72));
	$template->assign('flash',$flash);
	_::$content=$template->fetch('flash.home');


	$cache->set('ca1','game_flash_home',_::$content,false,3600);
}
?>