<?php
_::$dbclick=2;
_::$meta['rss']='http://feed.boxza.com/news-4/rss';
//_::$meta['google']=array('id'=>'112235668332689047152');

define('HIDE_SIDEBAR',1);
$cache=_::cache();

if(!_::$content=$cache->get('ca1',_::$type.'_home'))
{
	//_::link();
	//_::time();
	$db=_::db();
	$news=array();
	$news[1]=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>17));
	$news[2]=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>2),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>16));
	$news[3]=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>3),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>5));
	$news[4]=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>4),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>7));
	$news[5]=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>5),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>7));
	$news[6]=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>6),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>7));
	$news[7]=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>7),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	
	
	$news['movie']=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>5),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>6));
	
	$news['box']=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'bx'=>array('$gte'=>0)),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'c'=>1,'bx'=>1),array('sort'=>array('bx'=>1),'limit'=>5));
	$tm = strtotime(date('Y-m-d'));
	$news['show']=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm),'$gte'=>new MongoDate($tm-(3600*24*7*4)))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'c'=>1),array('sort'=>array('tm'=>-1),'limit'=>6));
	$news['soon']=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$gt'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'c'=>1),array('sort'=>array('tm'=>1),'limit'=>4));
	
	
	$template->assign('mcate',array(
		'action'=>'Action - หนังต่อสู้',
		'adventure'=>'Adventure - หนังผจญภัย',
		'animation'=>'Animation - หนังการ์ตูน',
		'biography'=>'Biography - หนังชีวประวัติ',
		'comedy'=>'Comedy  - หนังตลก',
		'crime'=>'Crime - หนังอาชญากรรม',
		'documentary'=>'Documentary - หนังสารคดี',
		'drama'=>'Drama - หนังชีวิต',
		'family'=>'Family - หนังครอบครัว',
		'fantasy'=>'Fantasy - หนังเทพนิยาย',
		'history'=>'History - หนังประวัติศาสตร์',
		'horror'=>'Horror - หนังสยองขวัญ',
		'mystery'=>'Mystery - หนังลึกลับซ่อนเงื่อน',
		'monster'=>'Monster - หนังสัตว์ประหลาด',
		'musical'=>'Musical - หนังเพลง',
		'romance'=>'Romance - หนังรัก',
		'sci-fi'=>'Sci-Fi - หนังวิทยาศาสตร์',
		'series'=>'Series - หนังซีรีย์',
		'sport'=>'Sport - หนังกีฬา',
		'thriller'=>'Thriller - หนังระทึกขวัญ',
		'war'=>'War - หนังสงคราม',
		'western'=>'Western - หนังคาวบอยตะวันตก'
	));
	$template->assign('news',$news);
	
	$topic=$db->find('forum',array('c'=>418,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ms'=>1,'ic'=>1,'u'=>1,'s'=>1,'o'=>1,'ds'=>1,'do'=>1,'sk'=>1,'lo'=>1,'f'=>1,'c'=>1,'fd'=>1,'lk.c'=>1,'s'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('da'=>-1),'limit'=>9),false);
	$template->assign('topic',$topic);
	$template->assign('user',_::user());
	
	
	$template->assign('lotto',$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1)));
	
	
	_::$content=$template->fetch('home');


	$cache->set('ca1',_::$type.'_home',_::$content,false,300);
}

_::$yengo=array(53880,54000);
?>