<?php

_::$dbclick=2;

_::$meta['title'] = 'เกมส์ เกม เกมส์ออนไลน์ เกมส์แฟลช เกมส์เฟสบุ๊ค เล่นเกมส์ เกมส์PC เกมส์ทำอาหาร เกมส์ปลูกผัก เกมส์แต่งตัว เกมส์จับคู่ เกมส์ต่อสู้ เกมส์รถแข่ง';
_::$meta['description'] = 'เกมส์ รวมเรื่องราวเกี่ยวกับเกมส์   การเล่นเกม เกมส์ออนไลน์ เกมส์แฟลช เกมส์ทําอาหาร เกมส์แต่งตัว, เกมส์จับคู่ เกมส์ต่อสู้ เกมส์รถแข่ง เกมส์แข่งรถ เกมส์เต้น เกมส์อื่นๆอีกมากมาย';
_::$meta['keywords'] = 'เกมส์, เกม, เกมส์ออนไลน์, เกมส์เฟสบุ๊ค, เกมส์ทําอาหาร, เกมส์แต่งตัว เกมส์จับคู่, เกมส์ต่อสู้, เกมส์รถแข่ง, เกมส์เต้น, เกมส์แข่งรถ';
//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','game_home'))
{
	//_::time();
	$db=_::db();
	$template=_::template();

	$pc=array();
	
	$template->assign('pc',$pc);
	
	$template->assign('user',_::user());
	$template->assign('topic',$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>array(11,12,13,14,15,16,17,18,19,20,61,62,63,64,65,66,67,68,69,70,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130))),array('_id'=>1,'t'=>1,'c'=>1,'ic'=>1,'u'=>1,'ds'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>15),false));
		
	
	$template->assign('hit',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('do'=>-1,'_id'=>-1),'limit'=>6)));
	$template->assign('new',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>6)));
	$template->assign('rec',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('rc'=>-1,'_id'=>-1),'limit'=>6)));
	$template->assign('c27',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>'27'),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
	$template->assign('c95',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>'95'),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
	$template->assign('c5',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>'5'),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
	$template->assign('c20',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>'20'),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
	$template->assign('c37',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>'37'),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
	$template->assign('c52',$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>'52'),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
	$template->assign('c82',(array)$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>'82'),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
	

	$template->assign('news',$db->find('news',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>NEWS_CATE),array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>16)));
	
	_::$content=$template->fetch('home');


	$cache->set('ca1','game_home',_::$content,false,600);
}
_::$yengo=array(53880,54000);
?>