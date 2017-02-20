<?php

_::move('http://game.boxza.com/farmville2');

_::$meta['title'] = 'FarmVille 2 - เล่นเกมฟาร์มวิลล์2 แลกเปลี่ยนเทคนิค Tips หาเพื่อน  แอดเพื่อน โปรแกรมโกง บอท Cheats Speed Hack';
_::$meta['description'] = 'ศูนย์รวมคนเล่นเกมฟาร์มวิลล์2 FarmVille แลกเปลี่ยนเทคนิคการเล่น โปรแกรมบอท โปรแกรมโกง Cheats Speed Hack ';
_::$meta['keywords'] = 'FarmVille 2, ฟาร์มวิลล์ 2, บอท, cheat, speed, bot, โกง, ความเร็ว, เลเวล, เงิน';

$cache=_::cache();
#if(!_::$content=$cache->get('ca1','fb_home'))
#{
	$db=_::db();
	
	
	$topic=$db->find('forum',array('c'=>array('$in'=>array(62)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>30),false);
	
	$template->assign('topic',$topic);
	$template->assign('user',_::user());
	_::$content=$template->fetch('page.farmville2');


#	$cache->set('ca1','fb_home',_::$content,false,300);
#}
?>