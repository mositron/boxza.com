<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();


//echo $db->count('line',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*30*6)))));


//$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
//$db->update('user',array(),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));




?>