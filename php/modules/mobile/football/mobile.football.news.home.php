<?php

$pp=50;
extract(_::split()->get('/football/news/'._::$path[1],1,array('page')));

$db=_::db();
$_=array('c'=>array('$in'=>array(421,422,423,424,425,426,427,428)),'dd'=>array('$exists'=>false));
if($count=$db->count('forum',$_))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array($url,'page-'),$page);
	$news=$db->find('forum',$_,array('_id'=>1,'fd'=>1,'t'=>1,'c'=>1,'do'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>$pp));
}


if(!$page || $page<1)$page=1;

$template->assign('news',$news);
$template->assign('parent','/football');
$template->assign('page',$page);
$template->assign('maxpage',ceil($count/$pp));
$template->assign('cur','?parent='.urlencode(URL));
_::$content=$template->fetch('football.news.home');

?>