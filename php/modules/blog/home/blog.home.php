<?php


$cache=_::cache();
if(!_::$content=$cache->get('ca1',_::$type.'_home'))
{
	//_::time();
	$db=_::db();
	
	$news_rc=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'rc'=>array('$gt'=>0),'c'=>array('$ne'=>8)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>20));
	$notid=array();
	foreach($news_rc as $v)
	{
		$notid[]=$v['_id'];
	}
	$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'_id'=>array('$nin'=>$notid),'c'=>array('$ne'=>8)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>78));
	$template->assign('news_rc',$news_rc);
	$template->assign('news',$news);
	_::$content=$template->fetch('home');


	$cache->set('ca1',_::$type.'_home',_::$content,false,10);
}
?>