<?php

if(!isset($seamsee[_::$path[1]]))
{
	_::move('/seamsee');
}
$result=require(__DIR__.'/config/'._::$path[1].'.php');
if(!isset($result[_::$path[2]]))
{
	_::move('/seamsee/view/'._::$path[1]);
}

$template->assign('no',getno(_::$path[2]));
$template->assign('result',$result[_::$path[2]]);
$template->assign('parent','/seamsee/view/'._::$path[1]);

_::$content=$template->fetch('seamsee.result');


function getno($n)
{
	$no='';
	$a=array('๐','๑','๒','๓','๔','๕','๖','๗','๘','๙');
	$n=strval($n);
	for($i=0;$i<mb_strlen($n,'utf-8');$i++)
	{
		$q=intval(mb_substr($n,$i,1,'utf-8'));
		$no.=$a[$q];
	}
	return $no;
}
?>
