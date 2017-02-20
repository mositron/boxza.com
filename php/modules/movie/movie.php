<?php

# check session/login
_::session();


define('NEWS_CATE',5);

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-movie.png';
_::$meta['title'] = 'หนัง หนังใหม่ ดูหนังออนไลน์ ตัวอย่างหนัง ดูหนังใหม่ ดูหนังฟรี ดูหนังออนไลน์ฟรี วิจารณ์หนัง';
_::$meta['description'] = 'หนัง หนังใหม่ ดูหนังออนไลน์ฟรี ตัวอย่างหนัง ดูหนังใหม่ วิจารณ์หนัง ภาพยนตร์ก่อนเข้าโรงทุกเรื่อง ทุกสไตล์ ทั้งไทยและเทศ ฟรี';
_::$meta['keywords'] = 'หนัง, หนังใหม่, ดูหนังออนไลน์, ตัวอย่างหนัง, ดูหนังใหม่, ดูหนังฟรี, ดูหนังออนไลน์ฟรี, วิวจารณ์หนัง';

$cate=array(
	'action'=>'หนังต่อสู้ - Action',
	'adventure'=>'หนังผจญภัย - Adventure',
	'animation'=>'หนังการ์ตูน - Animation',
	'biography'=>'หนังชีวประวัติ - Biography',
	'comedy'=>'หนังตลก - Comedy',
	'crime'=>'หนังอาชญากรรม - Crime',
	'documentary'=>'หนังสารคดี - Documentary',
	'drama'=>'หนังชีวิต- Drama',
	'family'=>'หนังครอบครัว - Family',
	'fantasy'=>'หนังเทพนิยาย - Fantasy',
	'history'=>'หนังประวัติศาสตร์ - History',
	'horror'=>'หนังสยองขวัญ - Horror',
	'mystery'=>'หนังลึกลับซ่อนเงื่อน - Mystery',
	'monster'=>'หนังสัตว์ประหลาด - Monster',
	'musical'=>'หนังเพลง - Musical',
	'romance'=>'หนังรัก - Romance',
	'sci-fi'=>'หนังวิทยาศาสตร์ - Sci-Fi',
	'series'=>'หนังซีรีย์ - Series',
	'sport'=>'หนังกีฬา - Sport',
	'thriller'=>'หนังระทึกขวัญ - Thriller',
	'war'=>'หนังสงคราม - War',
	'western'=>'หนังคาวบอยตะวันตก - Western'
);

$type=array('thai'=>'ไทย','inter'=>'สากล','japan'=>'ญี่ปุ่น','korea'=>'เกาหลี','china'=>'จีน');
$zone=array('now-showing'=>'หนังใหม่','coming-soon'=>'โปรแกรมหน้า');
$template=_::template();
$template->assign('type',$type);
$template->assign('cate',$cate);
$template->assign('zone',$zone);

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'_global'))
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
$template->assign('lotto',$data['lotto']);
$template->assign('service',$data['service']);

require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'admin'=>'admin',
																	'news'=>'news',
													),
													true,
													function()
													{
														$url=explode('-',_::$path[0]);
														if(is_numeric($url[0]))
														{
															define('MODULE','view');
														}
														else
														{
															define('MODULE','list');
														}
													}
									)
);


$template->display('content');

?>