<?php

if($_FILES['file'])
{
	if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$photo=_::photo();
		$folder=UPLOAD_FOLDER.'guess/'.$_POST['data']['folder'];
		if($n = $photo->thumb('m',$_FILES['file']['tmp_name'],$folder,200,200,'bothtop','jpg'))
		{		
			$f = UPLOAD_PATH.'guess/'.$_POST['data']['folder'].'/'.$n;
			$photo->thumb('s',$f,$folder,100,100,'bothtop','jpg');
			$size=@getimagesize($f);
			$status=array('status'=>'OK','data'=>array('n'=>$n,'w'=>$size[0],'h'=>$size[1]));
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