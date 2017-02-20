<?php

_::session()->logged();

$db=_::db();
$arg=array('_id'=>intval(_::$path[0]),'u'=>_::$my['_id'],'ty'=>'album','dd'=>array('$exists'=>false),'lo'=>array('$exists'=>false));
if(_::$my['am'])
{
	unset($arg['u']);
}
if(!$album=$db->findone('line',$arg))
{
	_::move('/manage');
}

_::ajax()->register(array('save','getrefresh','setdetail','getdetail','delline','setcover'),'update');

$template->assign('album',$album);
$template->assign('html',_::html());
$template->assign('getphotos',getphotos());
_::$content=$template->fetch('update');



function getphotos()
{
	$db = _::db();
	$photo = $db->find('line',array('ty'=>array('$in'=>array('photo','cover')),'pt.a'=>intval(_::$path[0]),'dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-3),'lk'=>1,'sh'=>1,'in'=>1,'pt'=>1),array('sort'=>array('_id'=>-1),'limit'=>100));
	$template=_::template();
	$template->assign('photo',$photo);
	return $template->fetch('update.photo');
}
?>