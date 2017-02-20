<?php


if(in_array(_::$path[1],array('add','edit')))
{
	require_once(__DIR__.'/mobile.cooked.item.'._::$path[1].'.php');
}
else
{
	require_once(__DIR__.'/mobile.cooked.item.home.php');
}

?>