<?php

if($_POST['file'])
{
	if($_POST['data']['line']&&is_numeric($_POST['data']['line']))
	{
		$f=UPLOAD_PATH.$_POST['file'];
		if(file_exists($f))
		{
			if(substr($_POST['file'],-4)=='.gif')
			{
				$fd = _::folder()->fd($_POST['data']['line']);
				$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
				if($n = _::photo()->thumb('o',$f,UPLOAD_FOLDER.'line/'.$folder,1200,1200,'inboth','gif'))
				{
					$f = UPLOAD_PATH.'line/'.$folder.'/'.$n;
					_::photo()->thumb('m',$f,UPLOAD_FOLDER.'line/'.$folder,500,375,'inboth','jpg');
					_::photo()->thumb('s',$f,UPLOAD_FOLDER.'line/'.$folder,200,120,'both','jpg');
					$size=@getimagesize($f);
					$status=array('status'=>'OK','data'=>array('file'=>'http://s1.boxza.com/line/'.$folder.'/m.jpg','fd'=>$fd,'folder'=>$folder,'n'=>$n,'w'=>$size[0],'h'=>$size[1],'s'=>filesize($f)));
				}
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