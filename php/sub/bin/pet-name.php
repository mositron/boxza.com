<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

$pet=$db->find('lionica_char',array('dd'=>array('$exists'=>false),'lv'=>array('$gt'=>1)));

for($i=0;$i<count($pet);$i++)
{
	
	$ptr=getptr($pet[$i]['lv']);
	$ptr2=getstat($pet[$i]['stats']['str']);
	$ptr2+=getstat($pet[$i]['stats']['agi']);
	$ptr2+=getstat($pet[$i]['stats']['vit']);
	$ptr2+=getstat($pet[$i]['stats']['dex']);
	$ptr2+=getstat($pet[$i]['stats']['int']);
	//$ptr2+=$pet[$i]['stats']['ptr'];
	
	echo $pet[$i]['n'].' : '.$ptr.' = '.($ptr2.'+'.$pet[$i]['stats']['ptr']).'<br>';
	
	$set=array('mlv'=>$pet[$i]['lv']);
	if($ptr!=($ptr2+$pet[$i]['stats']['ptr']))
	{
		$set['stats']=array('str'=>1,'agi'=>1,'vit'=>1,'dex'=>1,'int'=>1,'ptr'=>$ptr);
	}
	print_r($set);
	echo '<br>';
	$db->update('lionica_char',array('_id'=>$pet[$i]['_id']),array('$set'=>$set));
	
}

function getptr($lv)
{
	$ptr=0;
	while($lv>1)
	{
		$ptr+=(floor($lv/5)+3);
		$lv--;
	}
	return $ptr;
}

function getstat($p)
{
	$pr=0;
	while($p>1)
	{
		$pr+=floor(($p - 3)/10)+2;
		$p--;
	}
	return $pr;
}
?>