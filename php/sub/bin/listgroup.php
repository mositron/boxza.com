<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

$user=_::user();
$u=$db->find('user',array('ct.gp'=>array('$exists'=>false)),array('_id'=>1,'ct.fl'=>1));

for($i=0;$i<count($u);$i++)
{
	$gp=array();
	for($j=0;$j<count($u[$i]['ct']['fl']['d']);$j++)
	{
		$gp[]=array('n'=>$u[$i]['ct']['fl']['d'][$j]['n'],'u'=>$u[$i]['ct']['fl']['d'][$j]['u']);
	}
	$user->update($u[$i]['_id'],array('$set'=>array('ct.gp'=>$gp,'ct.fl2'=>$u[$i]['ct']['fl'],'ct.fl'=>array())));
}
?>