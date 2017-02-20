<?php

_::$dbclick=2;

//_::time();
$tm=time::show($data['lotto_last']['tm'],'date');
_::$meta['title'] = 'หวย ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' สลากกินแบ่ง หวยหุ้น ห้วยหุ้นไทย';
_::$meta['description'] = 'หวย ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาล ย้อนหลัง  หวยหุ้น ห้วยหุ้นไทย เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว';
_::$meta['keywords'] = 'หวย, ตรวจหวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด, หวยหุ้น, ห้วยหุ้นไทย';
_::$meta['rss']='http://feed.boxza.com/news-7-1/rss';
//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','lotto_home'))
{
	$db=_::db();
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array(),array('sort'=>array('tm'=>-1),'limit'=>4));
	$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>NEWS_CATE,'cs'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1,'da'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	
	$set=$db->find('lotto_set',array(),array(),array('sort'=>array('_id'=>-1),'limit'=>1));
	$template=_::template();
	$template->assign('lotto',$lotto);
	$template->assign('news',$news);
	$template->assign('set',$set);
	
	
	$topic=$db->find('forum',array('c'=>array('$in'=>array(5,191,192)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>10),false);
	$template->assign('topic',$topic);
	$template->assign('user',_::user());

	_::$content=$template->fetch('home');
	$cache->set('ca1','lotto_home',_::$content,false,3600);
}

_::$yengo=array(53880,54000);
?>