<?php

# check session/login
_::session();

define('NEWS_CATE',24);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-music.png';
_::$meta['title'] = 'เพลง เพลงใหม่ เนื้อเพลง เพลงใหม่ๆ เพลงใหม่ล่าสุด ค้นหาเนื้อเพลง ฟังเพลง ฟังเพลงออนไลน์ ทกค่ายเพลง ทุกสังกัด';
_::$meta['description'] = 'เพลง เพลงใหม่ เนื้อเพลง เพลงใหม่ๆ เพลงใหม่ล่าสุด ค้นหาเนื้อเพลง ค้นหาเพลง ค้นหาเพลงใหม่ ฟังเพลงที่คุณต้องการ ทุกค่ายเพลง ทุกสังกัด ที่นี่ที่เดียว';
_::$meta['keywords'] = 'เพลง, เพลงใหม่, เนื้อเพลง, เพลงใหม่ๆ, เพลงใหม่ล่าสุด, ฟังเพลง, ฟังเพลงออนไลน์, ค้นหาเพลง, ค้นหาเนื้อเพลง, แกรมมี่, อาร์เอส, อินดี้';
_::$meta['image']='http://s0.boxza.com/static/images/music/og-logo.png';

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
																	'home' => 'home',
																	'admin'=>'admin',
																	'lyric'=>'lyric',
																	'list'=>'list',
																	'news'=>'news',
													)
									)
);

$template->display('content');


?>