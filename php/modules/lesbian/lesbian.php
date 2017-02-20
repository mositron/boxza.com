<?php

# check session/login
_::session();

//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-lesbian.png';
_::$meta['title'] = 'เลสเบี้ยน ทอม ดี้ เลสคิง เลสควีน เลสรุก เลสรับ เลสไบ เลสทูเวย์ เลสหาเพื่อน หาเพื่อนเลสเบี้ยน หาเพื่อนทอม หาเพื่อนดี้ หญิงรักหญิง';
_::$meta['description'] = 'เลสเบี้ยน ทอม ดี้ เลสคิง เลสควีน เลสรุก เลสรับ เลสไบ เลสทูเวย์ เลสหาเพื่อน หาเพื่อนเลสเบี้ยน หาเพื่อนทอม หาเพื่อนดี้ หญิงรักหญิง แลกเปลี่ยนพูดคุย หาเพื่อน หาคู่ได้ที่นี่';
_::$meta['keywords'] = 'เลสเบี้ยน, ทอม, ดี้, เลสคิง, เลสควีน, เลสรุก, เลสรับ, เลสไบ, เลสทูเวย์, เลสหาเพื่อน, หาเพื่อนเลสเบี้ยน, หาเพื่อนทอม, หาเพื่อนดี้, หญิงรักหญิง';



$zone = array(
						'1'=>array('n'=>'กรุงเทพและปริมณฑล','l'=>array(2,19,24,29,60,62)),
						'2'=>array('n'=>'ภาคเหนือ','l'=>array(5,13,14,23,26,34,37,38,40,41,45,53,54,75,76)),
						'3'=>array('n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>array(4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77)),
						'4'=>array('n'=>'ภาคตะวันตก','l'=>array(3,17,30,39,51)),
						'5'=>array('n'=>'ภาคตะวันออก','l'=>array(7,8,9,16,31,50)),
						'6'=>array('n'=>'ภาคกลาง','l'=>array(2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72)),
						'7'=>array('n'=>'ภาคใต้','l'=>array(1,12,15,22,25,32,35,36,42,47,49,58,59,68))
);
$type=array(''=>'เลสเบี้ยน','les1'=>'ทอม','les2'=>'ดี้','les3'=>'เลสคิง','les4'=>'เลสควีน','les5'=>'เลสไบ','les6'=>'เลสทูเวย์');
$province=require(HANDLERS.'boxza/province.php');

$template=_::template();
$template->assign('province',$province);
$template->assign('zone',$zone);
$template->assign('type',$type);

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	$data['_banner']=_::banner(_::$type);
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);

# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'friend'=>'friend',
																	'admin'=>'admin',
																	'report'=>'report',
																	'forum'=>'forum',
																	'chat'=>'chat',
													)
									)
);

$template->display('content');


?>