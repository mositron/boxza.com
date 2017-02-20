<?php

_::session()->logged();

$db=_::db();
$arg=array('_id'=>intval(_::$path[0]),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
if(_::$my['am']>=9)
{
	unset($arg['u']);
}
if(!$deal=$db->findone('deal',$arg))
{
	_::move('/');
}

$error=array();

if($_POST)require_once(__DIR__.'/market.update.post.php');

/*
$fbtab=array();
$tmp=$db->find('deal_fbtab',array('u'=>_::$my['_id']));
for($i=0;$i<count($tmp);$i++)
{
	$fbtab[]=$tmp[$i]['fp'];
}
*/
$template->assign('deal',$deal);
$template->assign('error',$error);
$template->assign('service',_::sidebar()->service(array('beauty'=>false,'football'=>false,'boyz'=>false,'lesbian'=>false)));
#$template->assign('fbtab',$fbtab);
_::$content=$template->fetch('update');
?>