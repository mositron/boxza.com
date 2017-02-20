<?php
_::$dbclick=3;
//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','album_home'))
{
	//_::time();
	$db=_::db();
	$template=_::template();

	$template->assign('new',(array)$db->find('line',array('dd'=>array('$exists'=>false),'pt.cv'=>array('$exists'=>true),'pt.ty'=>array('$exists'=>true,'$nin'=>array(7,15,17)),'ty'=>'album','in'=>0,'pt.c'=>array('$gte'=>5)),array('_id'=>1,'tt'=>1,'lo'=>1,'pt'=>1,'cm.c'=>1),array('sort'=>array('pt.vt'=>-1,'_id'=>-1),'limit'=>8)));
	$template->assign('hit',(array)$db->find('line',array('dd'=>array('$exists'=>false),'pt.cv'=>array('$exists'=>true),'pt.ty'=>array('$exists'=>true,'$in'=>array(7,15,17)),'ty'=>'album','in'=>0,'pt.c'=>array('$gte'=>5)),array('_id'=>1,'tt'=>1,'lo'=>1,'pt'=>1,'cm.c'=>1),array('sort'=>array('pt.vt'=>-1),'limit'=>8)));
	$album=array();
	foreach(_::$config['album'] as $a=>$b)
	{
		$album[$a]=$db->find('line',array('dd'=>array('$exists'=>false),'pt.cv'=>array('$exists'=>true),'ty'=>'album','in'=>0,'pt.ty'=>intval($a)),array('_id'=>1,'tt'=>1,'lo'=>1,'pt'=>1,'cm.c'=>1),array('sort'=>array('_id'=>-1),'limit'=>5),false);
	}
	$template->assign('album',$album);
	_::$content=$template->fetch('home');


	$cache->set('ca1','album_home',_::$content,false,3600);
}

?>