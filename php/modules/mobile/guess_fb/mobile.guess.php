<?php

//475719729205676

_::$config['social']['facebook']['appid']='475719729205676';

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'recent'=>'recent',
						'hit'=>'hit',
						'category'=>'category',
						'game'=>'game',
);

$cate=array(
	1=>array('t'=>'การ์ตูน'),
	2=>array('t'=>'เกมส์'),
	3=>array('t'=>'กีฬา'),
	4=>array('t'=>'เพลง ละคร ภาพยนต์'),
	5=>array('t'=>'บันเทิง ดารา นักร้อง'),
	6=>array('t'=>'รถ ยานพาหนะ'),
	7=>array('t'=>'กิจกรรม'),
	8=>array('t'=>'ไลฟ์สไตล์'),
	9=>array('t'=>'ความรัก'),
	10=>array('t'=>'ตลก ขำขัน กวนๆ'),
	11=>array('t'=>'ดวง ทำนาย พยากรณ์'),
	99=>array('t'=>'อื่นๆ')
);
$template->assign('cate',$cate);
if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.guess.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.guess.home.php');
}


echo $template->fetch('guess');
exit;
?>