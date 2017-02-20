<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'gas-type'=>'gas-type',
						'gas-brand'=>'gas-brand',
						'lpg-type'=>'lpg-type',
						'lpg-brand'=>'lpg-brand',
						'ngv'=>'ngv',
						'apps'=>'apps',
);


if(isset($serv[_::$path[0]]))
{
	$db=_::db();


	$brand_gas=array(
								'ปตท PTT',
								'บางจาก BCP',
								'เชลล์ Shell',
								'เอสโซ่ Esso',
								'เชฟรอน Chevron',
								'ไออาร์พีซี IRPC',
								'ภาคใต้ เชื้อเพลิง PT',
								'ซัสโก้ Susco',
								'เพียว Pure',
								'ปิโตรนาส Petronas'
	);
	$type_gas=array(
							'แก๊สโซฮอล 95 E10 <small>(Gasohol 95-E10)</small>',
							'แก๊สโซฮอล 95 E20 <small>(Gasohol 95-E20)</small>',
							'แก๊สโซฮอล 95 E85 <small>(Gasohol 95-E85)</small>',
							'แก๊สโซฮอล 91 E10 <small>(Gasohol 91-E10)</small>',
							'เบนซิน 95 <small>(ULG 95 RON)</small>',
							'ดีเซลหมุนเร็ว <small>(HSD, 0.005%S)</small>'
	);
	$type_lpg=array(
							'ถังขนาด 4 กิโลกรัม',
							'ถังขนาด 7 กิโลกรัม',
							'ถังขนาด 11.5 กิโลกรัม',	 	 
							'ถังขนาด 13.5 กิโลกรัม', 
							'ถังขนาด 15 กิโลกรัม',
							'ถังขนาด 48 กิโลกรัม'
	);
	$brand_lpg=array(
								'PTT ปตท',
								'UNIQUE GAS แก๊ส',	
								'SIAM GAS แก๊ส',
								'PICNIC ปิคนิคแก๊ส',
								'WORLD GAS เวิลด์แก๊ส',
								'V 2 GAS แก๊ส'
	);


	$template->assign('brand_gas',$brand_gas);
	$template->assign('type_gas',$type_gas);
	$template->assign('brand_lpg',$brand_lpg);
	$template->assign('type_lpg',$type_lpg);
	
	
	$template->assign('msg',$db->findone('msg',array('_id'=>'oil')));

	require_once(__DIR__.'/mobile.oil.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.oil.home.php');
}


echo $template->fetch('oil');
exit;
?>