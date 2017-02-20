<?php
$db=_::db();

$error=array();

$_POST['message']=trim(mb_substr(strip_tags($_POST['message']),0,100,'utf-8'));
$_POST['email']=trim(mb_substr(strip_tags($_POST['email']),0,100,'utf-8'));
$_POST['twitter']=trim(mb_substr(strip_tags($_POST['twitter']),0,50,'utf-8'));
$_POST['facebook']=trim(mb_substr(strip_tags($_POST['facebook']),0,50,'utf-8'));
$_POST['inettown']=trim(mb_substr(strip_tags($_POST['inettown']),0,50,'utf-8'));
$_POST['line']=trim(mb_substr(strip_tags($_POST['line']),0,30,'utf-8'));


if(!isset($type[$_POST['gender']]))
{
	$error['gender']='กรุณาเลือกเพศให้ถูกต้อง';	
}
if(!isset($province[$_POST['province']]))
{
	$error['province']='กรุณาเลือกจังหวัด';	
}
if(!$_POST['message'])
{
	$error['message']='กรุณากรอกข้อความทักทาย';
}
elseif(strpos($_POST['message'],'[url')>-1)
{
	$error['message']='กรุณากรอกข้อความให้ถูกต้อง';
}

if($_POST['inettown']&&!_::$my)
{
	$error['inettown']='ข้อมูลไม่ถูกต้อง';	
}

$age = intval($_POST['age']);
if($age<18 || $age>60)$age=0;
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
	$error['email']='กรุณากรอกอีเมล์ให้ถูกต้อง';	
}


if(!count($error))
{
	if($ex=$db->find('msn',array('em'=>$_POST['email']),array('da'=>1,'dd'=>1,'_id'=>1,'pr'=>1),array('sort'=>array('da'=>-1))))
	{
		for($i=0;$i<count($ex);$i++)
		{
			if(($ex[$i]['da']->sec+3600 > time()) && (!$ex[$i]['au']) && (!$ex[$i]['dd']))
			{
				$error['email']='คุณสามารถโพสได้ชมละครั้งเท่านั้น';
			}
			else
			{
				$db->update('msn',array('_id'=>$ex[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())));
				//if($ex[$i]['pr'])$db->update('msn_province',array('_id'=>$ex[$i]['pr']),array('$inc'=>array('c'=>-1)));
			}
		}
	}
}

if(!count($error))
{
	$ms=$_POST['message'];
	$ms=str_replace(array('เงี่ยน','ควย','เย็ด','หำ'),'***',$ms);
	if($id=$db->insert('msn',array(
																						'u'=>intval(_::$my['_id']),
																						'pr'=>intval($_POST['province']),
																						'ty2'=>strval($_POST['gender']),
																						'ty'=>'lesbian',
																						'ms'=>$ms,
																						'ag'=>$age,
																						'em'=>$_POST['email'],
																						'fb'=>$_POST['facebook'],
																						'in'=>$_POST['inettown'],
																						'tw'=>$_POST['twitter'],
																						'ln'=>$_POST['line'],
																						'cm'=>$_POST['cam']?1:0,
																						'au'=>0,
																						'ds'=>new MongoDate(),
																						'ip'=>$_SERVER['REMOTE_ADDR'],
																						)))
	{
		$db->update('msn_province',array('_id'=>intval($_POST['province'])),array('$inc'=>array('c_gay'=>1)));
		
		
		if($_POST['facebook_id']&&$_POST['facebook_name'])
		{
			$db->insert('appfriend',array(
																						'pr'=>intval($_POST['province']),
																						'ty'=>'lesbian',
																						'ms'=>$ms,
																						'ag'=>$age,
																						'fb_id'=>$_POST['facebook_id'],
																						'fb_name'=>$_POST['facebook_name'],
																						'line'=>$_POST['line'],
																						'ds'=>new MongoDate(),
																						'ip'=>$_SERVER['REMOTE_ADDR'],
																						));
			
		}

		if($f=$_FILES['photo']['tmp_name'])
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
					
					$_fd = _::folder()->fd($id);
					$fd = substr($_fd,0,2).'/'.substr($_fd,2,2);
					$n=substr($_fd,4,2);
					
					$q=_::upload()->send('s3','upload','@'.$f,array('name'=>$n,'folder'=>'msn/'.$fd,'width'=>500,'height'=>500,'fix'=>'inboth','type'=>'jpg'));
					//if($pt=$photo->thumb($n,$f,'msn/'.$fd,500,500,'inboth','jpg'))
					if($q['status']=='OK')
					{
						$db->update('msn',array('_id'=>$id),array('$set'=>array('fd'=>$fd,'pt'=>$q['data']['n'])));
					}
			}
		}
		_::cache()->delete('ca1','friend_home_'.$_POST['gender'],0);
		_::cache()->delete('ca1','friend_home',0);
		header('Location: /friend/?completed');
		exit;
	}
}

?>