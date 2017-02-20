<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();
$upload=_::upload();

$comment=$db->find('line',array('dc'=>array('$exists'=>false)),array('_id'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>100000));

for($i=0;$i<count($comment);$i++)
{
	$db->update('line',array('_id'=>$comment[$i]['_id']),array('$set'=>array('dc'=>$comment[$i]['da'])));
	echo $comment[$i]['_id'].'<br>';
}

//$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
//$db->update('user',array(),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));




?>