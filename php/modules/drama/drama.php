<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-drama.png';
_::$meta['title'] = 'ละคร เรื่องย่อละคร ละครใหม่ ดูละครย้อนหลัง ละครช่อง3 ละครช่อง5 ละครชื่อง7 ละครช่อง9';
_::$meta['description'] = 'ละคร เรื่องย่อละคร ละครใหม่ ละครย้อนหลัง ละครช่อง3 ละครช่อง5 ละครชื่อง7 ละครช่อง9 ดูละครย้อนหลัง ดูละครย้อนหลังช่อง3 ดูละครย้อนหลังช่อง5 ดูละครย้อนหลังช่อง7 ดูละครย้อนหลังช่อง9';
_::$meta['keywords'] = 'ละคร, ละครใหม่, เรื่องย่อละคร, ละครย้อนหลัง, ละครช่อง3, ละครช่อง5, ละครชื่อง7, ละครช่อง9';

$clink=array('ch-3'=>1,'ch-5'=>2,'ch-7'=>3,'ch-9'=>4);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'ละครช่อง 3','l'=>$rlink[1],'tt'=>'ละครช่อง3 ดูละครช่อง3 ละครย้อนหลังช่อง3 ดูละครย้อนหลังช่อง3 เรื่องย่อละครช่อง3'),
						2=>array('t'=>'ละครช่อง 5','l'=>$rlink[2],'tt'=>'ละครช่อง5 ดูละครช่อง5 ละครย้อนหลังช่อง5 ดูละครย้อนหลังช่อง5 เรื่องย่อละครช่อง5'),
						3=>array('t'=>'ละครช่อง 7','l'=>$rlink[3],'tt'=>'ละครช่อง7 ดูละครช่อง7 ละครย้อนหลังช่อง7 ดูละครย้อนหลังช่อง7 เรื่องย่อละครช่อง7'),
						4=>array('t'=>'ละครช่อง 9','l'=>$rlink[4],'tt'=>'ละครช่อง9 ดูละครช่อง9 ละครย้อนหลังช่อง9 ดูละครย้อนหลังช่อง9 เรื่องย่อละครช่อง9'),
);

$template=_::template();
$template->assign('cate',$cate);

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner(_::$type);
	
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto']=$lotto[0];

	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);
$template->assign('lotto',$data['lotto']);


require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'admin'=>'admin',
																	'ch-3'=>'list',
																	'ch-5'=>'list',
																	'ch-7'=>'list',
																	'ch-9'=>'list',
													),
													true,
													function()
													{
														define('MODULE','view');
													}
									)
);


$template->display('content');

?>