<?php

if($access)
{
	_::ajax()->register(array('newbanner','delbanner'),'banner.home');
}

//_::time();
$db=_::db();
extract(_::split()->get('/banner/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false),'ty'=>'ads');

if(_::$path[0]&&isset($position[_::$path[0]]))
{
	$arg['p.'._::$path[0]]=array('$exists'=>true);
}



if($count=$db->count('banner',$arg))
{
	//list($pg,$skip)=_::pager()->bootstrap(20,$count,array($url,'page-'),$page);
	//$banner=$db->find('banner',$arg,array(),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
	$banner=$db->find('banner',$arg,array(),array('sort'=>array('da'=>-1)));
}

$template->assign('count',$count);
$template->assign('banner',$banner);
$template->assign('access',$access);
$template->assign('pager',$pg);
_::$content=$template->fetch('banner.home');





?>