<?php

if($_POST['file'])
{
	$tmp=UPLOAD_PATH.'news/'.$_POST['file'].'/';
	$icon=array();
	if(is_dir($tmp))
	{
		if($dh=opendir($tmp))
		{
			while(($dir=readdir($dh))!==false)
			{
				if(preg_match("/([a-zA-Z0-9_\-]+)(\.jpg)$/iU",$dir,$path)&&!in_array($dir,array('s.jpg','sq.jpg','t.jpg','th.jpg','m.jpg','mh.jpg','ev-s.jpg','ev-sq.jpg','ev-t.jpg','ev-th.jpg','ev-m.jpg','ev-mh.jpg','cv-s.jpg','cv-n.jpg')))
				{
					array_push($icon,$path[1].'.jpg');
				}
			}
			closedir($dh);
		}
	}
	rsort($icon);
	$status=array('status'=>'OK','data'=>$icon);
}
else
{
	$error='file not found';
}

?>