<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();
$upload=_::upload();

$time=time()-(90*24*3600);

$start=intval($_GET['start']);
if($line=$db->find('line',array('dd'=>array('$lt'=>new mongodate($time))),array(),array('sort'=>array('_id'=>1),'limit'=>10000,'skip'=>$start)))
{
	for($i=0;$i<count($line);$i++)
	{
		$db->remove('line',array('_id'=>$line[$i]['_id']));
		echo $line[$i]['_id'].' - ty = '.$line[$i]['ty'].' -  dd = '.time::show($line[$i]['dd'],'datetime');	
		echo '<br>';
	}
}
else
{
	echo 'no';	
}


//$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
//$db->update('user',array(),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));




?>