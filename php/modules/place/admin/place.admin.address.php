<?php

_::ajax()->register('setlatlng');


$place=getplace();

//print_r($place[0]);
$template->assign('place',$place);


_::$content=$template->fetch('admin.address');

function setlatlng($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	//$ajax->alert(print_r($arg['gg'],true));	
	$a=array('dl2'=>new mongodate());
	if(is_array($arg['loc'])&&count($arg['loc'])>1)
	{
		$a['loc']=array(floatval($arg['loc'][0]),floatval($arg['loc'][1]));
	}
	$db->update('place',array('_id'=>intval($arg['_id'])),array('$set'=>$a));
	
	$place=getplace();
	$ajax->jquery('#next','html',$place['n'].' ('.$place['_id'].') - ที่อยู่: '.$place['address']);
	$ajax->script('setTimeout(function(){startmap('.$place['_id'].',"'.$place['address'].'")},2000);');
}

function getplace()
{
	$p=_::db()->find('place',array('ty'=>array('$in'=>array(2,3,4)),'dd'=>array('$exists'=>false)),array('_id'=>1,'tt'=>1,'p2'=>1,'n'=>1,'ty'=>1),array('sort'=>array('dl2'=>1),'limit'=>1));
	$v=$p[0];
	$v['address']='';
	
	$bkk=($v['p2']==1);
	if($v['ty']==4)
	{
		$v['address'].=(($bkk?'':'ตำบล').$v['n'].' ');
		$v['address'].=(($bkk?'':'อำเภอ').$v['tt']['t3']['n'].' ');
		$v['address'].=(($bkk?'':'จังหวัด').$v['tt']['t2']['n'].' ');
	}
	elseif($v['ty']==2)
	{
		$v['address'].='จังหวัด'.$v['n'].' ';
	}
	else
	{
		$v['address'].=(($bkk?'':'อำเภอ').$v['n'].' ');
		$v['address'].=(($bkk?'':'จังหวัด').$v['tt']['t2']['n'].' ');
	}
	$v['address'].='ประเทศไทย';
	return $v;
}
?>