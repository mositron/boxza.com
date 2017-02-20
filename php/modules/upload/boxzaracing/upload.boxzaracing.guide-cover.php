<?php

if($_FILES['file'])
{
	if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$fd=UPLOAD_FOLDER.'guide/'.$_POST['data']['folder'];
		if($n = $photo->thumb('cv-n',$_FILES['file']['tmp_name'],$fd,960,400,'both','jpg'))
		{		
			$f = UPLOAD_PATH.'guide/'.$_POST['data']['folder'].'/'.$n;
			
			
			$w=UPLOAD_PATH.'guide/watermark2.png';
	

			$photo->thumb('cv-s',$f,$fd,384,160,'both','jpg');
			
			//exec('/usr/local/bin/convert '.$f.' -gravity northeast -geometry +0+0 null: '.$w.' -layers composite -quality 90 '.$f);	
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