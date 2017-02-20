<?php


_::$meta['title'] = 'Cookie Run คุกกี้รัน - เล่นเกมคุกกี้รัน แลกเปลี่ยนเทคนิค Tips หาเพื่อน  แอดเพื่อน โปรแกรมโกง บอท Cheats Speed Hack';
_::$meta['description'] = 'ศูนย์รวมคนเล่นเกมคุกกี้รัน Cookie Run แลกเปลี่ยนเทคนิคการเล่น โปรแกรมบอท โปรแกรมโกง Cheats Speed Hack ';
_::$meta['keywords'] = 'Cookie Run, คุกกี้รัน, บอท, cheat, speed, bot, โกง, ความเร็ว, เลเวล, เงิน';

$cache=_::cache();
#if(!_::$content=$cache->get('ca1','fb_home'))
#{
	$db=_::db();
	
	
	$topic=$db->find('forum',array('c'=>array('$in'=>array(52)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>30),false);
	
	$template->assign('topic',$topic);
	$template->assign('user',_::user());
	_::$content=$template->fetch('page.cookie-run');


#	$cache->set('ca1','fb_home',_::$content,false,300);
#}
?>