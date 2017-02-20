<?php


	//_::time();
	$db=_::db();
	if(!$weather=$db->findone('weather',array('_id'=>intval(_::$path[0]))))
	{
		_::move('/',true);	
	}
	
	
_::$meta['title']='พยากรณ์อากาศ'.$weather['name'].' สภาพอากาศ'.$weather['name'].' - '._::$meta['title'];
_::$meta['description']='พยากรณ์อากาศ'.$weather['name'].' สภาพอากาศ'.$weather['name'].' - '._::$meta['description'];

$template->assign('weather',$weather);
_::$content=$template->fetch('place');



?>