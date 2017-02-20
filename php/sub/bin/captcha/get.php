<?php
//session_start();
//echo phpinfo();
list($vars,$rand)=explode('.',$_SERVER['QUERY_STRING']);
$pool=range('A','Z');
$capcha='';
//$pool=array_merge(range('A','Z'),range(0,9));

for($i=0;$i<5;$i++) $capcha.=$pool[mt_rand(0,count($pool)-1)];
setcookie('cp-'.$vars, md5(strtoupper('@cp:'.$vars.':'.$capcha)),  time()+900, '/', 'boxza.com');
setcookie('cp', $capcha,  time()+900, '/', 'boxza.com');
header('Content-type: image/png');
$image = imagecreatefrompng(dirname(__FILE__).'/capcha.png');
$stringcolor=imagecolorallocate($image, 0, 0, 0);
for($i=0;$i<strlen($capcha);$i++)
{
	imagettftext($image,26,rand(-15,15),($i*38)+10,30,$stringcolor,dirname(__FILE__).'/supermarket.ttf',mb_substr($capcha,$i,1,'utf-8'));
}
imagepng($image);
imagedestroy($image);
?>