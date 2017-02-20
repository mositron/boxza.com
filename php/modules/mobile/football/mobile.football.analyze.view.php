<?php
$db=_::db();
$sarg=array('_id'=>1,'t'=>1,'c'=>1,'d'=>1,'da'=>1,'fd'=>1,'f'=>1,'o'=>1,'ip'=>1,'s'=>1,'dd'=>1,'e'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>array(-20,20)));
if(!$news = $db->findone('forum',array('_id'=>intval(_::$path[1])),$sarg))
{
	echo 'not found';
	exit;	
}

$template->assign('parent','/football/analyze');
$template->assign('news',$news);

_::$content=$template->fetch('football.analyze.view');
?>