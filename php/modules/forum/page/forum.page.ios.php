<?php


_::$meta['title'] = 'BoxZa iOS - ข้อมูลข่าวสารเกี่ยวกับ iOS, Apple, iPhone, iPad, iPod, iTunes, แอพใหม่ๆ และอื่นๆเกี่ยวกับ iOS';
_::$meta['description'] = 'ศูนย์รวมคนใช้งาน iOS - ข้อมูลข่าวสารเกี่ยวกับ iOS, Apple, iPhone, iPad, iPod, iTunes, แอพใหม่ๆ และอื่นๆเกี่ยวกับ iOS ';
_::$meta['keywords'] = 'iOS, Apple, iPhone, iPhone 5, iPad, iPad mini, iPod, iTunes, Apps';

$cache=_::cache();
#if(!_::$content=$cache->get('ca1','fb_home'))
#{
	$db=_::db();
	
	
	$topic=$db->find('forum',array('c'=>array('$in'=>array(401,402,403,404,405,406,407,408,409)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'c'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>30),false);
	
	$template->assign('topic',$topic);
	$template->assign('user',_::user());
	_::$content=$template->fetch('page.ios');


#	$cache->set('ca1','fb_home',_::$content,false,300);
#}
?>