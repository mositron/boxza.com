<?php


# check session/login
_::session();

_::$meta['image']='http://s0.boxza.com/static/images/global/logo-friend.png';
_::$meta['title'] = 'หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย แชท msn กล้อง เว็บแคม พบปะพูดคุยกับเพื่อนใหม่ๆได้ทีนี่';
_::$meta['description'] = 'หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย msn ออกเดท พบปะพูดคุยกับเพื่อนใหม่ๆ  ผู้หญิง, ผู้ชาย, เลสเบี้ยน, ทอม, ดี้, เกย์, สาวประเภทสอง ทุกเพศทุกวัยได้ที่นี่';
_::$meta['keywords'] = 'หาเพื่อน, หาแฟน, หากิ๊ก, หาคู่, ออกเดท, พบปะ, พูดคุย, ผู้หญิง, ผู้ชาย, เลสเบี้ยน, ทอม, ดี้, เกย์, สาวประเภทสอง';


$zone = array(
						'1'=>array('n'=>'กรุงเทพและปริมณฑล','l'=>array(2,19,24,29,60,62)),
						'2'=>array('n'=>'ภาคเหนือ','l'=>array(5,13,14,23,26,34,37,38,40,41,45,53,54,75,76)),
						'3'=>array('n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>array(4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77)),
						'4'=>array('n'=>'ภาคตะวันตก','l'=>array(3,17,30,39,51)),
						'5'=>array('n'=>'ภาคตะวันออก','l'=>array(7,8,9,16,31,50)),
						'6'=>array('n'=>'ภาคกลาง','l'=>array(2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72)),
						'7'=>array('n'=>'ภาคใต้','l'=>array(1,12,15,22,25,32,35,36,42,47,49,58,59,68))
);
$type=array('girl'=>'หญิง','boy'=>'ชาย','lesbian'=>'เลสเบี้ยน','gay'=>'เกย์','ladyboy'=>'สาวประเภทสอง');
$province=require(HANDLERS.'boxza/province.php');

$template=_::template();
$template->assign('_banner',_::banner('friend'));
$template->assign('province',$province);
$template->assign('zone',$zone);
$template->assign('type',$type);


require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'post'=>'post',
																	'girl'=>'girl',
																	'boy'=>'boy',
																	'lesbian'=>'lesbian',
																	'gay'=>'gay',
																	'manage'=>'manage',
																	'report'=>'report',
																	'update'=>'update',
																	'fbtab'=>'fbtab',
																	'emoticon'=>'emoticon',
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