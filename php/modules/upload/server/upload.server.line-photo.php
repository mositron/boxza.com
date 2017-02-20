<?php
$file_delete='';

if($_FILES['file']||$_POST['data']['string'])
{
	$f=false;
	$log=array();
	if(!empty($_POST['data']['type'])&&!empty($_POST['data']['folder'])&&(!empty($_FILES['file']['tmp_name'])||!empty($_POST['data']['string'])))
	{
		if(empty($_FILES['file']['tmp_name']))
		{
			$img = base64_decode($_POST['data']['string']);
			$im = @imagecreatefromstring($img);
			if ($im !== false)
			{
				$file_delete=$f='/tmp/'.(time().'-'.rand(1,99999).'.'.$_POST['data']['type']);
				if($_POST['data']['type']=='png')
				{
					@imagepng($im, $f, 0);
				}
				elseif($_POST['data']['type']=='jpg')
				{
					@imagejpeg($im, $f, 90);
				}
				elseif($_POST['data']['type']=='gif')
				{
					@imagegif($im, $f);
				}
			}
			imagedestroy($im);
		}
		else
		{
			$f=$_FILES['file']['tmp_name'];
		}
		if($n = _::photo()->thumb('o',$f,UPLOAD_FOLDER.'line/'.$_POST['data']['folder'],($_POST['data']['width']?$_POST['data']['width']:1200),($_POST['data']['height']?$_POST['data']['height']:1200),($_POST['data']['fix']?$_POST['data']['fix']:'inboth'),$_POST['data']['type']))
		{		
			$f = UPLOAD_PATH.'line/'.$_POST['data']['folder'].'/'.$n;
			_::photo()->thumb('m',$f,UPLOAD_FOLDER.'line/'.$_POST['data']['folder'],500,375,'inboth',$_POST['data']['type']);
			_::photo()->thumb('s',$f,UPLOAD_FOLDER.'line/'.$_POST['data']['folder'],200,120,'both',$_POST['data']['type']);
			
			$size=@getimagesize($f);
			$status=array('status'=>'OK','data'=>array('n'=>$n,'w'=>$size[0],'h'=>$size[1],'s'=>filesize($f),'e'=>$_POST['data']['type']),'log'=>$log);
			
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
	$error='file not found ('.print_r($_FILES,true).print_r($_POST,true).')';
}

if($file_delete && file_exists($file_delete))
{
	unlink($file_delete);
}
?>