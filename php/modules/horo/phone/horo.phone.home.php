<?php

_::$dbclick=2;

_::$meta['title'] = 'ดูดวงเบอร์มือถือ - '._::$meta['title'];
_::$meta['description'] = ' ดูดวงเบอร์มือถือ - '._::$meta['description'];

$cache=_::cache();
if(!_::$content=$cache->get('ca1','horo_phone'))
{
	$db=_::db();
	
	$template->assign('phone',$db->find('horo_phone',array(),array('_id'=>1,'d'=>1)));
	_::$content=$template->fetch('phone.home');


	$cache->set('ca1','horo_phone',_::$content,false,3600);
}
?>


