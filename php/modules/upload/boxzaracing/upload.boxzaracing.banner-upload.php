<?php

if($_FILES['file'])
{
	if($_POST['data']['name']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$f=$_FILES['file']['tmp_name'];
		$name=$_POST['data']['name'];
		$fd=UPLOAD_FOLDER.'banner/'.$_POST['data']['folder'];
		
		$n=$photo->thumb($name,$f,$fd,$_POST['data']['size'][0],$_POST['data']['size'][1],'both','jpg');
		$f2=UPLOAD_PATH.'banner/'.$_POST['data']['folder'].'/'.$n;
		$size=@getimagesize($f2);
		
		$status=array('status'=>'OK','data'=>array('n'=>$n,'w'=>$size[0],'h'=>$size[1]));
		$error='no - '.$f2;
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