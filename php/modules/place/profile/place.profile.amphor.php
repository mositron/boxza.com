<?php

if($place['p2']>1)
{
	$isbkk=false;
}
else
{
	$isbkk=true;
}

$template->assign('isbkk',$isbkk);
$template->assign('dist',$db->find('place',array('ty'=>4,'pl'=>1,'p3'=>$place['_ky']),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1)));


$template->assign('page',$template->fetch('profile.amphor.home'));
?>