<?php


# check session/login
_::session();


define('NEWS_CATE',18);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'สัตว์เลี้ยง สุนัข หมา แมว นก ปลา กระต่าย หนู ซื้อขาย แลกเปลี่ยน ขายสุขนัข ขายแมว ขายสัตว์เลี้ยง';
_::$meta['description'] = 'ศูนย์รวมข้อมูลสัตว์เลี้ยง สุนัข หมา แมว นก ปลา กิ้งก่า งู กระต่าย หนู ตลาดซื้อขาย แลกเปลี่ยน ขายสุขนัข ขายหมา ขายแมว ขายสัตว์เลี้ยงและอื่นๆอีกมากมาย';
_::$meta['keywords'] = 'สัตว์เลี้ยง, สุนัข, หมา, แมว, นก, ปลา, หนู, ปลา, กิ้งก่า, ขายสุนัข, ขายหมา, ขายแมว, ขายสัตว์เลี้ยง';
			

$clink=array('dog'=>1,'cat'=>2,'aquatic'=>3,'poultry'=>4,'animal'=>5);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'สุนัข','l'=>$rlink[1],'tt'=>'สุนัข หมา ชิสุ พุดเดิ้ล ชิวาว่า ปอม ไซบีเรียนฮัสกี้'),
						2=>array('t'=>'แมว','l'=>$rlink[2],'tt'=>'แมว แมวเปอร์เซีย แมวไทย'),
						3=>array('t'=>'ปลา สัตว์น้ำ','l'=>$rlink[3],'tt'=>'ปลา สัตว์น้ำ กุ้ง'),
						4=>array('t'=>'นก สัตว์ปีก','l'=>$rlink[4],'tt'=>'นก สัตว์ปีก'),
						5=>array('t'=>'สัตว์เลี้ยงทั่วไป','l'=>$rlink[5],'tt'=>'สัตว์เลี้ยงทั่วไป หนู กิ้งก่า งู'),
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