<?php

$error=array();

_::session()->logged();


$db=_::db();
if($_POST)require_once(__DIR__.'/deal.post.post.php');

/*
$fbtab=array();
$tmp=$db->find('deal_fbtab',array('u'=>_::$my['_id']));
for($i=0;$i<count($tmp);$i++)
{
	$fbtab[]=$tmp[$i]['fp'];
}
$template->assign('fbtab',$fbtab);
*/
$template->assign('error',$error);

_::$content=$template->fetch('post');

?>