<?php

_::ajax()->register(array('update','newbanner','delbanner'),'admin.banner');



$pp=50;
//_::time();
$db=_::db();
extract(_::split()->get('/admin/banner/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if($count=$db->count('boyz_banner',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array($url,'page-'),$page);
	$banner=$db->find('boyz_banner',$arg,array(),array('skip'=>$skip,'limit'=>$pp,'sort'=>array('_id'=>-1)));
}

$template->assign('count',$count);
$template->assign('banner',$banner);
$template->assign('html',_::html());
$template->assign('pager',$pg);
_::$content=$template->fetch('admin.banner.home');




?>