<?php

require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');



$db=_::db();



$p=$db->find('place',array('zip'=>array('$exists'=>false),'ty'=>5,'$or'=>array(

array('gg.postal_code.long_name'=>array('$exists'=>true,'$ne'=>'')),
array('log.zip'=>array('$exists'=>true,'$ne'=>''))

)),array('_id'=>1,'log'=>1,'gg'=>1,'n'=>1),array('sort'=>array('_id'=>1),'limit'=>10000));

for($i=0;$i<count($p);$i++)
{
	$v=$p[$i];
	$gt=array();
	$arg=array();
	//
	if(($t=trim($v['log']['zip']))&&strlen($t)==5)
	{
		echo 'log - '.$v['log']['zip'].' - '.intval($t).'<br>';
		$db->update('place',array('_id'=>$v['_id']),array('$set'=>array('zip'=>intval($t))));
	}
	elseif($g=$v['gg'])
	{
		if($y=$g['postal_code'])
		{
			if($t=trim($y['long_name']))
			{
				echo 'gg - '.intval($t).'<br>';
				$db->update('place',array('_id'=>$v['_id']),array('$set'=>array('zip'=>intval($t))));
			}
		}
	}
}

?>
<html>
<head></head>
<body>
<?php
if($p)
{
	echo '<script>setTimeout(function(){window.location.href="?";},5000);</script>';
}
//print_r($v);
?>
</body>
</html>


