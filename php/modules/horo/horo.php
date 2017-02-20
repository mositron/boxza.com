<?php

# check session/login
_::session();
//_::time();
define('NEWS_CATE',20);

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-deal.png';
_::$meta['title'] = 'ดูดวง ดูดวงรายวัน ดูดวงความรัก ทำนายฝัน ดูดวงวันเกิด ดูดวงไพ่ยิปซี ดูดวงเนื้อคู่ ดูดวงเบอร์โทรศัพท์  ดูดวงเบอร์มือถือ ทํานายความฝัน';
_::$meta['description'] = 'ศูนย์รวมข้อมูล ดูดวง ดูดวงความรัก ดูดวงรายวัน ทำนายฝัน ดูดวงไพ่ยิปซี ดูดวงวันเกิด ดูดวงเนื้อคู่ ดูดวงเบอร์โทรศัพท์  ดูดวงเบอร์มือถือ หมอดู เปิดให้บริการฟรี.';
_::$meta['keywords'] = 'ดูดวง, ดูดวงรายวัน, ดูดวงไพ่ยิปซี, ดูดวงเนื้อคู่, ดูดวงความรัก, ดูดวงวันเกิด, ดูดวงรายวัน, ดูดวงประจำวัน, ดูดวงเบอร์โทรศัพท์, ทํานายความฝัน';


$clink=array('daily'=>1,'love'=>2,'tarot'=>3,'monthly'=>4,'charactor'=>5,'dream'=>6,'yearly'=>7);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'ดูดวงรายวัน','l'=>$rlink[1],'tt'=>'ดูดวงรายวัน ดูดวงประจำวัน ดูดวงรายวันล่าสุด'),
						4=>array('t'=>'ดูดวงรายเดือน','l'=>$rlink[4],'tt'=>'ดูดวงรายเดือน ดูดวงประจำเดือน ดูดวงเดือน'.(time::$month[date('n')-1]).' ดูดวงประจำเดือนนี้ ดูดวงประจำเดือนล่าสุด'),
						7=>array('t'=>'ดูดวงรายปี','l'=>$rlink[7],'tt'=>'ดูดวงรายปี ดูดวงประจำปี ดูดวงปี '.(date('Y')+543)),
						2=>array('t'=>'ดูดวงความรัก','l'=>$rlink[2],'tt'=>'ดูดวงความรัก ดูดวงเนื้อคู่'),
						3=>array('t'=>'ดูดวงไพ่ยิบซี','l'=>$rlink[3],'tt'=>'ดูดวงไพ่ยิบซี ดูดวงไพ่ทาโร่ ดูดวงด้วยไพ่'),
						5=>array('t'=>'ทายนิสัย','l'=>$rlink[5],'tt'=>'ทายนิสัย ทำนายนิสัย'),
						6=>array('t'=>'ทำนายฝัน','l'=>$rlink[6],'tt'=>'ทำนายฝัน ทายฝัน'),
);


$template=_::template();
$template->assign('cate',$cate);

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	//$data['profile']=$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>25));
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner(_::$type);
	
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto']=$lotto[0];
	
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('profile',$data['profile']);
$template->assign('service',$data['service']);
$template->assign('lotto',$data['lotto']);


# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'phone' => 'phone',
																	'news'=>'news',
																	'forum'=>'forum',
													),
													true,
													function()
													{
														global $clink;
														if(isset($clink[_::$path[0]]))
														{	
															define('MODULE','news');
															define('MODULE_LINK',_::$path[0]);
															array_shift(_::$path);
														}
														else
														{
															_::move('/');	
														}
													}
									)
);

$template->display('content');

?>