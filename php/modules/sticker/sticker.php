<?php


# check session/login
_::session();

if(_::$my['_id']!=1)
{
	_::move('http://boxza.com/');	
}

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'สติ๊กเกอร์ Line ฟรี โหลดสติกเกอร์ฟรี สามารถใช้งานได้ใน Line, Wechat, WhatsApp และอื่นๆ';
_::$meta['description'] = 'โหลดแอพสำหรับใช้งานสติกเกอร์ฟรี ใช้ได้บนไลน์ วอทแอพ วีแชท Line WeChat WhatsApp';
_::$meta['keywords'] = 'สติ๊กเกอร์, ฟรี, Line, ไลน์, WhatsApp, วอทแอพ, WeChat, วีแชท';



$cate=array(
'1'=>array('t'=>'สัตว์'),
'2'=>array('t'=>'สัตว์ประหลาด'),
'3'=>array('t'=>'คน'),
'4'=>array('t'=>'พืช'),
//'5'=>array('t'=>'ของกิน'),
//'6'=>array('t'=>'สิ่งของ'),
//'7'=>array('t'=>'เทศกาล'),
//'8'=>array('t'=>'ตัวอักษร'),
'99'=>array('t'=>'อื่นๆ')
);

$ref=array(
'fb'=>array('t'=>'Facebook'),
'line'=>array('t'=>'Line by naver'),
'web'=>array('t'=>'Web')
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
$template->assign('ref',$ref);

require_once(
									_::run(
													array(
																'' => 'home',
																'home' => 'home',
																'manage'=>'manage',
																'recent'=>'recent',
																'facebook'=>'facebook',
																'line'=>'line',
																'hit'=>'hit',
																'oauth'=>'oauth',
																'view'=>'view',
																'fbimage'=>'fbimage',
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


function getimgname($i)
{
	$a='123456789abcdefghijklmnopqrstuvwxyz';	
	return $a[$i];
}
function getimgkey($a)
{
	return mb_substr(md5($a.':-:sticker'),0,2);
}
?>