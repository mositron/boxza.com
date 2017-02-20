<?php


# check session/login
_::session();


define('NEWS_CATE',15);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'สถานที่ท่องเที่ยว ท่องเที่ยว เทศกาล ที่พัก โรงแรม ร้านอาหาร น้ำตก ทะเล ภูเขา ทัวร์ เที่ยวไทย เที่ยวเมืองนอก';
_::$meta['description'] = 'ศูนย์รวมข้อมูลสถานที่ท่องเที่ยว แหล่งท่องเที่ยว ที่พัก โรงแรม ร้านอาหาร น้ำตก ภูเขา ทะเล เที่ยวทั่วไทย เที่ยวเกาหลี เที่ยวจีน เที่ยวญี่ปุ่น เที่ยวเมืองนอก';
_::$meta['keywords'] = 'สถานที่ท่องเที่ยว, ท่องเที่ยว, ที่พัก, โรงแรม, ร้านอาหาร, น้ำตก, ภูเขา, ทะเล, ทั่วไทย, เกาหลี, ญี่ปุ่น, จีน, เมืองนอก';
			

$clink=array('taste'=>1,'nightlife'=>2,'sea'=>3,'mountain'=>4,'abroad'=>5,'thai'=>6,'bangkok'=>7,'tips'=>8,'festival'=>9);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'พาชิม','l'=>$rlink[1],'tt'=>'พาชิม ชวนชิม ร้านอาหาร'),
						2=>array('t'=>'เที่ยงกลางคืน','l'=>$rlink[2],'tt'=>'เที่ยวกลางคืน ไนท์ไลฟ์ Nightlight'),
						3=>array('t'=>'เที่ยวทะเล','l'=>$rlink[3],'tt'=>'เที่ยวทะเล พัทยา ภูเก็ต อ่าวไทย อันดามัน'),
						4=>array('t'=>'เที่ยวภูเขา','l'=>$rlink[4],'tt'=>'เที่ยวภูเขา'),
						5=>array('t'=>'เทศกาล ประเพณี','l'=>$rlink[5],'tt'=>'เที่ยวเทศกาล ประเพณี'),
						6=>array('t'=>'เที่ยวทั่วไทย','l'=>$rlink[6],'tt'=>'ท่องเที่ยวไทย เที่ยวทั่วไทย'),
						7=>array('t'=>'เที่ยวกรุงเทพ','l'=>$rlink[7],'tt'=>'เที่ยวกรุเทพ กรุงเทพมหานคร'),
						8=>array('t'=>'เที่ยวต่างประเทศ','l'=>$rlink[8],'tt'=>'เที่ยวต่างประเทศ ทัวร์ต่างประเทศ เกาหลี ญี่ปุ่น จีน ฮ่องกง'),
						9=>array('t'=>'Tips ท่องเที่ยว','l'=>$rlink[9],'tt'=>'Tips ท่องเที่ยว แนะนำการเที่ยว'),
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