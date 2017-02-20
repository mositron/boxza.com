<?php

_::session()->logged();

if(_::$my && _::$my['st']>0)
{
	if($_POST)
	{
		require_once(__DIR__.'/event.first.apply.post.php');
	}
}
_::$meta['title'] = 'ลงทะเบียนเข้าร่วมกิจกรรม - '._::$meta['title'];
_::$meta['description'] = 'ลงทะเบียนเข้าร่วมกิจกรรม - '._::$meta['description'];

$content=$template->fetch('first.apply');


?>