<?php

_::$dbclick=2;

_::$meta['title'] = 'ละคร ละครใหม่ เรื่องย่อละคร ดูละครย้อนหลัง ละครช่อง3 ดูละครย้อนหลังช่อง3 ละครช่อง5 ละครชื่อง7 ละครช่อง9';
_::$meta['description'] = 'ละคร เรื่องย่อละคร ละครใหม่ ละครย้อนหลัง ละครช่อง3 ละครช่อง5 ละครชื่อง7 ละครช่อง9 ดูละครย้อนหลัง ดูละครย้อนหลังช่อง3 ดูละครย้อนหลังช่อง5 ดูละครย้อนหลังช่อง7 ดูละครย้อนหลังช่อง9';
_::$meta['keywords'] = 'ละคร, ละครใหม่, เรื่องย่อละคร, ละครย้อนหลัง, ละครช่อง3, ละครช่อง5, ละครชื่อง7, ละครช่อง9';

//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','drama_home'))
{
	//_::link();
	//_::time();
	$db=_::db();
	$drama=$db->find('drama',array('pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'lk'=>1),array('sort'=>array('_id'=>-1),'limit'=>76));
	$template->assign('drama',$drama);
	_::$content=$template->fetch('home');


	$cache->set('ca1','drama_home',_::$content,false,300);
}
?>