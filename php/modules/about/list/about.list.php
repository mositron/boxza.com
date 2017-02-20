<?php

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

$_=array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>$c);

_::$meta['title']=$cate[$c].($page>1?' (หน้า '.$page.')':'').' - '._::$meta['title'];
_::$meta['description']=$cate[$c].($page>1?' (หน้า '.$page.')':'').' '._::$meta['description'];
$about=array();
if($count=$db->count('about',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(80,$count,array('/'._::$path[0],'/page-'),$page);
	$about=$db->find('about',$_,array('_id'=>1,'t'=>1,'fd'=>1,'lk'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>80));
}

$template->assign('c',$c);
$template->assign('about',$about);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

?>