<?php

define('APP_VERSION','1.0');

$user=base64_decode($_GET['user']);
//echo '--'.$user.'---';
$fb=json_decode($user,true);
//print_r(json_decode($user,true));

if($fb['id']&&$fb['name']&&$fb['token'])
{
	
}
elseif(!_::$my || _::$my['_id']!=1)
{
	//_::move('https://play.google.com/store/apps/details?id=com.doodroid.friend',true);
	//exit;
}

define('FB_ID',strval($fb['id']));

$zone = array(
						'1'=>array('n'=>'กรุงเทพและปริมณฑล','l'=>array(2,19,24,29,60,62)),
						'2'=>array('n'=>'ภาคเหนือ','l'=>array(5,13,14,23,26,34,37,38,40,41,45,53,54,75,76)),
						'3'=>array('n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>array(4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77)),
						'4'=>array('n'=>'ภาคตะวันตก','l'=>array(3,17,30,39,51)),
						'5'=>array('n'=>'ภาคตะวันออก','l'=>array(7,8,9,16,31,50)),
						'6'=>array('n'=>'ภาคกลาง','l'=>array(2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72)),
						'7'=>array('n'=>'ภาคใต้','l'=>array(1,12,15,22,25,32,35,36,42,47,49,58,59,68))
);

$type=array('girl'=>'หญิง','boy'=>'ชาย','lesbian'=>'เลสเบี้ยน','gay'=>'เกย์','ladyboy'=>'สาวประเภทสอง');
$province=require(HANDLERS.'boxza/province.php');

$template=_::template();
$template->assign('fb',$fb);
$template->assign('zone',$zone);
$template->assign('type',$type);
$template->assign('province',$province);

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'girl'=>'girl',
						'boy'=>'boy',
						'lesbian'=>'lesbian',
						'gay'=>'gay',
						'ladyboy'=>'ladyboy',
);

$cate=array();

$template->assign('cate',$cate);
if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.friend.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.friend.home.php');
}


echo $template->fetch('friend');
exit;
?>