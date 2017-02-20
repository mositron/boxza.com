<?php

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('z','c','t','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($c) && !isset($cate[$c]))
{
	unset($c);
}
$_=array('dd'=>array('$exists'=>false),'pl'=>1);
if($c)
{
	$_['c']=$c;
}

_::$meta['title']='เกมส์'.($c?$cate[$c]['t']:'').' - '._::$meta['title'];


_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

$flash=array();
if($count=$db->count('game',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(60,$count,array($url,'page-'),$page);
	$flash=$db->find('game',$_,array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>60));
}

$template->assign('c',$c);
$template->assign('flash',(array)$flash);
$template->assign('pager',$pg);
_::$content=$template->fetch('flash.list');

?>