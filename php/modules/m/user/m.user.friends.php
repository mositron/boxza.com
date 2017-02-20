<?php

_::ajax()->register('morefriends');

$template=_::template();


$template->assign('getfriends',getfriends());
_::$content=$template->fetch('user.friends');


_::$meta['title'] = 'เพื่อนของ '._::$profile['name'].' - BoxZa โปรไฟล์ส่วนตัว';
_::$meta['description'] = 'เพื่อนของ '._::$profile['name'].' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'เพื่อน, สังคมออนไลน์';

function getfriends($start=0)
{
	$per = 20;
	$db = _::db();
	$count = count(_::$profile['ct']['fr']);
	if($start>$count)return'';
	$ind = max($count - $per - $start,0);
	$friend = array_slice((array)_::$profile['ct']['fr'],$ind,$per);
	$friend = array_reverse($friend);
	$template=_::template();
	if(count($friend))
	{
		$template->assign('friend',$friend);	
		$template->assign('user',_::user());
	}
	$template->assign('next', ($start+$per>$count?'':$start+$per));
	return $template->fetch('user.friends.list');
}

function morefriends($next=0)
{
	_::ajax()->jquery('#getfriends','append',getfriends($next));
}
?>