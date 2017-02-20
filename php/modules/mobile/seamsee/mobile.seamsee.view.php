<?php

if(!isset($seamsee[_::$path[1]]))
{
	_::move('/seamsee');
}

_::ajax()->register(array('getresult'));

$template->assign('parent','/seamsee');

_::$content=$template->fetch('seamsee.view');


function getresult()
{
	$result=require(__DIR__.'/config/'._::$path[1].'.php');
	$key=array_keys($result);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	shuffle($key);
	
	_::ajax()->redirect('/seamsee/result/'._::$path[1].'/'.$key[0]);
}
?>
