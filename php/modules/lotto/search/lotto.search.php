<?php


$cache=_::cache();
#if(!_::$content=$cache->get('ca1','lotto_home'))
#{
	
	//_::time();
	$db=_::db();
	$template=_::template();
	if($_POST['lotto']&&$_POST['lotto_date'])
	{
		$template->assign('lq',array_values(array_filter(array_unique(array_map('trim',explode(' ',str_replace(array('  ',','),' ',trim($_POST['lotto']))))))));
		$template->assign('li',$db->findone('lotto',array('_id'=>intval($_POST['lotto_date']))));
	}
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array(),array('sort'=>array('tm'=>-1),'limit'=>11));
	$tm=time::show($lotto[0]['tm'],'date');
_::$meta['title'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm;
_::$meta['description'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว';
_::$meta['keywords'] = 'ตรวจหวย, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด';

	$template=_::template();
	$template->assign('lotto',$lotto);
	_::$content=$template->fetch('search');


#	$cache->set('ca1','lotto_home',_::$content,false,3600);
#}
?>