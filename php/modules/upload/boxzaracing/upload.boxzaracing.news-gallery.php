<?php
			
if($_FILES['file'])
{
	if($_POST['data']['n']&&$_POST['data']['fd']&&$_FILES['file']['tmp_name'])
	{
		$id=$_POST['data']['n'];
		$f=$_FILES['file']['tmp_name'];
		$folder = $_POST['data']['fd'];
		_::folder()->mkdir(UPLOAD_FOLDER.'gallery/'.$folder);
		$size=@getimagesize($f);
		$type='jpg';
		$cmd='/usr/local/bin/convert '.$f;

		$file=_::photo()->thumb($id.'-o',$f,UPLOAD_FOLDER.'gallery/'.$folder,1200,1200,'inboth','jpg');
		$thumb=_::photo()->thumb($id.'-s',$f,UPLOAD_FOLDER.'gallery/'.$folder,240,160,'both','jpg');

		$size=@getimagesize(UPLOAD_PATH.'gallery/'.$folder.'/'.$file);
		$status=array('status'=>'OK','data'=>array('ty'=>$type,'n'=>$id,'f'=>$file,'s'=>$thumb,'w'=>$size[0],'h'=>$size[1],'fd'=>$folder));
		
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