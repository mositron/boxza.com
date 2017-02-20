<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();
$upload=_::upload();

$start=intval($_GET['start']);
if($photo=$db->find('line',array('dd'=>array('$exists'=>true),'dp'=>array('$exists'=>false),'pt.f'=>array('$exists'=>true),'ty'=>array('$ne'=>'album')),array(),array('sort'=>array('_id'=>-1),'limit'=>10000,'skip'=>$start)))
{
	for($i=0;$i<count($photo);$i++)
	{
		if($photo[$i]['pt']['f']&&is_string($photo[$i]['pt']['f']))
		{
			echo $photo[$i]['_id'].' - pt.f = '.$photo[$i]['pt']['f'].' - ';
			$q=$upload->send('s1','line-remove',$photo[$i]['pt']['f']);
			echo $q['status'].' - '.$q['message'];
			//if($q['status']=='OK')
			//{
				$db->update('line',array('_id'=>$photo[$i]['_id']),array('$set'=>array('dp'=>new MongoDate())));
			///}
		}
		else
		{
			echo $photo[$i]['_id'].' - ty = '.$photo[$i]['ty'].' -  no path';	
		}
		echo '<br>';
	}
}


//$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
//$db->update('user',array(),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));




?>