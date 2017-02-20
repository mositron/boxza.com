<?php


if($place['_ky']==1)
{
	$isbkk=true;
}
else
{
	$isbkk=false;
}

//$template->assign('build',$db->find('place',array('ty'=>5,'pl'=>1,'p2'=>$place['_ky']),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1)),array('limit'=>20));


$template->assign('weather',$db->findone('weather',array('prv'=>$place['prv'])));

$template->assign('isbkk',$isbkk);

$template->assign('amp',$db->find('place',array('ty'=>3,'pl'=>1,'p2'=>$place['_ky']),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1)));


$template->assign('page',$template->fetch('profile.province.home'));
?>