<?php

$db=_::db();


$tags=array();
$tmp=$db->find('tags',array('amount'=>array('$gte'=>2)),array(),array('sort'=>array('du'=>-1,'amount'=>-1)),false);

$min=0;
$max=0;
foreach($tmp as $v)
{
	if(!$min)
	{
		$min=$v['amount'];
	}
	elseif($min>$v['amount'])
	{
		$min=$v['amount'];
	}
	if(!$max)
	{
		$max=$v['amount'];
	}
	elseif($max<$v['amount'])
	{
		$max=$v['amount'];
	}
}

$rt = ($max-$min)/5;

foreach($tmp as $v)
{
	$av = $v['amount']-$min;
	$v['size'] = floor($av/$rt);
	$tags[]=$v;	
}


$template->assign('tags',$tags);

_::$content=_::template()->fetch('tag.home');


?>