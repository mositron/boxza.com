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


$template->assign('page',$template->fetch('profile.district.home'));
?>