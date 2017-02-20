<?php

//_::time();
//_::link();
$db=_::db();

extract(_::split()->get('/',0,array('c','page')));

if(isset($c) && !isset($cate[$c]))
{
	_::move('/#no-cate');
}
if($c)
{
	_::move('/'.$cate[$c]['l'],true);
}
elseif(isset($cate[MODULE_LINK]))
{
	$c=MODULE_LINK;
}
else
{
	_::move('/#no-set');
}


//_::$meta['rss']='http://feed.boxza.com/news-'.NEWS_CATE.'-'.$c.'/rss';

$_=array('dd'=>array('$exists'=>false),'pl'=>1,'ps'=>$c);

//_::$meta['title']=$cate[$c]['tt'].($page>1?' (หน้า '.$page.')':'').' - '._::$meta['title'];
//_::$meta['description']=$cate[$c]['tt'].($page>1?' (หน้า '.$page.')':'').' '._::$meta['description'];
$people=array();
if($count=$db->count('people',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(80,$count,array('/'._::$path[0],'/page-'),$page);
	$people=$db->find('people',$_,array('_id'=>1,'n'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'fd'=>1,'lk'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>80));
}

$template->assign('c',$c);
$template->assign('people',$people);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

?>