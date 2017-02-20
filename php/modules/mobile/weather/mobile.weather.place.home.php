<?php

extract(_::split()->get('/weather/place/',1,array('z')));

$z=intval($z);
if($z<1||$z>6)
{
	$z=3;
}

//_::time();
$db=_::db();

$weather=$db->find('weather',array('zone'=>$z),array('_id'=>1,'name'=>1,'zone'=>1,'today'=>1),array('sort'=>array('name'=>1)));

$template->assign('z',$z);
$template->assign('weather',$weather);
_::$content=$template->fetch('weather.place.home');



?>