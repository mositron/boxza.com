<?php

if($access)
{
	_::ajax()->register(array('newbanner','delbanner'),'home-banner.home');
}

//_::time();
$db=_::db();
extract(_::split()->get('/home-banner/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false),'ty'=>'home');

if(in_array(_::$path[0],array('img','text','bottom')))
{
	$arg['p']=_::$path[0];
}
if($count=$db->count('banner',$arg))
{
	//list($pg,$skip)=_::pager()->bootstrap(100,$count,array($url,'page-'),$page);
	//$banner=$db->find('banner',$arg,array(),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
	$banner=$db->find('banner',$arg,array(),array('sort'=>array('da'=>-1)));
}

$template->assign('count',$count);
$template->assign('banner',$banner);
$template->assign('access',$access);
$template->assign('pager',$pg);
_::$content=$template->fetch('home-banner.home');





?>