<?php




_::$content=$template->fetch('oil.home');

/*
_::$content=json_encode(array('type'=>'oil','category'=>array(),'updated'=>date('r'),'format'=>$format,'data'=>array(
																																																						'news'=>array('lastupdate'=>$news[0]['ds']->sec),
																																																						'oil'=>array('lastupdate'=>$oil[0]['da']->sec),
																																																						'set'=>array('lastupdate'=>$set[0]['da']->sec)
	)));

*/
?>
