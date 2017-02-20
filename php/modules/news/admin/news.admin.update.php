<?php

define('HIDE_SIDEBAR',1);

//_::link();
//_::time();
$db=_::db();

if(!$news=$db->findone('news',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/admin');
}

_::$meta['title']='Admin - แก้ไข: '.$news['t'];

if(($news['da']->sec<time()-(3600*24*7)) && ($news['c']!=12))
{
	#_::move('/admin');
}

if($news['u']==_::$my['_id'] || _::$my['am'])
{

}
else
{
	_::move('/admin');
}

$error=array();

if($_POST)
{
	if(_::$my['am'] || (($news['u']==_::$my['_id']) && ((!$news['ds']) || ($news['ds']->sec > time()-(3600*24)))))
	{
		require_once(__DIR__.'/news.admin.update.post.php');
	}
}

$people=array();
if($news['people'])
{
	for($i=0;$i<count($news['people']);$i++)
	{
		if($s=$db->findone('people',array('_id'=>intval($news['people'][$i])),array('_id'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'lk'=>1)))
		{
			$people[]=$s;
		}
	}
}
$place=array();
if($news['place'])
{
	for($i=0;$i<count($news['place']);$i++)
	{
		if($s=$db->findone('place',array('_id'=>intval($news['place'][$i])),array('_id'=>1,'n'=>1,'lk'=>1)))
		{
			$place[]=$s;
		}
	}
}

$team=array();
if($news['team'])
{
	for($i=0;$i<count($news['team']);$i++)
	{
		if($s=$db->findone('football_team',array('_id'=>intval($news['team'][$i])),array('_id'=>1,'n'=>1,'t'=>1,'l'=>1)))
		{
			$team[]=$s;
		}
	}
}

if($news['sm'])
{
	$news['d']=$news['sm'].$news['d'];
	$news['sm']='';
}
$template->assign('news',$news);
$template->assign('people',$people);
$template->assign('place',$place);
$template->assign('team',$team);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>