<?php
_::session()->logged();

if(in_array(_::$path[0],array('car','news')))
{
	require_once(__DIR__.'/racing.admin.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/racing.admin.home.php');
}

?>