<?php

if($_FILES['file'])
{
	if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$photo=_::photo();
		$folder=UPLOAD_FOLDER.'sticker/cover/'.$_POST['data']['folder'];
		if($n = $photo->thumb('m',$_FILES['file']['tmp_name'],$folder,500,500,'inboth','png'))
		{		
			$f = UPLOAD_PATH.'sticker/cover/'.$_POST['data']['folder'].'/'.$n;
					
			$photo->thumb('s',$f,$folder,200,200,'inboth','png');
			$photo->thumb('t',$f,$folder,50,50,'inboth','png');

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