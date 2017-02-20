<?php

//_::time();
$db=_::db();



$access=check_perm('cache');

if($access)
{
	_::ajax()->register('clearcache');
}
$template->assign('user',_::user());
$template->assign('access',$access);
$template->assign('logs',$db->find('logs',array('ty'=>'cache'),array(),array('sort'=>array('_id'=>-1),'limit'=>100)));
_::$content=$template->fetch('cache');


function clearcache()
{
	$db=_::db();
	$ajax=_::ajax();
	_::cache()->flush('ca1');
	_::cache()->flush('ca2');
	$db->insert('logs',array('ty'=>'cache','u'=>_::$my['_id']));
	$ajax->alert('ล้างแคชทั้งหมดเรียบร้อยแล้ว');
	$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
}
?>