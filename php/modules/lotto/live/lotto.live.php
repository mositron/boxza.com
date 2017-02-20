<?php


	$template=_::template();
	$lotto=_::db()->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array(),array('sort'=>array('tm'=>-1),'limit'=>1));
	$tm=time::show($lotto[0]['tm'],'date');

	_::$meta['title'] = 'ถ่ายทอดหวย ตรวจหวยออนไลน์ ถ่ายทอดสดหวย ถ่ายทอดผลหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm;
	_::$meta['description'] = 'ถ่ายทอดหวย, ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว';
	_::$meta['keywords'] = 'ถ่ายทอด, ตรวจหวย, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด';

	$template=_::template();
	_::$content=$template->fetch('live');


#	$cache->set('ca1','lotto_home',_::$content,false,3600);
#}
?>