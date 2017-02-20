<?php

if($_FILES['file'])
{
	if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$fd=UPLOAD_FOLDER.'page/'.$_POST['data']['folder'];
		if($n = $photo->thumb('n',$_FILES['file']['tmp_name'],$fd,600,1000,'width','jpg'))
		{		
			$f = UPLOAD_PATH.'page/'.$_POST['data']['folder'].'/'.$n;
			
			
			$w=UPLOAD_PATH.'page/watermark2.png';
	

			$photo->thumb('s',$f,$fd,150,100,'both','jpg');
			$photo->thumb('sq',$f,$fd,150,150,'both','jpg');
			$photo->thumb('t',$f,$fd,300,200,'both','jpg');
			$photo->thumb('th',$f,$fd,200,300,'both','jpg');
			$photo->thumb('m',$f,$fd,500,333,'both','jpg');
			$photo->thumb('mh',$f,$fd,333,500,'both','jpg');
			
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