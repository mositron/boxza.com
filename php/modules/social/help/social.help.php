
<?php

////_::time();

	_::$meta['title'] = 'คู่มือการใช้งาน BoxZa Social - BoxZa สังคมออนไลน์ของคนไทย';
	_::$meta['description'] = 'คู่มือการใช้งาน BoxZa Social - สังคมออนไลน์ของคนไทย';
	_::$meta['keywords'] = 'คู่มือ, การใช้งาน, boxza, social';
	//_::time();
	$template=_::template();

	//$template->assign('topic',_::db()->find('forum',array('c'=>4,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'da'=>1),array('sort'=>array('_id'=>-1))));
	$template->assign('service',_::sidebar()->service(array('line'=>1)));
	_::$content=$template->fetch('help');




?>