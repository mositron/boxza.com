<?php

$db=_::db();
if(!$place=$db->findone('place',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/admin');
}

$error=array();
if($_POST)
{
	require_once(__DIR__.'/place.admin.update.post.php');
}

$template->assign('place',$place);
$template->assign('error',$error);


$province=require(HANDLERS.'boxza/province.php');
$template->assign('province',$province);
_::$content=$template->fetch('admin.update');
?>