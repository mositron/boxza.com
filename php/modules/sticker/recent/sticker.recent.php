<?php
extract(_::split()->get('/recent/',0,array('page')));

if(!$page || $page<1)
{
	$page=1;	
}

_::$meta['title'] = 'สติกเกอร์ล่าสุด สติกเกอร์มาใหม่ '.($page>1?'หน้า '.$page.' ':'').'- สติกเกอร์มาใหม่ สติกเกอร์ฟรีล่าสุด ดาวน์โหลดสติกเกอร์ล่าสุดฟรี';
_::$meta['description'] = 'ล่าสุด สติกเกอร์ล่าสุด สติกเกอร์มาใหม่ '.($page>1?'หน้า '.$page.' ':'').'- สติกเกอร์มาใหม่ สติกเกอร์ฟรีล่าสุด ดาวน์โหลดสติกเกอร์ล่าสุดฟรี';
_::$meta['keywords'] = 'facebook, sticker, สติกเกอร์, เฟสบุ๊ค';

$db=_::db();
$_=array('pl'=>1,'dd'=>array('$exists'=>false));
if($count=$db->count('sticker',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(100,$count,array('/recent/','page-'),$page);
	$sticker=$db->find('sticker',$_,array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>100));
}

$template=_::template();
$template->assign('pager',$pg);
$template->assign('sticker',$sticker);
_::$content=$template->fetch('recent');

?>