<?php


//_::$meta['rss']='http://feed.boxza.com/poem/rss';
//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','poem_home'))
{
	$db=_::db();
	$template=_::template();

	
	$last=$db->find('poem',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'ty'=>1),array('sort'=>array('_id'=>-1),'limit'=>52));
	$rec=$db->find('poem',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'ty'=>1),array('sort'=>array('rc'=>-1,'_id'=>-1),'limit'=>12));
	$template->assign('last',$last);
	$template->assign('rec',$rec);
	_::$content=$template->fetch('home');


	$cache->set('ca1','poem_home',_::$content,false,3600);
}

?>