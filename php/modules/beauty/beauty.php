<?php


# check session/login
_::session();

//_::time();

_::$meta['title'] = 'ผู้หญิง แต่งหน้า เสริมสวย ความงาม สุขภาพ แฟชั่น ทรงผม ความรัก ซุบซิบดารา ครบทุกเรื่องราวสำหรับผู้หญิง';
_::$meta['description'] = 'ผู้หญิง ความงาม เสริมสวย สุขภาพ แฟชั่น ทรงผม ความรัก ครบทุกเรื่องราวสำหรับผู้หญิง ทุกอย่างที่คุณต้องรู้';
_::$meta['keywords'] = 'ผู้หญิง, สุขภาพ, ความงาม, เสริมสวย, แฟนชั่น, ผู้หญิง, แต่งหน้า, ทรงผม, ความรัก';

$clink=array('review'=>1,'wedding'=>2,'healthy'=>3,'howto'=>4,'fashion'=>5,'news'=>6);						
$rlink=array_flip($clink);
$cate=array(
'1'=>array('t'=>'รีวิว','l'=>$rlink[1]),
'2'=>array('t'=>'แต่งงาน','l'=>$rlink[2]),
'3'=>array('t'=>'สุขภาพ','l'=>$rlink[3]),
'4'=>array('t'=>'สาธิต','l'=>$rlink[4]),
'5'=>array('t'=>'แฟชั่น','l'=>$rlink[5]),
'6'=>array('t'=>'รู้หรือไม่','l'=>$rlink[6]),
);

$template=_::template();
$template->assign('cate',$cate);



$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'_global'))
{
	$db=_::db();
	$user=_::user();
	$data=array();
	$data['h2']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h2'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'f.brand'=>1),array('sort'=>array('ho.h2'=>-1),'limit'=>4)));
	$data['h3']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h3'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h3'=>-1),'limit'=>6)));
	$data['h4']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h4'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'u'=>1),array('sort'=>array('ho.h4'=>-1),'limit'=>6)));
	for($i=0;$i<count($data['h4']);$i++)
	{
		$data['h4'][$i]['un']=$user->profile($data['h4'][$i]['u'],false);
	}
	$data['h8']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h8'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h8'=>-1),'limit'=>4)));
	$data['_banner']=_::banner(_::$type);
	
	$cache->set('ca1',_::$type.'_global',$data,false,600);
}


$template->assign('data',$data);
$template->assign('_banner',$data['_banner']);

require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'home2' => 'home2',
																	'chat'=>'chat',
																	'forum'=>'forum',
																	
																	'news'=>'news',
																	'review'=>'news',
																	'wedding'=>'news',
																	'healthy'=>'news',
																	'howto'=>'news',
																	'fashion'=>'news',
													)
									)
);

$template->display('content');

?>