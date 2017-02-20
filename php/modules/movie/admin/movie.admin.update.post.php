<?php
_::session()->logged();
$db=_::db();

$error=array();

$_POST['title']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
$_POST['title2']=trim(mb_substr(strip_tags($_POST['title2']),0,100,'utf-8'));
$_POST['detail']=trim(mb_substr(strip_tags($_POST['detail']),0,3000,'utf-8'));
$_POST['director']=array_map('trim',explode(',',mb_substr(strip_tags($_POST['director']),0,200,'utf-8')));
$_POST['actor']=array_map('trim',explode(',',mb_substr(strip_tags($_POST['actor']),0,200,'utf-8')));
$_POST['category']=array_map('trim',(array)$_POST['category']);
$_POST['type']=trim(mb_substr(strip_tags($_POST['type']),0,30,'utf-8'));
$_POST['time']=trim(mb_substr(strip_tags($_POST['time']),0,30,'utf-8'));
$_POST['cinema']=array_map('trim',(array)$_POST['cinema']);

if(mb_strlen($_POST['title'],'utf-8')<1)
{
	$error['title']='กรุณากรอกชื่อหนัง';
}
if(mb_strlen($_POST['detail'],'utf-8')<1)
{
	$error['detail']='กรุณากรอกรายละเอียดหนัง';
}
if(!isset($type[$_POST['type']]))
{
	$error['type']='กรุณาเลือกชนิดของหนัง';	
}

if(!count($error))
{
	$link=_::format()->link(strtolower($_POST['title']));
	if(!$link)$link=$_POST['type'];
	$arg=array(
								't'=>$_POST['title'],
								't2'=>$_POST['title2'],
								'l'=>$link,
								'c'=>$_POST['category'],
								'cn'=>$_POST['cinema'],
								'ty'=>$_POST['type'],
								'at'=>$_POST['actor'],
								'dt'=>$_POST['director'],
								'd'=>$_POST['detail'],
								'cs'=>($_POST['time']?0:1),
								'rc'=>($_POST['recommend']?1:0),
								'tm'=>($_POST['time']?new MongoDate(strtotime($_POST['time'])):null),
								'pl'=>$_POST['publish']?1:0,
							);
	if(count($_POST['yt']))
	{
		$arg['v']=array();
		for($i=0;$i<count($_POST['yt']);$i++)
		{
			$yt=trim($_POST['yt'][$i]);
			if(mb_strlen($yt,'utf-8')==11)
			{
				$arg['v'][]=array('yt'=>$yt,'d'=>trim(mb_substr(strip_tags($_POST['d'][$i]),0,500,'utf-8')));
			}
		}
	}
	
	if(((!is_array($movie['v']))||(count($movie['v'])==0)))
	{
		if(!is_array($arg['v']) || count($arg['v'])==0)
		{
			$arg['pl']=0;
		}
	}
	
	
	if(!$movie['fd'])
	{
		$fd = _::folder()->fd($movie['_id']);
		$movie['fd'] = $arg['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	}
	if($arg['rc'] && !$movie['rc'])
	{
		$db->update('movie',array('rc'=>1),array('$set'=>array('rc'=>0)),array('multiple'=>true));
	}
	$db->update('movie',array('_id'=>$movie['_id']),array('$set'=>$arg));
	
	$photo=_::photo();
	
	for($i=2;$i<=5;$i++)
	{
		if($_POST['del_o'.$i])
		{
			if($movie['o'.$i] && $movie['fd'])
			{
				_::upload()->send('s3','delete','movie/'.$movie['fd'].'/'.$movie['o'.$i]);
				$db->update('movie',array('_id'=>$movie['_id']),array('$unset'=>array('o'.$i => 1)));
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
					if($size[0]>=100 && $size[1]>=100)
					{
						$q=_::upload()->send('s3','movie-post','@'.$f,array('id'=>$movie['_id'],'index'=>$i,'folder'=>$movie['fd']));
						if($q['status']=='OK')
						{
							$db->update('movie',array('_id'=>$movie['_id']),array('$set'=>array('o'.$i=>$q['data']['n'])));
						}
					}
			}
		}
	}
	
	
	for($i=1;$i<=10;$i++)
	{
		if($_POST['del_w'.$i])
		{
			if($movie['w'.$i] && $movie['fd'])
			{
				_::upload()->send('s3','delete','movie/'.$movie['fd'].'/s-'.$movie['w'.$i]);
				_::upload()->send('s3','delete','movie/'.$movie['fd'].'/'.$movie['w'.$i]);
				$db->update('movie',array('_id'=>$movie['_id']),array('$unset'=>array('w'.$i => 1)));
			}
		}
	}
	for($i=1;$i<=10;$i++)
	{		
		$o='';
		$s='';
		if($f=$_FILES['w'.$i]['tmp_name'])
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
					if($size[0]>=1024 && $size[1]>=768)
					{
						$q=_::upload()->send('s3','movie-wallpaper','@'.$f,array('id'=>$movie['_id'],'index'=>$i,'folder'=>$movie['fd']));
						if($q['status']=='OK')
						{
							$db->update('movie',array('_id'=>$movie['_id']),array('$set'=>array('w'.$i=>$q['data']['n'])));
						}
					}
			}
		}
	}
	
	_::cache()->delete('ca1','movie_home',0);
	header('Location: /admin/'.$movie['_id'].'?completed');
	exit;
}
print_r($error);
exit;
?>