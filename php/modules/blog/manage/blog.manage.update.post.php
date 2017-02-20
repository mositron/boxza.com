<?php

$db=_::db();

$error=array();
$arg=array();
$arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
//$arg['s']=trim(mb_substr(strip_tags($_POST['summary']),0,500,'utf-8'));
$arg['d']=stripslashes(trim($_POST['detail']));
$_cs=explode('-',trim($_POST['cate']));
$arg['c']=intval($_cs[0]);
$arg['cs']=intval($_cs[1]);
$arg['cs2']=intval($_cs[2]);


if(_::$my['am'])
{
	$arg['pl']=($_POST['publish']?1:0);
	$arg['rc']=($_POST['recommend']?1:0);
	$arg['ho']=($_POST['hot']?1:0);
	$arg['wt']=0;
}
elseif(isset($_POST['waiting']))
{
	$arg['wt']=($_POST['waiting']?1:0);
}

if($arg['pl']&&!$news['ds'])
{
	$arg['ds']=new MongoDate();
}
$arg['rf']=array();
for($i=0;$i<3;$i++)
{
	if((isset($_POST['ref'][$i])&&trim($_POST['ref'][$i]))&&(isset($_POST['url'][$i])&&trim($_POST['url'][$i])))
	{
		$arg['rf'][]=array('ref'=>trim($_POST['ref'][$i]),'url'=>trim($_POST['url'][$i]));
	}
}

if(!$arg['t'])
{
	$error['title']='กรุณากรอกชื่อข่าว';
}
/*
if(!$arg['s'])
{
	$error['summary']='กรุณากรอกเนื้อเรื่องย่อ';
}
*/
if(!$arg['d'])
{
	$error['detail']='กรุณากรอกรายละเอียดข่าว';
}
elseif(mb_stripos($arg['d'],'kapook.com',0,'utf-8')>-1)
{
	$error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก kapook.com';
	$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('pl'=>0)));
}
elseif(mb_stripos($arg['d'],'sanook.com',0,'utf-8')>-1)
{
	$error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก sanook.com';
	$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('pl'=>0)));
}
if(!isset($cate[$arg['c']]))
{
	$error['category']='กรุณาเลือกชนิดของข่าว';	
}

if(!count($error))
{
	if(!$news['fd'])
	{
		$fd = _::folder()->fd($news['_id']);
		$news['fd'] = $arg['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	}
	$db->update('news',array('_id'=>$news['_id']),array('$set'=>$arg));
	
	$photo=_::photo();
	
	if($f=$_FILES['o']['tmp_name'])
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
				if($size[0]>=100 && $size[1]>=100)
				{
					_::upload()->send('s3','news-post','@'.$f,array('folder'=>$news['fd']));
				}
		}
	}

	
	_::cache()->delete('ca1','news_home',0);
	_::cache()->delete('ca1','home',0);
	_::move('/admin/'.$news['_id'].'?completed');
}
?>