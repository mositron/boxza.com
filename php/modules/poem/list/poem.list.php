<?php

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
$all=array('order','by','search','page','day','month','year','position','category');
extract(_::split()->get('/',0,array('z','p','c','t','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($c) && !isset($cate[$c]))
{
	unset($c);
}

$_=array('dd'=>array('$exists'=>false));
if($c)
{
	if($cate[$c]['l'])
	{
		$_['c']=array('$in'=>$cate[$c]['l']);
	}
	else
	{
		$_['c']=intval($c);
	}
	_::$meta['title']=$cate[$c]['t'].' - poem กลิตเตอร์'.$cate[$c]['t'].' '._::$meta['title'];
}
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

_::$meta['rss']='http://feed.boxza.com/poem'.($c?'-'.$c:'').'/rss';

if($count=$db->count('poem',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(64,$count,array($url,'page-'),$page);
	$last=$db->find('poem',$_,array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>64));
}

$template->assign('c',$c);
$template->assign('t',$t);
$template->assign('last',$last);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

?>