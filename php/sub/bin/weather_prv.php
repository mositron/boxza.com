<?php

require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

$db=_::db();
$prv=require('../../handlers/boxza/province.php');
foreach($prv as $k=>$v)
{
	echo $db->update('weather',array('name'=>$v['name_th']),array('$set'=>array('prv'=>intval($k)))).'<br>';
	
}
/*
$zone=1;
$p=explode("\n",$a);
for($i=0;$i<count($p);$i++)
{
	$t=trim($p[$i]);
	if($t)
	{
		$e=explode(',',$t);
		$arg=array('tmd'=>intval($e[0]),'name'=>trim($e[1]),'zone'=>$zone);
		//$db->insert('weather',$arg);
	}
	else
	{
		$zone++;	
	}
}
*/

?>