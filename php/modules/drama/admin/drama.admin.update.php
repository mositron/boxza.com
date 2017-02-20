<?php

define('HIDE_SIDEBAR',1);

//_::link();
//_::time();
$db=_::db();

if(!$drama=$db->findone('drama',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/admin');
}

if($drama['u']==_::$my['_id'] || _::$my['am'])
{

}
else
{
	_::move('/admin');
}

$error=array();

if($_POST)
{
	if(_::$my['am'] || (($drama['u']==_::$my['_id']) && ((!$drama['ds']) || ($drama['ds']->sec > time()-(3600*24)))))
	{
		require_once(__DIR__.'/drama.admin.update.post.php');
	}
}

$people=array();
if($drama['people'])
{
	for($i=0;$i<count($drama['people']);$i++)
	{
		if($s=$db->findone('people',array('_id'=>intval($drama['people'][$i])),array('_id'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'lk'=>1)))
		{
			$people[]=$s;
		}
	}
}
$place=array();
if($drama['place'])
{
	for($i=0;$i<count($drama['place']);$i++)
	{
		if($s=$db->findone('place',array('_id'=>intval($drama['place'][$i])),array('_id'=>1,'n'=>1,'lk'=>1)))
		{
			$place[]=$s;
		}
	}
}

$template->assign('drama',$drama);
$template->assign('people',$people);
$template->assign('place',$place);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>