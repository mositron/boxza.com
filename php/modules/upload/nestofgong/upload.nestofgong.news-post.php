<?php

if($_FILES['file'])
{
	if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$fd=UPLOAD_FOLDER.'news/'.$_POST['data']['folder'];
		if($n = $photo->thumb('m',$_FILES['file']['tmp_name'],$fd,600,1000,'width','jpg'))
		{		
			$f = UPLOAD_PATH.'news/'.$_POST['data']['folder'].'/'.$n;
			$photo->thumb('s',$f,$fd,100,75,'bothtop','jpg');
			$photo->thumb('t',$f,$fd,400,300,'bothtop','jpg');
			$size=@getimagesize($f);
			$status=array('status'=>'OK','data'=>array('n'=>$n,'w'=>$size[0],'h'=>$size[1]));
		}
		else
		{
			$error='file not exists';
		}
		//$error=UPLOAD_FOLDER.' - '.UPLOAD_PATH;
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