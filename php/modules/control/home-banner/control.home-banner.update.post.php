<?php

$db=_::db();

$error=array();
$arg=array();
$arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
$arg['d']=stripslashes(trim($_POST['detail']));
$arg['l']=trim($_POST['link']);
$arg['so']=intval(trim($_POST['sort']));

$arg['pl']=($_POST['publish']?1:0);


if(!$arg['t'])
{
	$error['title']='กรุณากรอกชื่อข่าว';
}


if(!count($error))
{
	if(!$banner['fd'])
	{
		$fd = _::folder()->fd($banner['_id']);
		$banner['fd'] = $arg['fd'] = substr($fd,2,2).'/'.substr($fd,4,2);
	}
	$db->update('banner',array('_id'=>$banner['_id']),array('$set'=>$arg));
	
	if($f=$_FILES['o']['tmp_name'])
	{
		$size=false;
		if($banner['p']=='img')
		{
			$size=array(455,305);	
		}
		if($banner['p']=='bottom')
		{
			$size=array(150,125);	
		}
		$q=_::upload()->send('s3','banner-upload','@'.$f,array('name'=>$banner['_id'],'folder'=>$banner['fd'],'size'=>$size));
		if($q['status']=='OK')
		{
			if($q['data']['n'])
			{
				$db->update('banner',array('_id'=>$banner['_id']),array('$set'=>array('s'=>$q['data']['n'],'ex'=>$q['data']['ex'],'w'=>$q['data']['w'],'h'=>$q['data']['h'])));
			}
		}
	}

	_::cache()->delete('ca1','home',0);
	_::move('/home-banner/'.$banner['_id'].'?completed');
}
?>