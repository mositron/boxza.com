<?php
list($id,$link)=explode('-',_::$path[0],2);

//_::time();
$db=_::db();
if(!$deal=$db->findone('deal',array('_id'=>intval($id),'dd'=>array('$exists'=>false),'pl'=>1)))
{
	_::move('/');
}

if(_::$path[0]!=$deal['_id'].'-'.$deal['l'].'.html')
{
	_::move('/'.$deal['_id'].'-'.$deal['l'].'.html');
}
_::$meta['title']=$deal['t'].' - '._::$meta['title'];
_::$meta['image']='http://s3.boxza.com/deal/'.$deal['fd'].'/m.jpg';
_::$meta['type']='article';

$t=$db->findone('deal_province',array('_id'=>intval($deal['pr'])));
$z=$t['z'];
	
if($own=$db->find('deal',array('u'=>intval($deal['u']),'_id'=>array('$ne'=>$deal['_id']),'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('ds'=>-1),'limit'=>20)))
{
	shuffle($own);
	$own=array_slice($own,0,6);
	$template->assign('own',$own);
}

if($relate=$db->find('deal',array('cs'=>$deal['cs'],'_id'=>array('$ne'=>$deal['_id']),'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('ds'=>-1),'limit'=>20)))
{
	shuffle($relate);
	$own=array_slice($relate,0,6);
	$template->assign('relate',$relate);
}


if($deal['u'])
{
	$poster=_::user()->profile($deal['u']);
	if($poster['google'])
	{
		_::$meta['google']=$poster['google'];
	}
}


$template->assign('p',$deal['pr']);
$template->assign('c',$deal['cs']);
$template->assign('z',$z);
$template->assign('deal',$deal);
$template->assign('user',$poster);
_::$content=$template->fetch('view');
?>