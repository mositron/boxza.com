<?php
_::session()->logged();

define('HIDE_SIDEBAR',1);
if(_::$my['am'])
{
	if(is_numeric(_::$path[0]))
	{
		require_once(__DIR__.'/about.admin.update.php');
	}
	elseif(in_array(_::$path[0],array('upload','instagram')))
	{
		require_once(__DIR__.'/about.admin.'._::$path[0].'.php');
	}
	else
	{
		require_once(__DIR__.'/about.admin.home.php');
	}
}
else
{
	_::move('/');
}

?>