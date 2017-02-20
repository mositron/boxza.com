<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

$user=$db->find('user',array('dd'=>array('$exists'=>false),'st'=>array('$exists'=>false)),array('_id'=>1,'st'=>1));


for($i=0;$i<count($user);$i++)
{
	//$sc = floor(intval($user[$i]['if']['crank'])/60);
	//$db->update('user',array('_id'=>$user[$i]['_id']),array('$set'=>array('if.ch.sc'=>$sc,'if.ch.na'=>$user[$i]['if']['cn'])));
	if(!$user[$i]['st'])
	{
		$db->update('user',array('_id'=>$user[$i]['_id']),array('$set'=>array('st'=>0)));
	}
}
echo count($user);

?>