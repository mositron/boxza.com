<?php
_::session()->logged();

define('ROOM',1);
$arg['dd']=array('$exists'=>false);
$db=_::db();
if(!$room=$db->findone('chatroom',array('dd'=>array('$exists'=>false),'_id'=>intval(_::$path[1]))))
{
	_::move('/chat');
}

$template->assign('parent','/chat');
$template->assign('room',$room);
_::$content=$template->fetch('chat.room');


?>