<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

$u=$db->find('user',array(),array('_id'=>1,'if'=>1));

for($i=0;$i<count($u);$i++)
{
	if($bd=$u[$i]['if']['bd'])
	{
		$m=intval(date('m',$bd->sec));
		$d=intval(date('d',$bd->sec));
		$db->update('user',array('_id'=>$u[$i]['_id']),array('$set'=>array('if.bdk'=>$m.'-'.$d)));
	}
}
?>