<?php

$pp=50;
$parm=_::split()->get('/friend/ladyboy',1,array('page','province','min','max'));
$page=intval($parm['page']);
$_province=strval($parm['province']);
$_min=intval(strval($parm['min'])?strval($parm['min']):0);
$_max=intval(strval($parm['max'])?strval($parm['max']):60);

$template->assign('_province',$_province);
$template->assign('_min',$_min);
$template->assign('_max',$_max);

$arg=array('dd'=>array('$exists'=>false),'ty'=>'ladyboy');
if($_province)
{
	$arg['pr']=array('$in'=>array_map('intval',explode('_',$_province)));
}
$arg['ag']=array();
if($_min)
{
	$arg['ag']['$gte']=$_min;
}
if($_max)
{
	$arg['ag']['$lte']=$_max;
}


if(!$page || $page<1)$page=1;

$db=_::db();
if($count=$db->count('appfriend',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array($parm['url'],'page-'),$page);
	$friend=$db->find('appfriend',$arg,array(),array('sort'=>array('ds'=>-1),'skip'=>$skip,'limit'=>$pp));
}


$template->assign('friend',$friend);
$template->assign('parent','/friend');
$template->assign('page',$page);
$template->assign('parm',$parm);
$template->assign('maxpage',ceil($count/$pp));
$template->assign('cur','?parent='.urlencode(URL));

_::$content=$template->fetch('friend.ladyboy');

?>
