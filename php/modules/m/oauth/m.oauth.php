<?php


_::$meta['title'] = 'BoxZa สังคมออนไลน์';
_::$meta['description'] = 'ไลน์ - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ไลน์, หาเพื่อน, สังคมออนไลน์, แชท, พูดคุย';


$template=_::template();

define('HIDE_PANEL',1);

if(in_array(_::$path[0],['logout']))
{
	require_once(__DIR__.'/m.oauth.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/m.oauth.login.php');
}



?>