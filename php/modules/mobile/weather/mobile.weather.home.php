<?php


$db=_::db();


$weather=$db->find('weather',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
$news=$db->find('news',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>21,'exl'=>0),array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'ds'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'skip'=>0,'limit'=>5));

$template->assign('news',$news);
$template->assign('weather',$weather);

_::$content=$template->fetch('weather.home');

/*
_::$content=json_encode(array('type'=>'weather','category'=>array(),'updated'=>date('r'),'format'=>$format,'data'=>array(
																																																						'news'=>array('lastupdate'=>$news[0]['ds']->sec),
																																																						'weather'=>array('lastupdate'=>$weather[0]['da']->sec),
																																																						'set'=>array('lastupdate'=>$set[0]['da']->sec)
	)));

*/
?>
