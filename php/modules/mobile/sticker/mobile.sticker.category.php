<?php
define('HIDE_REQUEST',1);

$pp=50;
extract(_::split()->get('/sticker/category/'._::$path[1],1,array('page')));

$db=_::db();
if($count=$db->count('sticker',array('pl'=>1,'c'=>intval(_::$path[1]),'dd'=>array('$exists'=>false))))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array($url,'page-'),$page);
	$app=$db->find('sticker',array('pl'=>1,'c'=>intval(_::$path[1]),'dd'=>array('$exists'=>false)),array('t'=>1,'fd'=>1,'do'=>1,'f'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>$pp));
}


if(!$page || $page<1)$page=1;
//list($pg,$skip)=_::pager()->bootstrap($pp,$count,array('/sticker/recent/','page-'),$page);

//$app=$db->find('sticker',array('pl'=>1,'dd'=>array('$exists'=>false)),array('t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'u'=>1,'do'=>1,'f'=>1),array('sort'=>array('do'=>-1),'skip'=>$skip,'limit'=>$pp));

$template=_::template();
$template->assign('c',_::$path[1]);
$template->assign('parent','/sticker');
$template->assign('page',$page);
$template->assign('maxpage',ceil($count/$pp));
$template->assign('app',$app);
$template->assign('cur','?parent='.urlencode(URL));
_::$content=$template->fetch('sticker.category');

?>