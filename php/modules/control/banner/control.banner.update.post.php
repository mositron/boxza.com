<?php

$db=_::db();

$error=array();
$arg=array();
$arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
$arg['d']=stripslashes(trim($_POST['detail']));
$arg['l']=trim($_POST['link']);
$arg['so']=intval(trim($_POST['sort']));

$arg['tyc']=($_POST['type']?1:0);
$arg['code']=trim($_POST['code']);
$arg['dt1']=new MongoDate(strtotime(trim($_POST['date1']).' 00:00:00'));
$arg['dt2']=new MongoDate(strtotime(trim($_POST['date2']).' 23:59:59'));

$arg['p']=$_POST['position'];

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
		$q=_::upload()->send('s3','banner-upload','@'.$f,array('name'=>$banner['_id'],'folder'=>$banner['fd']));
		if($q['status']=='OK')
		{
			if($q['data']['n'])
			{
				$db->update('banner',array('_id'=>$banner['_id']),array('$set'=>array('s'=>$q['data']['n'],'ex'=>$q['data']['ex'],'w'=>$q['data']['w'],'h'=>$q['data']['h'])));
			}
		}
	}

	_::cache()->delete('ca1','home',0);
	_::move('/banner/'.$banner['_id'].'?completed');
}
?>