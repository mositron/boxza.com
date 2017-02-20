<?php

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/music/news/',1,array('page')));

if(!$page || $page<1)
{
	$page=1;
}

$db=_::db();

$_=array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>24,'exl'=>0);

$pp=30;
if($count=$db->count('news',$_))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array('/music/news','page-'),$page);
	$news=$db->find('news',$_,array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'ds'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>$pp));
}


$template->assign('news',$news);

$template->assign('parent','/music');
$template->assign('page',$page);
$template->assign('maxpage',ceil($count/$pp));
$template->assign('cur','?parent='.urlencode(URL));

_::$content=$template->fetch('music.news.home');

?>