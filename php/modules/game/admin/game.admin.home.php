<?php

_::session()->logged();

_::ajax()->register(array('delgame','newgame'),'admin.home');


//_::time();
$db=_::db();
extract(_::split()->get('/manage/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if($count=$db->count('game',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(72,$count,array('/admin/','page-'),$page);
	$game=$db->find('game',$arg,array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'ty'=>1,'s'=>1,'pl'=>1),array('skip'=>$skip,'limit'=>72,'sort'=>array('da'=>-1)));
}

$template->assign('count',$count);
$template->assign('game',$game);
$template->assign('pager',$pg);
_::$content=$template->fetch('admin.home');





?>