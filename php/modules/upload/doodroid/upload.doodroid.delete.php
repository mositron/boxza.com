<?php

if($_POST['file'])
{
	$f=UPLOAD_PATH.$_POST['file'];
	if(file_exists($f))
	{
		unlink($f);
	}
	$status=array('status'=>'OK');
}
?>