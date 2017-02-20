<?php

$error=array();

_::session()->logged();


$db=_::db();
if($_POST)
{
	require_once(__DIR__.'/glitter.post.post.php');
	$template->assign('error',$error);
	$template->assign('post',$_POST);
}
_::$content=$template->fetch('post');

?>