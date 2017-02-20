<?php

_::$dbclick=2;
_::$meta['rss']='http://feed.boxza.com/news-'.NEWS_CATE.'/rss';
//_::$meta['google']=array('id'=>'112235668332689047152');

//define('HIDE_SIDEBAR',1);
$cache=_::cache();

if(!_::$content=$cache->get('ca1',_::$type.'_home'))
{
	//_::time();
	$db=_::db();
	$news=array();
	$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>NEWS_CATE),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>40));
	$people=$db->find('people',array('dn'=>array('$exists'=>true),'pl'=>1,'dd'=>array('$exists'=>false),'ps'=>'politic'),array('_id'=>1,'n'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'fd'=>1,'lk'=>1),array('sort'=>array('dn'=>-1),'limit'=>12));
	
	$template->assign('news',$news);
	$template->assign('people',$people);
	$template->assign('user',_::user());
	

	_::$content=$template->fetch('home');


	$cache->set('ca1',_::$type.'_home',_::$content,false,300);
}
?>