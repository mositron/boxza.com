<?php
define('HIDE_REQUEST',1);

$pp=50;

$db=_::db();
$count=$db->count('guess',array('pl'=>1,'dd'=>array('$exists'=>false)));

extract(_::split()->get('/guess/recent',1,array('page')));
if(!$page || $page<1)$page=1;
list($pg,$skip)=_::pager()->bootstrap($pp,$count,array('/guess/recent/','page-'),$page);

$app=$db->find('guess',array('pl'=>1,'dd'=>array('$exists'=>false)),array('t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'u'=>1,'do'=>1,'f'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>$pp));

$template=_::template();
$template->assign('parent','/guess');
$template->assign('page',$page);
$template->assign('maxpage',ceil($count/$pp));
$template->assign('app',$app);
$template->assign('cur','?parent='.urlencode(URL));
$template->assign('user',_::user());
_::$content=$template->fetch('guess.recent');

?>