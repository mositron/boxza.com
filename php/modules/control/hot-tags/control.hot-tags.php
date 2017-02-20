<?php

$access=check_perm('hot-tags');

if($_GET['cmd'])
{
	if(!$access)
	{
		_::move(URL);	
	}
}

if($access)
{
	_::ajax()->register(array('newbanner','delbanner','update'),'hot-tags');
}

//_::time();
$db=_::db();
extract(_::split()->get('/hot-tags/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false),'ty'=>'tags');

if($count=$db->count('banner',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(20,$count,array($url,'page-'),$page);
	$banner=$db->find('banner',$arg,array(),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
}

$template->assign('html',_::html());
$template->assign('count',$count);
$template->assign('banner',$banner);
$template->assign('access',$access);
$template->assign('pager',$pg);
_::$content=$template->fetch('hot-tags');





?>