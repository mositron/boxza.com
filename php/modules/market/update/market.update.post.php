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

if(!count($error))
{
	$link=_::format()->link(strtolower($_POST['title']));
	if(!$link)$link=$_POST['type'];
	
	$set=array(
								't'=>$_POST['title'],
								'l'=>$link,
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
								'pl'=>$_POST['publish']?1:0,
								'cm'=>$_POST['comment']?1:0,
	);
	if(_::$my['am'])
	{
		if($set['rc']=intval($_POST['recommend']))
		{
			$db->update('deal',array('rc'=>$set['rc']),array('$set'=>array('rc'=>0)),array('multiple'=>true));
		}
	}
	$db->update('deal',array('_id'=>$deal['_id']),array('$set'=>$set));
	
	if(intval($_POST['province']) != $deal['pr'])
	{
		if($deal['pr'])
		{
			if($d = $db->findone('deal_province',array('_id'=>intval($deal['pr']))))
			{
				if($d['c'])
				{
					$c = max(0,intval($d['c'])-1);
					$db->update('deal_province',array('_id'=>intval($deal['pr'])),array('$set'=>array('c'=>$c)));
				}
			}
		}
		$db->update('deal_province',array('_id'=>intval($_POST['province'])),array('$inc'=>array('c'=>1)));
	}
	
	$photo=_::photo();
	
	for($i=2;$i<=5;$i++)
	{
		if($_POST['del_o'.$i])
		{
			if($deal['o'.$i] && $deal['fd'])
			{
				_::upload()->send('s3','delete','deal/'.$deal['fd'].'/'.$deal['o'.$i]);
				$db->update('deal',array('_id'=>$deal['_id']),array('$unset'=>array('o'.$i => 1)));
			}
		}
	}
	for($i=1;$i<=5;$i++)
	{		
		$o='';
		$s='';
		if($f=$_FILES['o'.$i]['tmp_name'])
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
						$q=_::upload()->send('s3','deal-post','@'.$f,array('index'=>$i,'folder'=>$deal['fd'],'id'=>$deal['_id']));
					
						if($q['status']=='OK')
						{
							$set=array('o'.$i=>$q['data']['n']);
							if($i==1&&$q['data']['s'])
							{
								$set['s']=$q['data']['s'];
							}
							$db->update('deal',array('_id'=>$deal['_id']),array('$set'=>$set));
						}
					}
			}
		}
	}
	_::cache()->delete('ca1','deal_home',0);
	header('Location: /update/'.$deal['_id'].'?completed');
	exit;
}
print_r($error);
exit;
?>