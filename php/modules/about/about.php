<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'คลังข้อมูล';
_::$meta['description'] = 'ศูนย์รวมคลังข้อมูลน่ารู้ภายในประเทศไทย';
_::$meta['keywords'] = 'คลังข้อมูล, คลัง, ข้อมูล';

$cate=array(
						'person'=>'บุคคล',
						'place'=>'สถานที่',
						'activity'=>'กิจกรรม',
						'day'=>'วันสำคัญ',
						'other'=>'อื่นๆ'
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
$template->assign('cate',$cate);


require_once(
									_::run(
													array(
																	'' => 'home',
																	'admin'=>'admin',
																	'person'=>'list',
																	'place'=>'list',
																	'activity'=>'list',
																	'other'=>'list'
													),
													true,
													function()
													{
														define('MODULE','profile');
													}
									)
);


$template->display('content');

?>