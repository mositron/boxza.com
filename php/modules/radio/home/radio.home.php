<?php

//_::$meta['google']=array('id'=>'112235668332689047152');


$template->assign('news',_::db()->find('news',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>24),array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>16)));
	
_::$content=$template->fetch('home');

	

?>