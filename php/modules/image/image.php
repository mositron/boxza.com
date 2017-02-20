<?php

# check session/login
_::session();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-forum.png';
_::$meta['title'] = 'ฝากรูป ฝากรูปฟรี ฝากรูปภาพฟรี ไม่ลบไม่ล่ม มี API ใช้งานผ่านเว็บอื่นได้ รวดเร็วทันใจกับ boxza';
_::$meta['description'] = 'ฝากรูปภาพฟรีสูงสุดถึง 10MB ต่อรูปภาพ ไม่ลบ ไม่ล่ม มีระบบ API สำหรับเว็บมาสเตอร์ใช้งานผ่านเว็บอื่นได้ รวดเร็วทันใจพร้อมนำไปใช้งานได้ทันที';
_::$meta['keywords'] = 'ฝากรูป, ฝากรูปภาพ, ฝากรูปฟรี, ฝากรูปภาพฟรี';


if(!$_COOKIE['sesimage'])
{
	define('SESIMAGE',_::$ses);
	setcookie('sesimage',SESIMAGE,time()+(3600*24*365),'/','image.boxza.com');
}
else
{
	define('SESIMAGE',$_COOKIE['sesimage']);
}

$template=_::template();

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	//$data['profile']=$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>25));
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner(_::$type);
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}

$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);

# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'v' => 'view',
																	'my'=>'my',
																	'api'=>'api',
																	'recent'=>'recent',
																	'upload'=>'upload',
																	'developer'=>'developer',
																	'report'=>'report',
													)
									)
);

$template->display('content');

?>