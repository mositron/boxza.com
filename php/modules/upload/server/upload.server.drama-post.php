<?php

if($_FILES['file'])
{
	if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$photo=_::photo();
		$folder=UPLOAD_FOLDER.'drama/'.$_POST['data']['folder'];
		if($n = $photo->thumb('m',$_FILES['file']['tmp_name'],$folder,470,400,'both','jpg'))
		{		
			$f = UPLOAD_PATH.'drama/'.$_POST['data']['folder'].'/'.$n;
					
			$photo->thumb('s',$f,$folder,100,73,'both','jpg');
			$photo->thumb('t',$f,$folder,250,182,'both','jpg');

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