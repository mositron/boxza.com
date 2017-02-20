<?php


# check session/login
_::session();
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-deal.png';
_::$meta['title'] = 'ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ วิทยุออนไลน์ ฟังเพลง24ชม';
_::$meta['description'] = 'ฟังเพลงออนไลน์ ฟังเพลง ฟังวิทยุออนไลน์ทุกคลื่นทั่วไทย ฟังเพลงรัก ฟังเพลงอกหัก ฟังเพลงใหม่ ทั้งไทยและสากลได้ที่นี่';
_::$meta['keywords'] = 'ฟังเพลง, วิทยุออนไลน์, ฟังวิทยุออนไลน์, ฟังเพลงออนไลน์, วิทยุออนไลน์, วิทยุ, ออนไลน์';

$tmp=require(HANDLERS.'boxza/radio.php');

$radio=array();
$rlink=array();
foreach($tmp as $k=>$v)
{
	if($v['ty']=='flash')
	{
		$rlink[$v['l']]=$k;
		$radio[$k]=$v;
	}
}

$template=_::template();
$template->assign('radio',$radio);

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	//$data['profile']=$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>25));
	$data['service']=_::sidebar()->service(array('football'=>0,'beauty'=>0,'lesbian'=>0,'boyz'=>0));
	$data['_banner']=_::banner(_::$type);
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto']=$lotto[0];
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('profile',$data['profile']);
$template->assign('service',$data['service']);
$template->assign('lotto',$data['lotto']);
$template->assign('_banner',$data['_banner']);
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
													),
													true,
													function()
													{
														define('MODULE','view');
													}
									)
);

$template->display('content');

?>