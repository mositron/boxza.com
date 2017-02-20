<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'เอเชี่ยนเกมส์ 2014';
_::$meta['description'] = 'เอเชี่ยนเกมส์ 2014';
_::$meta['keywords'] = 'เอเชี่ยนเกมส์ 2014';

			
$clink=array('news'=>1,'program'=>2,'video'=>5);
$rlink=array_flip($clink);
$cate=array(
'1'=>array('t'=>'ข่าว','l'=>$rlink[1]),
'2'=>array('t'=>'โปรแกรมการแข่งขัน','l'=>$rlink[2]),
'5'=>array('t'=>'คลิปเอเชียนเกมส์','l'=>$rlink[5]),
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
																	'admin'=>'admin',
																	'news'=>'news',
																	'medal'=>'medal',
																	'program'=>'news',
																	'video'=>'news',
													),
													true
									)
);


$template->display('content');

?>