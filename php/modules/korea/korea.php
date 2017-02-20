<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'เกาหลี';
_::$meta['description'] = 'เกาหลี';
_::$meta['keywords'] = 'เกาหลี';
							
$clink=array('news'=>1,'series'=>2,'video'=>3,'photo'=>4,'music'=>5);
$rlink=array_flip($clink);
$cate=array(
'1'=>array('t'=>'ข่าว','l'=>$rlink[1]),
'2'=>array('t'=>'ซีรีย์เกาหลี','l'=>$rlink[2]),
'3'=>array('t'=>'คลิปเกาหลี','l'=>$rlink[3]),
'4'=>array('t'=>'รูปภาพ','l'=>$rlink[4]),
'5'=>array('t'=>'เนื้อเพลง','l'=>$rlink[5]),
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
																	'news'=>'news',
																	'series'=>'news',
																	'video'=>'news',
																	'photo'=>'news',
																	'music'=>'news'
													),
													true
									)
);


$template->display('content');

?>