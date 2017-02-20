<?php


$db=_::db();
$lottery=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>22),array('ds'=>1),array('sort'=>array('_id'=>-1),'limit'=>1));
$set=$db->find('lotto_set',array(),array('da'=>1),array('sort'=>array('_id'=>-1),'limit'=>1));

$template->assign('news',$news[0]);
$template->assign('lottery',$lottery[0]);
$template->assign('set',$set[0]);

_::$content=$template->fetch('lotto.home');

/*
_::$content=json_encode(array('type'=>'lotto','category'=>array(),'updated'=>date('r'),'format'=>$format,'data'=>array(
																																																						'news'=>array('lastupdate'=>$news[0]['ds']->sec),
																																																						'lotto'=>array('lastupdate'=>$lotto[0]['da']->sec),
																																																						'set'=>array('lastupdate'=>$set[0]['da']->sec)
	)));

*/
?>
