<?php



//if ( isset ( $GLOBALS["HTTP_RAW_POST_DATA"] )) {
	
	if($_FILES)
	{
		
		$folder=_::folder();
		
		$r = 'bin/gif/'.date('Y-m-d').'/'.time().'/'.rand(1,999);
		$folder->mkdir(UPLOAD_FOLDER.$r);
		
		$delay = intval(min(max(intval($_POST['delay']),300),1200)/10);
		
		$i=0;
		foreach($_FILES as $k=>$v)
		{
			if($v['tmp_name'])
			{
				if(preg_match('/^([0-9]{3})\.jpg$/',$v['name'],$c))
				{
					copy($v['tmp_name'],UPLOAD_PATH.$r.'/'.$v['name']);
					$i++;
				}
			}
		}
		if($i>1)
		{
			exec('/usr/local/bin/convert -delay '.$delay.' -loop 0 '.UPLOAD_PATH.$r.'/*.jpg '.UPLOAD_PATH.$r.'/img.gif');
			exec('/usr/local/bin/convert '.UPLOAD_PATH.$r.'/img.gif -coalesce -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'bin/gif/watermark.gif -layers composite -layers optimize '.UPLOAD_PATH.$r.'/img.gif');
			echo 'http://s1.boxza.com/'.$r.'/img.gif';
		}
		elseif($i)
		{
			echo 'http://s1.boxza.com/'.$r.'/img0.jpg';
		}
		else
		{
			echo 'การอัพโหลดภาพไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง';
		}
	}
	exit;
	//header('Content-Type: application/zip');
	//header('Content-Length: '.strlen($zip));
	//header('Content-disposition:'.$method.'; filename="'.$name.'"');
	//echo $pdf;
	
//}  else echo 'An error occured.';


?>