<?php

//_::time();
$db=_::db();

extract(_::split()->get('/list/',0,array('page')));



$_=array('dd'=>array('$exists'=>false),'pl'=>1);

_::$meta['title']='ตรวจหวยย้อนหลัง'.($page>1?' หน้า '.$page:'').' - '._::$meta['title'];
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

if($count=$db->count('lotto',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(48,$count,array('/list','/page-'),$page);
	$lotto=$db->find('lotto',$_,array('_id'=>1,'tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1,'l'=>1),array('sort'=>array('tm'=>-1),'skip'=>$skip,'limit'=>48));
}

$template->assign('lotto',$lotto);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

?>