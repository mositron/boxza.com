<?php


# check session/login
_::session();


define('NEWS_CATE',16);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'แม่และเด็ก ตั้งชื่อลูก คู่มือคุณแม่ การตั้งครรภ์ พัฒนาการเด็ก ทารก ให้นมลูก ของเล่นเด็ก';
_::$meta['description'] = 'คู่มือคุณแม่และลูกน้อย ตั้งแต่ การตั้งครรภ์ ตั้งชื่อลูก อาการคนท้อง รวมข้อมูลสำหรับคุณแม่มือใหม่และลูกน้อย ทั้งอาการคนท้อง นิทานก่อนนอน อาหารเด็ก การให้นม และอื่นๆอีกมากมาย';
_::$meta['keywords'] = 'แม่, คุณแม่, ลูก, ลูกน้อย, ทารก, ตั้งครรภ์, ตั้งชื่อ, พัฒนาการเด็ก, ของเล่นเด็ก, ให้นม';
			

$clink=array('mom'=>1,'baby'=>2,'food'=>3,'tale'=>4,'name'=>5,'star'=>6);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'เรื่องน่ารู้คุณแม่','l'=>$rlink[1],'tt'=>'เรื่องน่ารู้คุณแม่ คุณแม่มือใหม่ การตั้งครรภ์ อาการคนท้อง'),
						2=>array('t'=>'เรื่องน่ารู้คุณลูก','l'=>$rlink[2],'tt'=>'เรื่องน่ารู้คุณลูก ทารก การเลี้ยงลูก การให้นมลูก'),
						3=>array('t'=>'อาหารเด็ก','l'=>$rlink[3],'tt'=>'อาหารเด็ก อาหารทารก'),
						4=>array('t'=>'นิทานสำหรับเด็ก','l'=>$rlink[4],'tt'=>'นิทานสำหรับเด็ก นิทานก่อนนอน นิทานกล่อมเด็ก'),
						5=>array('t'=>'ตั้งชื่อลูก','l'=>$rlink[5],'tt'=>'ตั้งชื่อลูก การตั้งชื่อ'),
						6=>array('t'=>'ลูกดารา','l'=>$rlink[6],'tt'=>'ลูกดารา พ่อแม่ดารา'),
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