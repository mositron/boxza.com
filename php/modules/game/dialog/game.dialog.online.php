<?php

$cache=_::cache();
if(!$ct=$cache->get('ca1','chat_online_'._::$path[1]))
{
	$db=_::db();
	$template=_::template();
	$template->assign('user',_::user());
	$template->assign('month',$db->find('chat_online',array('r'=>intval(_::$path[1]),'m'=>date('n')),array(),array('sort'=>array('t'=>-1,'u'=>1),'limit'=>100)));
	//$template->assign('day',$db->find('chat_online',array('r'=>1,'k'=>date('m-d')),array(),array('sort'=>array('t'=>-1,'u'=>1),'limit'=>50)));
	$ct = $template->fetch2('game.dialog.online');
	
	$cache->set('ca1','chat_online_'._::$path[1],$ct,false,180);
}
echo $ct;
exit;
?>