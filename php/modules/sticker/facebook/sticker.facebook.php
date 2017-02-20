<?php
extract(_::split()->get('/facebook/',0,array('page')));

if(!$page || $page<1)
{
	$page=1;	
}

_::$meta['title'] = 'สติกเกอร์เฟสบุ๊ค Facebook Sticker '.($page>1?'หน้า '.$page.' ':'').'- ดาวน์โหลดสติกเกอร์ฟรี แจกสติกเกอร์ฟรี';
_::$meta['description'] = 'สติกเกอร์เฟสบุ๊ค Facebook Sticker '.($page>1?'หน้า '.$page.' ':'').'- ดาวน์โหลดสติกเกอร์ฟรี แจกสติกเกอร์ฟรี Sticker Facebook ฟรี';
_::$meta['keywords'] = 'facebook, sticker, สติกเกอร์, เฟสบุ๊ค';

$db=_::db();
$_=array('pl'=>1,'ref'=>'fb','dd'=>array('$exists'=>false));
if($count=$db->count('sticker',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(100,$count,array('/facebook/','page-'),$page);
	$sticker=$db->find('sticker',$_,array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>100));
}

$template=_::template();
$template->assign('pager',$pg);
$template->assign('sticker',$sticker);
_::$content=$template->fetch('facebook');

?>