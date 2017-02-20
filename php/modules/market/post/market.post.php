<?php

$error=array();

_::session()->logged();

if(!_::$my['st'] || _::$my['st']<1)
{
	_::move('http://boxza.com/verify');
}

$db=_::db();
if($_POST)require_once(__DIR__.'/market.post.post.php');

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
$template->assign('service',_::sidebar()->service(array('beauty'=>false,'football'=>false,'boyz'=>false,'lesbian'=>false)));

_::$content=$template->fetch('post');

?>