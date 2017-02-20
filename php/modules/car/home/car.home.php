<?php

_::$meta['rss']='http://feed.boxza.com/news-12/rss';
//_::$meta['google']=array('id'=>'112235668332689047152');

define('HIDE_SIDEBAR',1);

$cache=_::cache();

if(!_::$content=$cache->get('ca1',_::$type.'_home'))
{
	//_::time();
	$db=_::db();
	$news=array();

	$news_hilight=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>12,'cs'=>array('$gte'=>1)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>25));
	$news_promotions=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>12,'cs'=>-1),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$news_maintenance=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>12,'cs'=>-2),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	$news_services=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>12,'cs'=>-3),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>8));
	$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>12),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>40));
	
	$template->assign('news_hilight',$news_hilight);
	$template->assign('news_promotions',$news_promotions);
	$template->assign('news_maintenance',$news_maintenance);
	$template->assign('news_services',$news_services);
	$template->assign('news',$news);
	$template->assign('user',_::user());
	

	_::$content=$template->fetch('home');


	$cache->set('ca1',_::$type.'_home',_::$content,false,300);
}
?>