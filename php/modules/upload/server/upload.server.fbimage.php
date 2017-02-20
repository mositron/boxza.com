<?php
			
if($_POST['file'])
{
	if($_POST['data']['name']&&$_POST['data']['folder'])
	{
		_::folder()->mkdir(UPLOAD_FOLDER.'fbimage/'.$_POST['data']['folder']);
		
		$tmp=UPLOAD_PATH.'fbimage/'.$_POST['data']['folder'].'/'.$_POST['data']['name'].'.tmp';
		@copy($_POST['file'],$tmp);
		
		if(file_exists($tmp))
		{
		
			$photo=_::photo();
			$folder=UPLOAD_FOLDER.'fbimage/'.$_POST['data']['folder'];
			if($n = $photo->thumb($_POST['data']['name'].'_s',$tmp,$folder,240,240,'inboth','jpg'))
			{			
				$photo->thumb($_POST['data']['name'].'_n',$tmp,$folder,720,720,'width','jpg');
				$status=array('status'=>'OK','data'=>array());
			}
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