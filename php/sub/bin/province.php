<?php

require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');



$db=_::db();

$format=_::format();

$p=$db->find('place',array('ty'=>2),array('_id'=>1,'n'=>1,'ne'=>1),array('sort'=>array('_id'=>1,'p1'=>1),'limit'=>10000));

for($i=0;$i<count($p);$i++)
{
	$v=$p[$i];
	
	$l=$format->link(str_replace(' ','',$v['ne']));
	echo '\''.$l.'\'=>'.$v['_id'].",\n";
	
	//$db->update('place',array('_id'=>$v['_id']),array('$set'=>array('sl'=>$l)));
}

?>
