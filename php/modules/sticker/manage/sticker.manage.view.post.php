<?php

$error=array();
$arg=array();
$arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,50,'utf-8'));
$arg['c']=intval(trim($_POST['cate']));
$arg['ref']=trim($_POST['ref']);
$arg['pl']=($_POST['published']?1:0);




if(!$arg['t'])
{
	$error['title']='กรุณากรอกชื่อสติกเกอร์';	
}
if((!$arg['c'])||!isset($cate[$arg['c']]))
{
	$error['cate']='กรุณาเลือกหมวด';	
}

if(!$arg['ref'])
{
	$error['ref']='กรุณาเลือกที่มา';	
}

if(_::$my['am']>=9)
{
	$arg['rc']=($_POST['rc']?1:0);	
}
if(!count($error))
{
	if(_::$path[0]=='new')
	{
		$arg['u']=_::$my['_id'];
		$arg['do']=0;
		if($id=$db->insert('sticker',$arg))
		{
			$app=$arg;
			$app['_id']=$id;
			$fd=_::folder()->fd($id);
			$app['fd']=substr($fd,2,2).'/'.substr($fd,4,2);
			$app['f']=rtrim(substr($fd,2,2).substr($fd,4,2),'0');
			$db->update('sticker',array('_id'=>$id),array('$set'=>array('fd'=>$app['fd'])));
		}
	}
	else
	{
		$id=$app['_id'];
		$db->update('sticker',array('_id'=>$id),array('$set'=>$arg));
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
				if($size[0]>=1 && $size[1]>=1)
				{
					$q=_::upload()->send('s3','sticker-post','@'.$f,array('folder'=>$app['fd']));
					if($q['status']=='OK')
					{
						$db->update('sticker',array('_id'=>$app['_id']),array('$set'=>array('img'=>$q['data']['n'])));	
					}
				}
		}
	}
	
	$tm=time();
	if(is_array($fs=$_FILES['photo_icon']['tmp_name']))
	{
		foreach($fs as $f)
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
						if($size[0]>=16 && $size[1]>=16)
						{
							if($icon=$db->insert('sticker_icon',array('p'=>$app['_id'])))
							{
								$arg=array();
								$fd=_::folder()->fd($icon);							
								$arg['fd']=substr($fd,0,2).'/'.substr($fd,2,2);
								$arg['f']=rtrim(substr($fd,0,2).substr($fd,2,2),'0');
								$arg['n']=substr($fd,4,2);
								$q=_::upload()->send('s3','sticker-pic','@'.$f,$arg);
								if($q['status']=='OK')
								{
									$db->update('sticker_icon',array('_id'=>$icon),array('$set'=>$q['data']));	
								}
								else
								{
									$db->remove('sticker_icon',array('_id'=>$icon));
								}
							}
						}
				}
			}
		}
	}
	for($i=0;$i<count($_POST['delo']);$i++)
	{
		if($_POST['delo'][$i])
		{
			if($icon=$db->findone('sticker_icon',array('_id'=>intval($_POST['delo'][$i]),'p'=>$app['_id'])))
			{
				$q=_::upload()->send('s3','sticker-del',$app['_id'],$icon);
				$db->update('sticker_icon',array('_id'=>$icon['_id']),array('$set'=>array('dd'=>new mongodate())));
			}
		}
	}
	_::move('/manage/'.$app['_id'].'?completed');
}
else
{
	$app=array_merge($app,$arg);	
}

?>