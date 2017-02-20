<?php

$db=_::db();
if(!$lotto=$db->findone('lotto',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/admin');
}

$error=array();

$d=explode('-',date('j-n-Y',$lotto['tm']->sec));

if($_POST)require_once(__DIR__.'/lotto.admin.update.post.php');


$template->assign('date',array('d'=>$d[0],'m'=>$d[1],'y'=>$d[2]));
$template->assign('lotto',$lotto);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>