<?php

if($_FILES['file'])
{
	if($_POST['data']['name']&&$_FILES['file']['tmp_name'])
	{
		$f=$_FILES['file']['tmp_name'];
		$name=$_POST['data']['name'];
		//$fd=UPLOAD_FOLDER.'banner/';
		$fd=UPLOAD_FOLDER.'football/banner/';
		
		$n=_::photo()->thumb($name,$f,$fd,960,1000,'width','jpg');
		$f2=UPLOAD_PATH.'football/banner/'.$n;
		$size=@getimagesize($f2);
		
		$status=array('status'=>'OK','data'=>array('n'=>$n,'w'=>$size[0],'h'=>$size[1]));
		//$error='no - '.$f2;
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