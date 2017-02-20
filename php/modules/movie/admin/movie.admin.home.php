<?php

_::session()->logged();

_::ajax()->register(array('delmovie','newmovie'),'admin.home');


//_::time();
$db=_::db();
extract(_::split()->get('/manage/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if($count=$db->count('movie',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(20,$count,array('/admin/','page-'),$page);
	$movie=$db->find('movie',$arg,array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'ty'=>1,'tm'=>1,'pl'=>1),array('skip'=>$skip,'limit'=>20,'sort'=>array('da'=>-1)));
}

$template->assign('count',$count);
$template->assign('movie',$movie);
$template->assign('pager',$pg);
_::$content=$template->fetch('admin.home');





?>