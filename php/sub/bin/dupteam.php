<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();
/*
$team=$db->find('football_team',array(),array(),array('sort'=>array('_id'=>1)));
for($i=0;$i<count($team);$i++)
{
	if($db->count('football_team',array('_ng'=>$team[$i]['_ng']))>1)
	{
		$db->remove('football_team',array('_ng'=>$team[$i]['_ng'],'_id'=>array('$ne'=>$team[$i]['_id'])));
	}
}
*/

//$db->remove('football_team',array('l'=>'','n'=>''));

?>