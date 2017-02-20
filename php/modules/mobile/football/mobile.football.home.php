<?php




_::$content=$template->fetch('football.home');

/*
_::$content=json_encode(array('type'=>'football','category'=>array(),'updated'=>date('r'),'format'=>$format,'data'=>array(
																																																						'news'=>array('lastupdate'=>$news[0]['ds']->sec),
																																																						'football'=>array('lastupdate'=>$football[0]['da']->sec),
																																																						'set'=>array('lastupdate'=>$set[0]['da']->sec)
	)));

*/
?>
