<?php

_::$meta['title'] = 'รูปภาพทั้งหมด - '._::$meta['title'];
_::$meta['description'] = 'รูปภาพทั้งหมด - '._::$meta['description'];

#if(!_::$content=$cache->get('ca1','boyz_home'))
#{
	$template->assign('image',_::db()->find('image',array('dd'=>array('$exists'=>false)),array('_id'=>1,'ty'=>1,'fd'=>1,'f'=>1),array('sort'=>array('_id'=>-1),'limit'=>200)));
	_::$content=$template->fetch('recent');


#	$cache->set('ca1','boyz_home',_::$content,false,300);
#}

?>