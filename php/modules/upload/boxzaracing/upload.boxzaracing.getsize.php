<?php

if($_POST['file'])
{
	$file=UPLOAD_PATH.$_POST['file'];
	if(file_exists($file))
	{
		$size=getimagesize($file);
		$status=array('status'=>'OK','data'=>array('w'=>$size[0],'h'=>$size[1],'s'=>filesize($file)));
	}
	else
	{
		$error='file not found';
	}
}
?>