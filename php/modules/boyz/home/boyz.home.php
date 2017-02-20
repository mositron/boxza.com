<?php


//_::$meta['google']=array('id'=>'112235668332689047152');
$cache=_::cache();
if(!_::$content=$cache->get('ca1','boyz_home'))
{
	$db=_::db();
	
	
	#$topic=$db->find('forum',array('c'=>array('$in'=>array(71,72,73,74,75,77,78,79,80,81,82,83,84,85,86,87,88,89)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ms'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>30),false);
	
	$video=$db->find('forum',array('c'=>76,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1,'d'=>1),array('sort'=>array('_id'=>-1),'limit'=>7));
	$hot=$db->find('forum',array('c'=>72,'dd'=>array('$exists'=>false),'do'=>array('$gte'=>20)),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	
	
	$fashion=$db->find('forum',array('c'=>74,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$health=$db->find('forum',array('c'=>75,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$album=$db->find('forum',array('c'=>77,'dd'=>array('$exists'=>false),'s'=>array('$exists'=>true)/*,'rc'=>1*/),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'limit'=>15));
	
	$banner=$db->find('boyz_banner',array('pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'d'=>1,'l'=>1),array('sort'=>array('_id'=>-1)));
	
	$activity=$db->find('forum',array('c'=>array('$in'=>array(92,93,94)),'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>8));
	
	
	$template->assign('video',(array)$video);
	$template->assign('hot',(array)$hot);
	$template->assign('fashion',(array)$fashion);
	$template->assign('health',(array)$health);
	$template->assign('album',(array)$album);
	$template->assign('banner',(array)$banner);
	$template->assign('rec',$db->find('msn_rec',array('dd'=>array('$exists'=>false),'fd'=>array('$exists'=>true),'ty'=>'gay'),array(),array('sort'=>array('_id'=>-1),'limit'=>20),false));
	_::$content=$template->fetch('home');


	$cache->set('ca1','boyz_home',_::$content,false,60);
}
?>

