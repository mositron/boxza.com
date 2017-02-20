<?php


$access=check_perm('home-banner');
if(!$access)
{
	_::move('/');	
}

if(in_array(_::$path[0],array('recent','domain')))
{
	require_once(__DIR__.'/control.blog.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/control.blog.home.php');
}

?>