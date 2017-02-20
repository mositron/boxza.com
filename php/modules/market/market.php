<?php
# check session/login
_::session();

_::$meta['image']='http://s0.boxza.com/static/images/global/logo-deal.png';
_::$meta['title'] = 'ลงประกาศฟรี ลงโฆษณาฟรี ประกาศซื้อขายฟรี พร้อมเปิดร้านบน facebook ได้ง่ายๆและฟรี';
_::$meta['description'] = 'ลงโฆษณาฟรี ลงประกาศฟรี ประกาศซื้อขายฟรี ครอบคลุมและครบครัน ทุกจังหวัดทุกประเภทสินค้า';
_::$meta['keywords'] = 'ลงโฆษณาฟรี, ลงประกาศฟรี, ประกาศซื้อขายฟรี, สินค้า, ประกาศ, ซื้อ, ขาย';


$zone = array(
						'1'=>array('n'=>'กรุงเทพและปริมณฑล','l'=>array(2,19,24,29,60,62)),
						'2'=>array('n'=>'ภาคเหนือ','l'=>array(5,13,14,23,26,34,37,38,40,41,45,53,54,75,76)),
						'3'=>array('n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>array(4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77)),
						'4'=>array('n'=>'ภาคตะวันตก','l'=>array(3,17,30,39,51)),
						'5'=>array('n'=>'ภาคตะวันออก','l'=>array(7,8,9,16,31,50)),
						'6'=>array('n'=>'ภาคกลาง','l'=>array(2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72)),
						'7'=>array('n'=>'ภาคใต้','l'=>array(1,12,15,22,25,32,35,36,42,47,49,58,59,68))
);
$type=array('buy'=>'ซื้อ','sell'=>'ขาย','rent'=>'เช่า','let'=>'ให้เช่า','service'=>'ให้บริการ','free'=>'แจกฟรี','sug'=>'แนะนำ','notice'=>'ประกาศ(แจ้งให้ทราบ)');
$status=array('new'=>'สินค้าใหม่','sec'=>'สินค้ามือสอง','100'=>'สภาพ 100%','99'=>'สภาพ 99%','98'=>'สภาพ 98%','95'=>'สภาพ 95%','90'=>'สภาพ 90%','80'=>'สภาพ 80%','70'=>'สภาพ 70%','60'=>'สภาพ 60%','50'=>'สภาพ 50%','49'=>'น้อยกว่า 50%');
$province=require(HANDLERS.'boxza/province.php');

$template=_::template();
$tmp=_::db()->find('deal_cate',array(),array(),array('sort'=>array('_id'=>1)));
$acate=array();
$cate=array();
for($i=0;$i<count($tmp);$i++)
{
	$acate[$tmp[$i]['_id']]=$tmp[$i];
	if($tmp[$i]['p'])
	{
		$cate[$tmp[$i]['p']]['l'][]=$tmp[$i];
	}
	else
	{
		$cate[$tmp[$i]['_id']]=array('n'=>$tmp[$i],'l'=>array());
	}
}

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'_global'))
{
	$data=array();
	$data['_banner']=_::banner(_::$type);
	$data['service']=_::sidebar()->service();
	
	$cache->set('ca1',_::$type.'_global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);

$template->assign('province',$province);
$template->assign('zone',$zone);
$template->assign('type',$type);
$template->assign('status',$status);
$template->assign('acate',$acate);
$template->assign('cate',$cate);

# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'post'=>'post',
																	'manage'=>'manage',
																	'update'=>'update',
													),
													true,
													function()
													{
														$url=explode('-',_::$path[0]);
														if(is_numeric($url[0]))
														{
															define('MODULE','view');
														}
														else
														{
															define('MODULE','list');
														}
													}
									)
);

$template->display('content');

?>