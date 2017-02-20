<?php
_::session()->logged();
$db=_::db();

$error=array();


if($f=$_FILES['o']['tmp_name'])
{
	
	$_POST['detail']=trim(mb_substr(strip_tags($_POST['detail']),0,1000,'utf-8'));
	$md5 = md5_file($f);
	if(mb_strlen($_POST['detail'],'utf-8')<10)
	{
		$error['detail']='กรุณากรอกข้อความของกลิตเตอร์อย่างน้อย 10 ตัวอักษร';
	}
	elseif(count($_POST['cate'])<1)
	{
		$error['cate']='กรุณาเลือกประเภทของกลิตเตอร์';
	}
	/*elseif($db->findone('poem',array('md5'=>$md5)))
	{
		$error['o']='มีรูปนี้อยู่ในระบบแล้ว';
	}*/
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
				if($size[0]>=150 && $size[1]>=150)
				{
					$picture=true;
				}
				break;
		}
		if(!$picture)
		{
			$error['o']='รูปภาพมีขนาดเล็กเกินไป รูปภาพควรจะมีขนาดอย่างต่ำ 150x150';
		}
		else
		{
			
		}
	}
}
else
{
		$error['o']='กรุณาเลือกรูปกลิตเตอร์ที่ต้องการอัพโหลด';
}

if(!count($error))
{
	if($id=$db->insert('poem',array(
																						'u'=>_::$my['_id'],
																						't'=>$_POST['detail'],
																						'c'=>array_map('intval',$_POST['cate']),
																						'ip'=>$_SERVER['REMOTE_ADDR'],
																						'md5'=>$md5
																						)))
	{
		$fd = _::folder()->fd($id);
		$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
		
		$size=@getimagesize($f);
		$type='jpg';
		switch (strtolower($size['mime']))
		{
			case 'image/gif':
				$type='gif';
				break;
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/bmp':
			case 'image/wbmp':
			case 'image/png':
			case 'image/x-png':
				break;
		}
		
		$q=_::upload()->send('s3','poem-post','@'.$f,array('id'=>$id,'folder'=>$folder,'name'=>_::$my['name'],'time'=>time::show(new MongoDate(),'datetime')));
		if($q['status']=='OK')
		{
			$db->update('poem',array('_id'=>$id),array('$set'=>array('fd'=>$folder,'ty'=>$type,'zp'=>'poem.boxza.com-'.$id.'.zip')));
			_::cache()->delete('ca1','poem_home',0);
			header('Location: /'.$id);
			exit;
		}
		else
		{
			$db->remove('poem',array('_id'=>$id));
		}
	}
	else
	{
		$error['title']='ไม่สามารถเพิ่มข้อมูลได้ ';	
	}
}

?>