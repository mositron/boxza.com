<?php

//_::link();
//_::time();
$db=_::db();


if(!$news=$db->findone('news',array('_id'=>intval(_::$path[1]),'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'c'=>1,'cs'=>1,'cs2'=>1,'t'=>1,'sm'=>1,'d'=>1,'fd'=>1)))
{
	exit;
}


$template->assign('parent','/mobile/news');
$template->assign('news',$news);

_::$content=$template->fetch('mobile.news.view');
?>