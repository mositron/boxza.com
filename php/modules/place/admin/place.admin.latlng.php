<?php

_::ajax()->register('setlatlng');


$place=getplace();

//print_r($place[0]);
$template->assign('place',$place);


_::$content=$template->fetch('admin.latlng');

function setlatlng($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	//$ajax->alert(print_r($arg['gg'],true));	
	$a=array('dl'=>new mongodate());
	if(is_array($arg['gg'])&&count($arg['gg'])>1)
	{
		$a['gg']=$arg['gg'];
	}
	$db->update('place',array('_id'=>intval($arg['_id'])),array('$set'=>$a));
	
	$place=getplace();
	$ajax->jquery('#next','html',$place['n'].' ('.$place['_id'].') - พิกัด: '.$place['loc'][0].','.$place['loc'][1]);
	$ajax->script('setTimeout(function(){startmap('.$place['_id'].','.$place['loc'][0].','.$place['loc'][1].')},2000);');
}

function getplace()
{
	$p=_::db()->find('place',array('ty'=>array('$in'=>array(5)),'loc.0'=>array('$ne'=>0),'loc.1'=>array('$ne'=>0),'dd'=>array('$exists'=>false)),array('_id'=>1,'loc'=>1,'n'=>1),array('sort'=>array('dl'=>1),'limit'=>1));
	return $p[0];
}
?>