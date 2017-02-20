<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'recent'=>'recent',
						'hit'=>'hit',
						'category'=>'category',
						'ref'=>'ref',
						'view'=>'view',
);


$cate=array(
'1'=>array('t'=>'สัตว์'),
'2'=>array('t'=>'สัตว์ประหลาด'),
'3'=>array('t'=>'คน'),
'4'=>array('t'=>'พืช'),
'99'=>array('t'=>'อื่นๆ')
);

$ref=array(
'fb'=>array('t'=>'Facebook'),
'line'=>array('t'=>'Line by naver'),
'web'=>array('t'=>'Web')
);

$template->assign('cate',$cate);
$template->assign('ref',$ref);
if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.sticker.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.sticker.home.php');
}


echo $template->fetch('sticker');
exit;



function getimgname($i)
{
	$a='123456789abcdefghijklmnopqrstuvwxyz';	
	return $a[$i];
}
function getimgkey($a)
{
	return mb_substr(md5($a.':-:sticker'),0,2);
}
?>