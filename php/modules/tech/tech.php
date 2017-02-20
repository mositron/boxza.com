<?php


# check session/login
_::session();


define('NEWS_CATE',3);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'เทคโนโลยี ข่าวไอที ทิป-เทคนิค บทความน่ารู้ Gadget แอพแนะนำ';
_::$meta['description'] = 'ศูนย์รวมข้อมูลเทคโนโลยี ข่าวไอที ทิป-เทคนิค บทความน่ารู้ Gadget แอพแนะนำ';
_::$meta['keywords'] = 'เทคโนโลยี, ข่าวไอที, ทิป, เทคนิค, บทความน่ารู้, Gadget, แอพแนะนำ, iPhone, iPad, App, iOS, Android, Apple, Google';

$clink=array('news'=>1,'tips'=>2,'knowledge'=>3,'gadget'=>4,'apps'=>5);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'ข่าวไอที','l'=>$rlink[1],'tt'=>'ข่าวไอที'),
						2=>array('t'=>'ทิป-เทคนิค','l'=>$rlink[2],'tt'=>'ทิป-เทคนิค'),
						3=>array('t'=>'บทความน่ารู้','l'=>$rlink[3],'tt'=>'บทความน่ารู้'),
						4=>array('t'=>'Gadget','l'=>$rlink[4],'tt'=>'Gadget'),
						5=>array('t'=>'แอพแนะนำ','l'=>$rlink[5],'tt'=>'แอพแนะนำ'),
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