<?php
			
if($_FILES['file'])
{
	if(isset($_POST['data']['index'])&&$_POST['data']['id']&&$_POST['data']['img']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$photo=_::photo();
		$id=$_POST['data']['id'];
		$index=$_POST['data']['index'];
		$folder=UPLOAD_FOLDER.'market/'.$_POST['data']['folder'];
		if($n = $photo->thumb($_POST['data']['img'],$_FILES['file']['tmp_name'],$folder,1024,1024,'width','jpg'))
		{
			$f = UPLOAD_PATH.'market/'.$_POST['data']['folder'].'/'.$n;
			$m=$photo->thumb($_POST['data']['img'].'-m',$f,$folder,600,400,'widthheight','jpg');
			$s=$photo->thumb($_POST['data']['img'].'-s',$f,$folder,240,160,'widthheight','jpg');
			
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