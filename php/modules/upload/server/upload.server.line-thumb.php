<?php

if($_POST['file'])
{
	if($_POST['data']['to']&&$_POST['data']['ext'])
	{
		$f=UPLOAD_PATH.$_POST['file'];
		if(file_exists($f))
		{		
			_::photo()->thumb('m',$f,UPLOAD_FOLDER.'line/'.$_POST['data']['to'],500,375,'inboth',$_POST['data']['ext']);
			_::photo()->thumb('s',$f,UPLOAD_FOLDER.'line/'.$_POST['data']['to'],200,120,'both',$_POST['data']['ext']);
			$status=array('status'=>'OK');
		}
		else
		{
			$error='file not exists';
		}
	}
	else
	{
		$error='no data';
	}
}
else
{
	$error='file not found';
}

?>