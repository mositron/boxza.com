<?php

_::session()->logged();

_::ajax()->register(array('delalbum','newalbum'),'manage');


//_::time();
$db=_::db();
extract(_::split()->get('/manage/',0,array('page')));

$arg = array('u'=>_::$my['_id'],'ty'=>'album','lo'=>array('$exists'=>false),'dd'=>array('$exists'=>false));

if(_::$my['am']>=9 || _::$my['_id']==4)
{
	unset($arg['u']);
}
$line=array();
if($count=$db->count('line',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(20,$count,array('/manage/','page-'),$page);
	$line=$db->find('line',$arg,array('tt'=>1,'pt'=>1),array('skip'=>$skip,'limit'=>20,'sort'=>array('_id'=>-1)),false);
}//'_id'=>1,'tt'=>1,'lo'=>1,'pt'=>1,'u'=>1,'ms'=>1

$template->assign('count',$count);
$template->assign('album',$line);
$template->assign('pager',$pg);
_::$content=$template->fetch('manage');


?>