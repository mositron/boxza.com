<?php
_::session()->logged();
$db=_::db();

$error=array();

$_POST['title']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
$_POST['detail']=trim(mb_substr(strip_tags($_POST['detail']),0,3000,'utf-8'));
$_POST['contact']=trim(mb_substr(strip_tags($_POST['contact']),0,100,'utf-8'));
$_POST['brand']=trim(mb_substr(strip_tags($_POST['brand']),0,100,'utf-8'));
$_POST['ver']=trim(mb_substr(strip_tags($_POST['ver']),0,30,'utf-8'));
$_POST['price']=trim(mb_substr(strip_tags(str_replace(',','',$_POST['price'])),0,20,'utf-8'));
$_POST['phone']=trim(mb_substr(strip_tags($_POST['phone']),0,30,'utf-8'));
$_POST['email']=trim(mb_substr(strip_tags($_POST['email']),0,50,'utf-8'));
$_POST['website']=trim(mb_substr(strip_tags($_POST['website']),0,50,'utf-8'));

if($_POST['website']=trim(strip_tags($_POST['website'])))
{
	if(strpos($_POST['website'],'://')<0)$_POST['website']='http://'.$_POST['website'];
}
if(mb_strlen($_POST['title'],'utf-8')<10)
{
	$error['title']='กรุณากรอกหัวข้อประกาศสอย่างน้อย 10ตัวอักษร';
}
elseif($db->findone('deal',array('u'=>_::$my['_id'],'t'=>$_POST['title'])))
{
	$error['title']='คุณมีหัวข้อประกาศนี้อยู่แล้ว';
}
if(!$cate=$db->findone('deal_cate',array('_id'=>intval($_POST['category']))))
{
	$error['category']='กรุณาเลือกหมวดให้ถูกต้อง';	
}
if(!$cate=$db->findone('deal_cate',array('_id'=>intval($_POST['catesub']),'p'=>intval($_POST['category']))))
{
	$error['catesub']='กรุณาเลือกหมวดย่อยให้ถูกต้อง';	
}
if(!isset($type[$_POST['type']]))
{
	$error['type']='กรุณาเลือกรายการความต้องการ';	
}
if(!isset($province[$_POST['province']]))
{
	$error['province']='กรุณาเลือกจังหวัด';	
}
if(!isset($status[$_POST['status']]))
{
	$error['status']='กรุณาเลือกรายการสภาพสินค้า';	
}
if(mb_strlen(trim($_POST['detail']),'utf-8')<20)
{
	$error['detail']='กรุณากรอกรายละเอียดประกาศอย่างน้อย 20ตัวอักษร';	
}
if(mb_strlen(trim($_POST['contact']),'utf-8')<3)
{
	$error['contact']='กรุณากรอกชื่อผู้ติดต่ออย่างน้อย 3ตัวอักษร';	
}

$picture=false;
if(is_array($_FILES['o']['tmp_name']))
{
	foreach($_FILES['o']['tmp_name'] as $f)
	{
		if($f)
		{
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
		}
	}
}
if(!$picture)
{
	$error['o']='กรุณาอัพโหลดรูปภาพอย่างน้อย 1 รูป และขนาดรูปใหญ่กว่า 200x200 pixel';	
}

if(!count($error))
{
	if($id=$db->insert('deal',array(
																						'u'=>_::$my['_id'],
																						't'=>$_POST['title'],
																						'c'=>intval($_POST['category']),
																						'cs'=>intval($_POST['catesub']),
																						'pr'=>intval($_POST['province']),
																						'ty'=>$_POST['type'],
																						'b'=>$_POST['brand'],
																						'v'=>$_POST['ver'],
																						'st'=>$_POST['status'],
																						'd'=>$_POST['detail'],
																						'p'=>intval($_POST['price']),
																						'p1'=>$_POST['pay1']?1:0,
																						'p2'=>$_POST['pay2']?1:0,
																						'p3'=>$_POST['pay3']?1:0,
																						'p4'=>$_POST['pay4']?1:0,
																						's1'=>$_POST['send1']?1:0,
																						's2'=>$_POST['send2']?1:0,
																						's3'=>$_POST['send3']?1:0,
																						's4'=>$_POST['send4']?1:0,
																						'ct'=>$_POST['contact'],
																						'ws'=>$_POST['website'],
																						'ph'=>$_POST['phone'],
																						'em'=>$_POST['email'],
																						'ds'=>new MongoDate(),
																						'ip'=>$_SERVER['REMOTE_ADDR'],
																						'pl'=>$_POST['publish']?1:0,
																						'cm'=>$_POST['comment']?1:0,
																						'ft'=>(array)$_POST['fbtab'],
																						)))
	{
		$db->update('deal_province',array('_id'=>intval($_POST['province'])),array('$inc'=>array('c'=>1)));
		$photo=_::photo();

		$fd = _::folder()->fd($id);
		$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
		$o=array();
		$s='';
		for($i=0;$i<5;$i++)
		{
			if($f=$_FILES['o']['tmp_name'][$i])
			{					
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
							$o[$i]=$photo->thumb($id.'-'.($i+1),$f,'deal/'.$folder,600,800,'inboth','jpg');
							if(!$s)
							{
								$s=$photo->thumb('s',$f,'deal/'.$folder,75,50,'both','jpg');
								$photo->thumb('m',$f,'deal/'.$folder,160,120,'both','jpg');
							}
						}
				}
			}
			else
			{
				$o[$i]='';
			}
		}
		
		$link=_::format()->link(strtolower($_POST['title']));
		if(!$link)$link=$_POST['type'];
		$db->update('deal',array('_id'=>$id),array('$set'=>array('l'=>$link,'fd'=>$folder,'o1'=>$o[0],'o2'=>$o[1],'o3'=>$o[2],'o4'=>$o[3],'o5'=>$o[4])));
		_::cache()->delete('ca1','deal_home',0);
		header('Location: /'.$id.'-'.$link.'.html');
		exit;
	}
	else
	{
		$error['title']='ไม่สามารถเพิ่มข้อมูลได้ ';	
	}
}

?>