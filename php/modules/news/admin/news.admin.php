<?php
_::session()->logged();

if(is_numeric(_::$path[0]))
{
	require_once(__DIR__.'/news.admin.update.php');
}
elseif(in_array(_::$path[0],array('upload','report','topnews')))
{
	require_once(__DIR__.'/news.admin.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/news.admin.home.php');
}

?>