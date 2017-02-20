<?php
			
if($_FILES['file'])
{
	if(isset($_POST['data']['index'])&&$_POST['data']['id']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$photo=_::photo();
		$id=$_POST['data']['id'];
		$index=$_POST['data']['index'];
		$folder=UPLOAD_FOLDER.'deal/'.$_POST['data']['folder'];
		if($n = $photo->thumb($id.'-'.$index,$_FILES['file']['tmp_name'],$folder,600,800,'inboth','jpg'))
		{
			$f = UPLOAD_PATH.'deal/'.$_POST['data']['folder'].'/'.$n;
			$s='';
			if($index==1)
			{
				$s=$photo->thumb('s',$f,$folder,75,50,'both','jpg');
				$photo->thumb('m',$f,$folder,160,120,'both','jpg');
			}
			
			$size=@getimagesize($f);
			$status=array('status'=>'OK','data'=>array('n'=>$n,'s'=>$s,'w'=>$size[0],'h'=>$size[1]));
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