<?php
extract(_::split()->get('/line/',0,array('page')));

if(!$page || $page<1)
{
	$page=1;	
}

_::$meta['title'] = 'สติกเกอร์ไลน์ฟรี Line Sticker '.($page>1?'หน้า '.$page.' ':'').'- ดาวน์โหลดสติกเกอร์ฟรี แจกสติกเกอร์ฟรี';
_::$meta['description'] = 'สติกเกอร์ไลน์ Line Sticker '.($page>1?'หน้า '.$page.' ':'').'- ดาวน์โหลดสติกเกอร์ฟรี แจกสติกเกอร์ฟรี Sticker Line ฟรี';
_::$meta['keywords'] = 'line, sticker, สติกเกอร์, ไลน์';

$db=_::db();
$_=array('pl'=>1,'ref'=>'line','dd'=>array('$exists'=>false));
if($count=$db->count('sticker',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(100,$count,array('/line/','page-'),$page);
	$sticker=$db->find('sticker',$_,array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>100));
}

$template=_::template();
$template->assign('pager',$pg);
$template->assign('sticker',$sticker);
_::$content=$template->fetch('line');

?>