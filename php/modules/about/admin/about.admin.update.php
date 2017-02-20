<?php

$db=_::db();
if(!$about=$db->findone('about',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/admin');
}

$error=array();
if($_POST)
{
	require_once(__DIR__.'/about.admin.update.post.php');
}


$people=array();
if($about['people'])
{
	for($i=0;$i<count($about['people']);$i++)
	{
		if($s=$db->findone('people',array('_id'=>intval($about['people'][$i])),array('_id'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'lk'=>1)))
		{
			$people[]=$s;
		}
	}
}
$place=array();
if($about['place'])
{
	for($i=0;$i<count($about['place']);$i++)
	{
		if($s=$db->findone('place',array('_id'=>intval($about['place'][$i])),array('_id'=>1,'n'=>1,'lk'=>1)))
		{
			$place[]=$s;
		}
	}
}

$template->assign('people',$people);
$template->assign('place',$place);

$template->assign('about',$about);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>