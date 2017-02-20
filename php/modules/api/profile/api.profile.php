<?php
if(!$relate&&_::$my)
{
	$relate=_::$my['_id'];
}
if(in_array(_::$path[1],array('info','line')))
{
	$who=array('uid'=>intval($relate));
	require_once __DIR__.'/api.profile.'._::$path[1].'.php';
}

?>