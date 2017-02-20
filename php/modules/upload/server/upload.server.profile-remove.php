<?php

if($_POST['file'])
{
	$f=false;
	$log=array();
	if(mb_strlen($_POST['file'],'utf-8')==8)
	{
		$path=UPLOAD_PATH.'profile/'.$_POST['file'];
		if(is_dir($path))
		{
			_::folder()->clean(UPLOAD_FOLDER.'profile/'.$_POST['file']);	
			$status=array('status'=>'OK','data'=>array());
		}
		else
		{
			$error='folder not found';
		}
	}
	else
	{
		$error='invalid folder';
	}
}
else
{
	$error='no folder';
}


?>