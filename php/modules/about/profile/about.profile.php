<?php

define('HIDE_SIDEBAR',1);

$db=_::db();

if(is_numeric(_::$path[0]))
{
	$arg=array('_id'=>intval(_::$path[0]));	
}
else
{
	$arg=array('lk'=>_::$path[0]);
}
$arg['pl']=1;
$arg['dd']=array('$exists'=>false);
if(!$about=$db->findone('about',$arg))
{
	_::move('/');
}

_::$meta['title']=$about['t'].' - '._::$meta['title'];
_::$meta['description']=$about['t'].' - '._::$meta['description'];
//_::$meta['image']='http://s3.boxza.com/about/'.$about['fd'].'/t.jpg';

//_::time();

$template->assign('about',$about);


$ref=array();

$_=array('pl'=>1,'dd'=>array('$exists'=>false));

$or=array();
if(count($about['people']))
{
	$ref['people']=array();
	foreach($about['people'] as $v)
	{
		$or[]=array('people'=>$v);
		$ref['people'][]=$db->findone('people',array('pl'=>1,'dd'=>array('$exists'=>false),'_id'=>$v),array('n'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'lk'=>1,'fd'=>1));
	}
}
if(count($about['place']))
{
	foreach($about['place'] as $v)
	{
		$or[]=array('place'=>$v);
	}
}
if(count($about['tags']))
{
	$ref['tags']=array();
	foreach($about['tags'] as $v)
	{
		$or[]=array('tags'=>$v);
		$ref['tags'][]=$v;
	}
}
if($c=count($or))
{
	if($c>1)
	{
		$_['$or']=$or;
	}
	else
	{
		$_=array_merge($_,$or[0]);
	}
	$template->assign('news',$db->find('news',$_,array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>20)));
	
	unset($_['pl']);
	$template->assign('forum',$db->find('forum',$_,array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>20)));
	
}

$user=_::user()->profile($about['u']);
if($user['google'])
{
	_::$meta['google']=$user['google'];
}
$template->assign('ref',$ref);
$template->assign('user',$user);

_::$content=$template->fetch('profile');
?>