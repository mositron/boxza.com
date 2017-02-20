<?php
_::session()->logged();


if(!_::$my['st'] || _::$my['st']<1)
{
	_::move('http://boxza.com/verify');
}


$template=_::template();
$template->assign('html',_::html());

if(is_numeric(_::$path[0])||_::$path[0]=='new')
{
	require_once(__DIR__.'/guess.manage.view.php');
}
elseif(in_array(_::$path[0],array('stats','tab','clearfile')))
{
	require_once(__DIR__.'/guess.manage.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/guess.manage.home.php');
}
?>