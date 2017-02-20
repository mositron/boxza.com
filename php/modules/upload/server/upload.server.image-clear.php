<?php

if($_POST['file'])
{
	_::folder()->clean(UPLOAD_FOLDER.'image/'.$_POST['file']);			 
	$status=array('status'=>'OK');
}
?>