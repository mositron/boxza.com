<?php

$db=_::db();
if(!$movie=$db->findone('movie',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/');
}

$error=array();

$movie['c']=(array)$movie['c'];
$movie['cn']=(array)$movie['cn'];

if($_POST)require_once(__DIR__.'/movie.admin.update.post.php');


$template->assign('movie',$movie);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>