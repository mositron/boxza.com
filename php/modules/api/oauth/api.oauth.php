<?php

if(in_array(_::$path[1],array('login','logout')))
{
	require_once __DIR__.'/api.oauth.'._::$path[1].'.php';
}

?>