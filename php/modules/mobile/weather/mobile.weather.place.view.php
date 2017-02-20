<?php


//_::time();
$db=_::db();
if(!$weather=$db->findone('weather',array('_id'=>intval(_::$path[1]))))
{
	_::move('/weather',true);	
}


$template->assign('z',$weather['zone']);
$template->assign('weather',$weather);
_::$content=$template->fetch('weather.place.view');



?>