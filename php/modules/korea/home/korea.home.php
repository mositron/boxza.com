<?php

_::$meta['title'] = 'เกาหลี ดาราเกาหลี นักร้องเกาหลี ซีรีย์เกาหลี เพลงเกาหลี';
_::$meta['description'] = 'เกาหลี ดาราเกาหลี นักร้องเกาหลี ซีรีย์เกาหลี เพลงเกาหลี';
_::$meta['keywords'] = 'เกาหลี, ดาราเกาหลี, นักร้องเกาหลี, ซีรีย์เกาหลี, เพลงเกาหลี';
//_::$meta['google']=array('id'=>'112235668332689047152');

define('HIDE_SIDEBAR',1);

$cache=_::cache();
if(!_::$content=$cache->get('ca1',_::$type.'_home'))
{
	$db=_::db();
	
	$news1=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>26,'cs'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>22));
	$news2=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>26,'cs'=>2),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>11));
	$news3=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>26,'cs'=>3),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>8));
	$news4=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>26,'cs'=>4),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	$news5=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>26,'cs'=>5),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>9));
	$people=$db->find('people',array('dn'=>array('$exists'=>true),'pl'=>1,'dd'=>array('$exists'=>false),'ct'=>'kr'),array('_id'=>1,'n'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'fd'=>1,'lk'=>1),array('sort'=>array('dn'=>-1),'limit'=>12));
	$template->assign('news1',$news1);
	$template->assign('news2',$news2);
	$template->assign('news3',$news3);
	$template->assign('news4',$news4);
	$template->assign('news5',$news5);
	$template->assign('people',$people);
	
	
	_::$content=$template->fetch('home');


	$cache->set('ca1',_::$type.'_home',_::$content,false,300);
}

function _getboxname($b)
{
	return '';
}
?>