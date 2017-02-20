<?php

if($_FILES['file'])
{
	if($_POST['data']['name']&&$_FILES['file']['tmp_name'])
	{
		$photo=_::photo();
		$folder=UPLOAD_FOLDER.'gift/';
		if($n = $photo->thumb($_POST['data']['name'],$_FILES['file']['tmp_name'],$folder.'128',128,128,'both','png'))
		{
			$photo->thumb($_POST['data']['name'],$_FILES['file']['tmp_name'],$folder.'64',64,64,'both','png');
			$status=array('status'=>'OK','data'=>array('n'=>$n));
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