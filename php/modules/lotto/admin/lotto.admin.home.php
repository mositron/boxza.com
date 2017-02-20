<?php

_::session()->logged();

_::ajax()->register(array('dellotto','newlotto'),'admin.home');


//_::time();
$db=_::db();
extract(_::split()->get('/manage/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if($count=$db->count('lotto',$arg))
{
	list($pg,$skip)=_::pager()->page(20,$count,array('/admin/','page-'),$page);
	$lotto=$db->find('lotto',$arg,array('_id'=>1,'tm'=>1,'l'=>1,'a1'=>1,'l3'=>1,'l2'=>1,'pl'=>1),array('skip'=>$skip,'limit'=>20,'sort'=>array('tm'=>-1)));
}

$template->assign('count',$count);
$template->assign('lotto',$lotto);
$template->assign('pager',$pg);
_::$content=$template->fetch('admin.home');





?>