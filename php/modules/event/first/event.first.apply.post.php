<?php


$error=[];

if(EVENT_ENABLED!=1)
{
	$error[]='กิจกรรมนี้ปิดการแข่งขันแล้ว';
}
elseif($f=$_FILES['photo']['tmp_name'])
{
	$db=_::db();	
	$_POST['detail']=trim(mb_substr(strip_tags($_POST['detail']),0,500,'utf-8'));
	if(!$_POST['detail'])
	{
		$error['detail']='กรุณากรอกข้อความของกลิตเตอร์อย่างน้อย 10 ตัวอักษร';
	}
	else
	{
		$picture=false;
		$size=@getimagesize($f);
		switch (strtolower($size['mime']))
		{
			case 'image/gif':
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/bmp':
			case 'image/wbmp':
			case 'image/png':
			case 'image/x-png':
				if($size[0]>=200 && $size[1]>=200)
				{
					$picture=true;
				}
				break;
		}
		if(!$picture)
		{
			$error[]='รูปภาพมีขนาดเล็กเกินไป รูปภาพควรจะมีขนาดอย่างต่ำ 200x200';
		}
	}
}
else
{
		$error[]='กรุณาเลือกรูปภาพที่่ต้องการอัพโหลด';
}

if(!count($error))
{
	if($id=$db->insert('event',array(
																						'u'=>_::$my['_id'],
																						't'=>$_POST['detail'],
																						'ip'=>$_SERVER['REMOTE_ADDR'],
																						'v'=>0,
																						'ev'=>EVENT_KEY,
																						)))
	{
		$fd = _::folder()->fd($id);
		$folder = substr($fd,0,2).'/'.substr($fd,2,2);
		$name=substr($fd,4,2);
		_::folder()->mkdir('event/'.EVENT_KEY.'/'.$folder);
		$size=@getimagesize($f);
		$type='jpg';
		#$cmd='/usr/local/bin/convert '.$f;
		$cmd='convert '.$f;
		switch (strtolower($size['mime']))
		{
			case 'image/gif':
				$type='gif';
				$cmd.=' -coalesce';
				break;
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/bmp':
			case 'image/wbmp':
			case 'image/png':
			case 'image/x-png':
				break;
		}
		exec($cmd.' -resize 200x200\> '.FILES.'event/'.EVENT_KEY.'/'.$folder.'/'.$name.'.t.'.$type,$outt);
		exec($cmd.'  -resize 600x1000\> '.FILES.'event/'.EVENT_KEY.'/'.$folder.'/'.$name.'.l.'.$type,$outl);
		$db->update('event',array('_id'=>$id),array('$set'=>array('fd'=>$folder,'ty'=>$type,'n'=>$name)));
		
		_::move('/first/'.$id);
		exit;
	}
	else
	{
		$error[]='ไม่สามารถเพิ่มข้อมูลได้ ';	
	}
}


$template->assign('error',$error);

?>