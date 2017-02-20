<?php


# check session/login
_::session();

define('NEWS_CATE',21);

//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'พยากรณ์อากาศ อากาศวันนี้ สภาพอากาศ พยากรณ์อากาศวันนี้ พยากรณ์อากาศพรุ่งนี้ ภาคเหนือ ภาคกลาง ภาคตะวันออก ภาคใต้ ภาคอีสาน และทุกจังหวัดในประเทศไทย';
_::$meta['description'] = 'ศูนย์รวมข้อมูลพยากรณ์อากาศ อากาศวันนี้ สภาพอากาศ พยากรณ์อากาศวันนี้ พยากรณ์อากาศพรุ่งนี้ พยากรณ์อากาศภาคเหนือ พยากรณ์อากาศภาคกลาง พยากรณ์อากาศภาคตะวันออก พยากรณ์อากาศภาคใต้ พยากรณ์อากาศภาคอีสาน ครบทุกจังหวัดในประเทศไทย';
_::$meta['keywords'] = 'พยากรณ์อากาศ, อากาศวันนี้, พยากรณ์อากาศวันนี้, พยากรณ์อากาศพรุ่งนี้, ภาคเหนือ, ภาคกลาง, ภาคตะวันออก, ภาคใต้, ภาคอีสาน, จังหวัด';


$clink=array('forecast'=>1,'warning'=>2);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'สภาพอากาศ','l'=>$rlink[1],'tt'=>'สภาพอากาศ อุณหภูมิ ข่าวสภาพอากาศ'),
						2=>array('t'=>'เตือนภัย','l'=>$rlink[2],'tt'=>'เตือยภัย น้ำท่วม แผ่นดินไหว ฝนตกหนัก ข่าวเตือนภัย'),
);

$zone=array(
							1=>'ภาคเหนือ',
							2=>'ภาคตะวันออกเฉียงเหนือ (อีสาน)',
							3=>'ภาคกลาง',
							4=>'ภาคตะวันออก',
							5=>'ภาคใต้(ฝั่งตะวันออก)',
							6=>'ภาคใต้(ฝั่งตะวันตก)'
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
	
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);
$template->assign('zone',$zone);

require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'place'=>'place',
																	'zone'=>'zone',
																	'news'=>'news',
																	'forum'=>'forum'
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