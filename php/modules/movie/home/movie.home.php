<?php

_::$dbclick=2;

define('HIDE_SIDEBAR',1);
//_::$meta['google']=array('id'=>'112235668332689047152');


$cache=_::cache();
if(!_::$content=$cache->get('ca1','movie_home'))
{
	//_::time();
	$db=_::db();
	$template=_::template();

	$tm = strtotime(date('Y-m-d'));
	$recommend=$db->findone('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'rc'=>1));
	$show=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm),'$gte'=>new MongoDate($tm-(3600*24*7*4)))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('tm'=>-1),'limit'=>12));
	$soon=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$gt'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('tm'=>1),'limit'=>12));
	$box=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'bx'=>array('$gte'=>0)),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'c'=>1,'bx'=>1),array('sort'=>array('bx'=>1),'limit'=>5));
	$wall=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'w1'=>array('$exists'=>true)),array('_id'=>1,'t'=>1,'w1'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'limit'=>5));
	$template->assign('show',$show);
	$template->assign('soon',$soon);
	$template->assign('box',$box);
	$template->assign('recommend',$recommend);
	$template->assign('wall',$wall);
	
	$news=$db->find('news',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>NEWS_CATE),array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>16));
	$template->assign('news',$news);
	
	_::$content=$template->fetch('home');


	$cache->set('ca1','movie_home',_::$content,false,600);
}
?>