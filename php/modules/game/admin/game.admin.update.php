<?php

$db=_::db();
if(!$game=$db->findone('game',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/');
}

$error=array();

$game['c']=(array)$game['c'];
$game['cn']=(array)$game['cn'];

if($_POST)require_once(__DIR__.'/game.admin.update.post.php');


$template->assign('game',$game);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>