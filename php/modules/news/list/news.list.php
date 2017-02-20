<?php

$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($c) && !isset($cate[$c]))
{
	_::move('/');
}
if($c)
{
	_::move('/'.$cate[$c]['l'],true);
}
elseif(isset($clink[_::$path[0]]))
{
	$c=$clink[_::$path[0]];
	if($cate[$c]['sl'])
	{
		_::move($cate[$c]['sl']);
	}
}
else
{
	_::move('/');
}
$_=array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>intval($c));

_::$meta['title']='ข่าว'.$cate[$c]['t'].' - '._::$meta['title'];
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

_::$meta['rss']='http://feed.boxza.com/news-'.$c.'/rss';


if($count=$db->count('news',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(80,$count,array('/'._::$path[0],'/page-'),$page);
	$news=$db->find('news',$_,array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>80));
}

$template->assign('c',$c);
$template->assign('news',$news);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

?>