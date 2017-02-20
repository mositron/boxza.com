<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'ข่าวบันเทิง ข่าวดารา รูปดารา คลิปดารา ภาพหลุดดารา ซุบซิบดารา ดาราไทย ดาราเกาหลี ดารา นักร้อง นักแสดง ภาพยนต์ หนัง ละคร ดาราเกาหลี';
_::$meta['description'] = 'บันเทิง ข่าวบันเทิง ข่าวดารา ดารา คลิปดารา ภาพหลุดดารา รูปดารา ดาราเกาหลี ดาราไทย นักร้อง นักแสดง เกาะติดกระแสดารา ซุบซิบดารา';
_::$meta['keywords'] = 'บันเทิง, ข่าวบันเทิง, ข่าวดารา, ดารา, ข่าวดารา, คลิปดารา, นักร้อง, นักแสดง, ซุบซิบดารา, ภาพหลุดดารา, รูปดารา, ดาราไทย, ดาราเกาหลี';
			
				
$clink=array('gossip'=>1,'news'=>2,'video'=>3,'event'=>4,'hollywood'=>5,'asian'=>6,'drama'=>7,'movie'=>8);
$rlink=array_flip($clink);
$cate=array(
'1'=>array('t'=>'ซุบซิบดารา','l'=>$rlink[1]),
'2'=>array('t'=>'เกาะกระแส','l'=>$rlink[2]),
'3'=>array('t'=>'คลิปดารา','l'=>$rlink[3]),
'4'=>array('t'=>'กิจกรรม','l'=>$rlink[4]),
'5'=>array('t'=>'บันเทิงฮอลลีวู้ด','l'=>$rlink[5]),
'6'=>array('t'=>'บันเทิงเอเชีย','l'=>$rlink[6]),
'7'=>array('t'=>'เรื่องย่อละคร','l'=>$rlink[7]),
'8'=>array('t'=>'ภาพยนตร์','l'=>$rlink[8]),
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
																	'gossip'=>'news',
																	'video'=>'news',
																	'event'=>'news',
																	'hollywood'=>'news',
																	'asian'=>'news',
																	'drama'=>'news',
																	'photo'=>'news',
																	'movie'=>'news',
																	'news'=>'news',
																	'forum'=>'forum',
													),
													true
									)
);


$template->display('content');

?>