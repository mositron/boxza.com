<?php


# check session/login
_::session();


define('NEWS_CATE',23);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'สุขภาพ สุขภาพน่ารู้ การออกกำลังกาย โรคภัยไข้เจ็บ สมุนไพร';
_::$meta['description'] = 'ศูนย์รวมข้อมูลสุขภาพ สุขภาพน่ารู้ การออกกำลังกาย โรคภัยไข้เจ็บ สมุนไพร การดูแลเกี่ยวกับสุขภาพ';
_::$meta['keywords'] = 'สุขภาพ, ออกกำลังกาย, โรคภัย, ไข้เจ็บ, สมุนไพร';
			

$clink=array('news'=>1,'fitness'=>2,'disease'=>3,'herbal'=>4,'food'=>5);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'สุขภาพน่ารู้','l'=>$rlink[1],'tt'=>'สุขภาพน่ารู้'),
						2=>array('t'=>'โรคภัยไข้เจ็บ','l'=>$rlink[2],'tt'=>'โรคภัยไข้เจ็บ'),
						3=>array('t'=>'ออกกำลังกาย','l'=>$rlink[3],'tt'=>'ออกกำลังกาย'),
						4=>array('t'=>'สมุนไพร','l'=>$rlink[4],'tt'=>'สมุนไพร'),
						5=>array('t'=>'อาหาร','l'=>$rlink[4],'tt'=>'อาหารเพื่อสุขภาพ'),
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