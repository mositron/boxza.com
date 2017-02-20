<?php
_::session()->logged();

_::$meta['title'] = 'ข้อความ - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'ข้อความ - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ข้อความ, สังคมออนไลน์';

if(!_::$path[0])
{
	require_once(__DIR__.'/social.messages.list.php');
}
else
{
	require_once(__DIR__.'/social.messages.view.php');
}

?>