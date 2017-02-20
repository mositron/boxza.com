<?php

# check session/login
_::session();

//_::time();

_::$meta['title'] = 'เกย์ สังคมชาวเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน หาเพื่อนเกย์ สังคมชาวเกย์ ชายรักชาย กระเทย ตุ๊ด';
_::$meta['description'] = 'เกย์ สังคมชาวเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน ชายรักชาย แลกเปลี่ยนพูดคุย หาเพื่อน หาคู่ได้ที่นี่';
_::$meta['keywords'] = 'เกย์, เกย์ไบ, เกย์โบท, เกย์คิง, เกย์ควีน, ชายรักชาย, หาเพื่อนเกย์';

$zone = array(
						'1'=>array('n'=>'กรุงเทพและปริมณฑล','l'=>array(2,19,24,29,60,62)),
						'2'=>array('n'=>'ภาคเหนือ','l'=>array(5,13,14,23,26,34,37,38,40,41,45,53,54,75,76)),
						'3'=>array('n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>array(4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77)),
						'4'=>array('n'=>'ภาคตะวันตก','l'=>array(3,17,30,39,51)),
						'5'=>array('n'=>'ภาคตะวันออก','l'=>array(7,8,9,16,31,50)),
						'6'=>array('n'=>'ภาคกลาง','l'=>array(2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72)),
						'7'=>array('n'=>'ภาคใต้','l'=>array(1,12,15,22,25,32,35,36,42,47,49,58,59,68))
);
$type=array(''=>'เกย์','gay1'=>'เกย์คิง','gay2'=>'เกย์ควีน','gay3'=>'เกย์ไบ','gay4'=>'เกย์โบท','boy'=>'ชาย','boy2'=>'กระเทย','ladyboy'=>'สาวประเภทสอง','lesbian'=>'เลสเบี้ยน');
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