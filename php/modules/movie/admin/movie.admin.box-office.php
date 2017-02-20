<?php

$db=_::db();
if(isset($_POST) && isset($_POST['box1']))
{
	$db->update('movie',array('bx'=>array('$exists'=>true)),array('$unset'=>array('bx'=>1)),array('multiple'=>true));
	for($i=1;$i<=5;$i++)
	{
		if(isset($_POST['box'.$i]))
		{
			$val = intval(trim($_POST['box'.$i]));
			$db->update('movie',array('_id'=>$val),array('$set'=>array('bx'=>$i)));
		}
	}
}


$tmp=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'bx'=>array('$gte'=>0)),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'bx'=>1),array('sort'=>array('bx'=>1),'limit'=>5));
$box=array();
for($i=0;$i<count($tmp);$i++)
{
	$box[$tmp[$i]['bx']]=$tmp[$i];
}

$template->assign('box',$box);
_::$content=$template->fetch('admin.box-office');
?>