<?php


_::$meta['title'] = 'Legends: Rise of a Hero, เล่นเกมเลเจนด์: ริซออฟอะฮีโร่ แลกเปลี่ยนเทคนิค Tips หาเพื่อน  แอดเพื่อน โปรแกรมโกง บอท Cheats Speed Hack';
_::$meta['description'] = 'ศูนย์รวมคนเล่นเกม Legends: Rise of a Hero แลกเปลี่ยนเทคนิคการเล่น โปรแกรมบอท โปรแกรมโกง Cheats Speed Hack ';
_::$meta['keywords'] = 'เลเจนด์: ริซออฟอะฮีโร, Legends: Rise of a Hero, บอท, cheat, speed, bot, โกง, ความเร็ว, เลเวล, เงิน';

$cache=_::cache();
#if(!_::$content=$cache->get('ca1','fb_home'))
#{
	$db=_::db();
	
	
	$topic=$db->find('forum',array('c'=>array('$in'=>array(64)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ms'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>30),false);
	
	$template->assign('topic',$topic);
	$template->assign('user',_::user());
	_::$content=$template->fetch('page.legends');


#	$cache->set('ca1','fb_home',_::$content,false,300);
#}
?>