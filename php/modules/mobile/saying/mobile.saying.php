<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'recent'=>'recent',
						'search'=>'search',
						'category'=>'category',
						'view'=>'view',
);


$cate=array(
'ก'=>array('t'=>'ก','i'=>'1'),
'ข'=>array('t'=>'ข','i'=>'2'),
'ฃ'=>array('t'=>'ฃ','i'=>'3'),
'ค'=>array('t'=>'ค','i'=>'4'),
'ฅ'=>array('t'=>'ฅ','i'=>'5'),
'ฆ'=>array('t'=>'ฆ','i'=>'6'),
'ง'=>array('t'=>'ง','i'=>'7'),
'จ'=>array('t'=>'จ','i'=>'8'),
'ฉ'=>array('t'=>'ฉ','i'=>'9'),
'ช'=>array('t'=>'ช','i'=>'10'),
'ซ'=>array('t'=>'ซ','i'=>'11'),
'ฌ'=>array('t'=>'ฌ','i'=>'12'),
'ญ'=>array('t'=>'ญ','i'=>'13'),
'ฎ'=>array('t'=>'ฎ','i'=>'14'),
'ฏ'=>array('t'=>'ฏ','i'=>'15'),
'ฐ'=>array('t'=>'ฐ','i'=>'16'),
'ฑ'=>array('t'=>'ฑ','i'=>'17'),
'ฒ'=>array('t'=>'ฒ','i'=>'18'),
'ณ'=>array('t'=>'ณ','i'=>'19'),
'ด'=>array('t'=>'ด','i'=>'20'),
'ต'=>array('t'=>'ต','i'=>'21'),
'ถ'=>array('t'=>'ถ','i'=>'22'),
'ท'=>array('t'=>'ท','i'=>'23'),
'ธ'=>array('t'=>'ธ','i'=>'24'),
'น'=>array('t'=>'น','i'=>'25'),
'บ'=>array('t'=>'บ','i'=>'26'),
'ป'=>array('t'=>'ป','i'=>'27'),
'ผ'=>array('t'=>'ผ','i'=>'28'),
'ฝ'=>array('t'=>'ฝ','i'=>'29'),
'พ'=>array('t'=>'พ','i'=>'30'),
'ฟ'=>array('t'=>'ฟ','i'=>'31'),
'ภ'=>array('t'=>'ภ','i'=>'32'),
'ม'=>array('t'=>'ม','i'=>'33'),
'ย'=>array('t'=>'ย','i'=>'34'),
'ร'=>array('t'=>'ร','i'=>'35'),
'ฤ'=>array('t'=>'ฤ','i'=>'36'),
'ล'=>array('t'=>'ล','i'=>'37'),
'ฦ'=>array('t'=>'ฦ','i'=>'38'),
'ว'=>array('t'=>'ว','i'=>'39'),
'ศ'=>array('t'=>'ศ','i'=>'40'),
'ษ'=>array('t'=>'ษ','i'=>'41'),
'ส'=>array('t'=>'ส','i'=>'42'),
'ห'=>array('t'=>'ห','i'=>'43'),
'ฬ'=>array('t'=>'ฬ','i'=>'44'),
'อ'=>array('t'=>'อ','i'=>'45'),
'ฮ'=>array('t'=>'ฮ','i'=>'46'),
);


$template->assign('cate',$cate);
if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.saying.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.saying.home.php');
}


echo $template->fetch('saying');
exit;

?>