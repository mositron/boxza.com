<?php
_::session()->logged();

if(is_numeric(_::$path[0]))
{
	require_once(__DIR__.'/racing.admin.update.php');
}
elseif(_::$path[0]=='upload')
{
	require_once(__DIR__.'/racing.admin.upload.php');
}
else
{
	require_once(__DIR__.'/racing.admin.home.php');
}

?>