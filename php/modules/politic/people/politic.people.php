<?php

//_::link();
//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));


$arg=array('lk'=>_::$path[0],'pl'=>1,'dd'=>array('$exists'=>false));
if(!$people=$db->findone('people',$arg))
{
	_::move('/');
}


if($people['n'])
{
	$name=$people['n'];
}
elseif($people['nn'])
{
	$name=$people['nn'].' '.$people['fn'].' '.$people['ln'];
}
else
{
	$name=$people['fn'].' '.$people['ln'];
}

_::$meta['title']='ข่าว'.$name.' ล่าสุด ข่าว'.$name.' วันนี้ - '._::$meta['title'];
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

$_=array('pl'=>1,'dd'=>array('$exists'=>false),'people'=>$people['_id']);

if($count=$db->count('news',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(80,$count,array('/'._::$path[0],'/page-'),$page);
	$news=$db->find('news',$_,array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>80));
}

$template->assign('people',$people);
$template->assign('name',$name);
$template->assign('news',$news);
$template->assign('pager',$pg);
_::$content=$template->fetch('people');

?>