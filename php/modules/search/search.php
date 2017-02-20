<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-gold.png';
_::$meta['title'] = 'ค้นหา ค้นหาข้อมูล ค้นหาข่าว ค้นหารูปภาพ ภายใน BoxZa.com';
_::$meta['description'] = 'ค้นหาข้อมูล ค้นหาข่าว ค้นหารูปภาพ ค้นหากระทู้ ค้นหาบทความ ภายใน BoxZa.com';
_::$meta['keywords'] = 'ค้นหา, ค้นหาข้อมูล, ค้นหารูปภาพ, ค้นหาข่าว, ค้นหากระทู้, boxza';


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


require_once(
									_::run(
													array(
																	'' => 'home',
													),
													true
									)
);


$template->display('content');

?>