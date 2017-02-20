<?php


# check session/login
_::session();


#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'เกมทายใจ เกมส์ทายใจ เกมวัดดวง เกมทายผล เกมตลก เกมฮาฮา';
_::$meta['description'] = 'เกมทายใจ เกมส์ทายใจ เกมส์วัดดวง เกมส์ทายผล เกมส์ตลก เกมส์ฮาฮา เกมส์เฟสบุ๊ค เกมfacebook';
_::$meta['keywords'] = 'เกมทายใจ, เกมส์ทายใจ, เกมทายผล, เกมตลก, เกมวัดดวง';
			

$types=array(
						'once'=>'มีคำตอบให้เลือก (ทำนายผล) - 1 คำถาม',
						//'multi'=>'มีคำตอบให้เลือก (ทำนายผล) - หลายคำถาม',
						'photo'=>'สุ่มรูปภาพเป็นคำตอบ',
);

$cate=array(
	1=>array('t'=>'การ์ตูน'),
	2=>array('t'=>'เกมส์'),
	3=>array('t'=>'กีฬา'),
	4=>array('t'=>'เพลง ละคร ภาพยนต์'),
	5=>array('t'=>'บันเทิง ดารา นักร้อง'),
	6=>array('t'=>'รถ ยานพาหนะ'),
	7=>array('t'=>'กิจกรรม'),
	8=>array('t'=>'ไลฟ์สไตล์'),
	9=>array('t'=>'ความรัก'),
	10=>array('t'=>'ตลก ขำขัน กวนๆ'),
	11=>array('t'=>'ดวง ทำนาย พยากรณ์'),
	99=>array('t'=>'อื่นๆ')
);
																											
$template=_::template();

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
$template->assign('types',$types);
$template->assign('cate',$cate);

require_once(
									_::run(
													array(
																'' => 'home',
																'home' => 'home',
																'manage'=>'manage',
																'recent'=>'recent',
																'hit'=>'hit',
																'user'=>'user',
																'oauth'=>'oauth',
																'game'=>'game',
													),
													true,
													function()
													{
														global $cate;
														$c=explode('-',_::$path[0]);
														if($c[0]=='cate'&&isset($cate[$c[1]]))
														{
															define('MODULE','category');
															define('MODULE_LINK',$c[1]);
															array_shift(_::$path);
														}
														else
														{
															_::move('/',true);	
														}
													}
									)
);


$template->display('content');


?>