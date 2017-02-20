<?php


if(in_array(_::$path[0],array('namtoa','slave','lottery','bank','thief','item','online','radio','lionica')))
{
	require_once(__DIR__.'/game.dialog.'._::$path[0].'.php');
}
else
{
	exit;
}


function _get_nick($n)
{
	return '<span>'.preg_replace('/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/i','</span><span class="f$1 s$3 b$5">',$n).'</span>';	
}
?>