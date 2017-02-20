<?php
_::session()->logged();


if(_::$my['am']!=9)
{
	_::move('http://boxza.com/');
}


$template=_::template();
$template->assign('html',_::html());

if(is_numeric(_::$path[0])||_::$path[0]=='new')
{
	require_once(__DIR__.'/sticker.manage.view.php');
}
elseif(in_array(_::$path[0],array('stats','tab','clearfile')))
{
	require_once(__DIR__.'/sticker.manage.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/sticker.manage.home.php');
}
?>