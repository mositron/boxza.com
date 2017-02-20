<?php

#$cache=_::cache();

//_::time();

$cache=_::cache();
if(!_::$content=$cache->get('ca1',_::$type.'_forum_home'))
{
	$db=_::db();
	$_ch = array_keys($cate);
	$template->assign('user',_::user());
	$template->assign('topic',$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>$_ch)),array('_id'=>1,'t'=>1,'ms'=>1,'c'=>1,'ic'=>1,'u'=>1,'ds'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>15),false));
	
	_::$content=$template->fetch2('game.forum.home');
	
	
	$cache->set('ca1',_::$type.'_forum_home',_::$content,false,300);
}
?>