<?php

# check session/login
_::session();
//_::time();
define('NEWS_CATE',22);

$day=date('j');
$month=date('n');
$year=date('Y');
#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-lotto.png';
_::$meta['title'] = 'หวย ตรวจหวย เลขเด็ด ตรวจสลากกินแบ่งรัฐบาล สลากกินแบ่ง หวยหุ้น ห้วยหุ้นไทย';
_::$meta['description'] = 'หวย ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล หวยหุ้น ห้วยหุ้นไทย เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว';
_::$meta['keywords'] = 'ตรวจหวย, หวย, ตรวจสลากกินแบ่งรัฐบาล, ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด, หวย, หวยหุ้น, ห้วยหุ้นไทย';

$template=_::template();

$cache=_::cache();
if(!$data=$cache->get('ca1','lotto_global'))
{
	$db=_::db();
	$data=array();
	$data['service']=_::sidebar()->service();
	$data['lotto_all']=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'tm'=>1),array('sort'=>array('tm'=>-1),'limit'=>24));
	$data['lotto_last']=$db->find('lotto',array('dd'=>array('$exists'=>false)),array('_id'=>1,'tm'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto_last']=$data['lotto_last'][0];
	$data['_banner']=_::banner(_::$type);
	$cache->set('ca1','lotto_global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);
$template->assign('lotto_all',(array)$data['lotto_all']);
$template->assign('lotto_last',$data['lotto_last']);


# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'admin'=>'admin',
																	'search'=>'search',
																	'set'=>'set',
																	'forum'=>'forum',
																	'news'=>'news',
																	'lucky'=>'news',
																	'list'=>'list',
																	'live'=>'live',
																	'mobile'=>'mobile',
													),
													true,
													function()
													{
														$url=explode('-',_::$path[0]);
														if(is_numeric($url[0]))
														{
															define('MODULE','view');
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