<?php
/*
_::$meta['title'] = 'เกาหลี ดาราเกาหลี นักร้องเกาหลี ซีรีย์เกาหลี เพลงเกาหลี';
_::$meta['description'] = 'เกาหลี ดาราเกาหลี นักร้องเกาหลี ซีรีย์เกาหลี เพลงเกาหลี';
_::$meta['keywords'] = 'เกาหลี, ดาราเกาหลี, นักร้องเกาหลี, ซีรีย์เกาหลี, เพลงเกาหลี';
*/
//_::$meta['google']=array('id'=>'112235668332689047152');

define('HIDE_SIDEBAR',1);

$cache=_::cache();
if(!_::$content=$cache->get('ca1',_::$type.'_home'))
{
	$db=_::db();
	$notin=array();
	$update=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>27,'rc'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	foreach($update as $v)
	{
		$notin[] = $v['_id'];	
	}
	$review=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>27,'cs'=>1,'_id'=>array('$nin'=>$notin)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>9));
	$wedding=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>27,'cs'=>2,'_id'=>array('$nin'=>$notin)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>9));
	$health=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>27,'cs'=>3,'_id'=>array('$nin'=>$notin)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>9));
	$howto=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>27,'cs'=>4,'_id'=>array('$nin'=>$notin)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>9));
	$fashion=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>27,'cs'=>5,'_id'=>array('$nin'=>$notin)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>4));
	$uknow=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>27,'cs'=>6,'_id'=>array('$nin'=>$notin)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>2));
	$template->assign('update',$update);
	$template->assign('review',$review);
	$template->assign('wedding',$wedding);
	$template->assign('health',$health);
	$template->assign('howto',$howto);
	$template->assign('fashion',$fashion);
	$template->assign('uknow',$uknow);
	
	
	_::$content=$template->fetch('home');


	$cache->set('ca1',_::$type.'_home',_::$content,false,300);
}

?>