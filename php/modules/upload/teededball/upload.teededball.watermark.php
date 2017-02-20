<?php

if($_POST['file']&&$_POST['data']['watermark'])
{
	$f=UPLOAD_PATH.$_POST['file'];
	$w=UPLOAD_PATH.$_POST['data']['watermark'];
	if(file_exists($f)&&file_exists($w))
	{
		exec('/usr/local/bin/convert '.$f.' -gravity northeast -geometry +0+0 null: '.$w.' -layers composite -quality 90 '.$f);	
	}
	$status=array('status'=>'OK');
}
?>