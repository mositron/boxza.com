<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'Blog บล็อก สร้างบล็อกฟรี เขียนบล็อกฟรี';
_::$meta['description'] = 'Blog บล็อก สร้างบล็อกฟรี เขียนบล็อกฟรี กับ BoxZa Blog';
_::$meta['keywords'] = 'blog, บล็อก, บล็อกฟรี, สร้างบล็อกฟรี, เขียนบล็อกฟรี';

$cate=array(
'1'=>array('t'=>'เรื่องสั้น','d'=>'บทประพันธ์ เรื่องสั้น นิยาย บทกวี เรื่องราวต่างๆทุกประเภท'),
'2'=>array('t'=>'การ์ตูน','d'=>'เกี่ยวกับการ์ตูน ทั้งการ์ตูนไทย และต่างประเทศ'),
'3'=>array('t'=>'บันเทิง','d'=>'เกี่ยวกับบันเทิงทุกประเภท ทั้งข่าว เพลง หนัง ละคร และอื่นๆ'),
'4'=>array('t'=>'อดิเรก','d'=>'กิจกรรมยามว่าง'),
'5'=>array('t'=>'เทคโนโลยี','d'=>''),
'6'=>array('t'=>'แฟชั่น','d'=>''),
'7'=>array('t'=>'อาหาร','d'=>''),
'8'=>array('t'=>'ท่องเที่ยว','d'=>''),
'9'=>array('t'=>'สาระความรู้','d'=>''),
'10'=>array('t'=>'เรื่องราวส่วนตัว'),
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
	
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);

require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'post'=>'post',
																	'manage'=>'manage',
																	'update'=>'update',
																	'view'=>'view',
													),
													true,
													function()
													{
														define('MODULE','list');
													}
									)
);


$template->display('content');

?>