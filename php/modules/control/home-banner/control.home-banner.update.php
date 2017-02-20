<?php

$db=_::db();
if(!$banner=$db->findone('banner',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/home-banner');
}


$error=array();

if($_POST)
{
	require_once(__DIR__.'/control.home-banner.update.post.php');
}

$template->assign('banner',$banner);
$template->assign('error',$error);
$template->assign('access',$access);
_::$content=$template->fetch('home-banner.update');
?>