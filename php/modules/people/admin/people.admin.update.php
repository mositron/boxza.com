<?php

$db=_::db();
if(!$people=$db->findone('people',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/admin');
}

$error=array();
if($_POST)
{
	require_once(__DIR__.'/people.admin.update.post.php');
}

$template->assign('people',$people);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>