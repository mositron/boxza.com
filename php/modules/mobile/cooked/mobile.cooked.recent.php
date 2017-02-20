<?php


if(!_::$path[1])
{
	_::move('/cooked');	
}
$db=_::db();
$cooked=$db->find('cooked_line',array('u'=>intval(_::$path[1]),'dd'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>-1),'limit'=>50));

$template->assign('parent','/cooked');
$template->assign('cooked',$cooked);
_::$content=$template->fetch('cooked.recent');


?>