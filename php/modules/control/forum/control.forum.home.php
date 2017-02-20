<?php




//_::time();
$db=_::db();

	
extract(_::split()->get(FORUM_URL,0,array('page','o')));

$topic=array();
$_=array('dd'=>array('$exists'=>false));

if($o&&in_array($o,array('_id','ds')))
{
	
}
else
{
	$o='_id';	
}
$pp=30;

if($count=$db->count('forum',array('dd'=>array('$exists'=>false))))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array('/forum'.($o=='ds'?'/o-ds':''),'/page-'),$page);
	$topic=$db->find('forum',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'u'=>1,'s'=>1,'o'=>1,'ds'=>1,'do'=>1,'sk'=>1,'lo'=>1,'f'=>1,'c'=>1,'fd'=>1,'lk.c'=>1,'s'=>1,'cm.c'=>1,'ads'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array($o=>-1),'skip'=>$skip,'limit'=>$pp),false);
}

$template->assign('topic',$topic);
$template->assign('o',$o);
$template->assign('count',$count);
$template->assign('pager',$pg);
$template->assign('access',$access);
$template->assign('user',_::user());
_::$content=$template->fetch('forum.home');





?>