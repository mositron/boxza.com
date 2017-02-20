<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

$pet=$db->find('pet');

for($i=0;$i<count($pet);$i++)
{
	$db->update('pet',array('_id'=>$pet[$i]['_id']),array('$set'=>array(
																				'hair'=>rand(1,5),
																				'color'=>rand(1,7),
																				'gender'=>rand(1,2)
																				)));
}
?>