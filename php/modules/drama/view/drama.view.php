<?php

$db=_::db();


if(!$drama=$db->findone('drama',array('lk'=>_::$path[0],'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'c'=>1,'cs'=>1,'t'=>1,'d'=>1,'rf'=>1,'u'=>1,'da'=>1,'do'=>1,'ds'=>1,'fd'=>1)))
{
	_::move('/');
}


$db->update('drama',array('_id'=>$drama['_id']),array('$inc'=>array('do'=>1)));

_::$meta['title']=$drama['t'].' ละคร'.$drama['t'].' เรื่องย่อละคร'.$drama['t'].' - '._::$meta['title'];
_::$meta['description']=$drama['t'].' เรื่องย่อละคร '.$drama['t'].' - '._::$meta['description'];
_::$meta['keywords']=$drama['t'].', ละคร, ละคร'.$drama['t'].', เรื่องย่อละคร, เรื่องย่อละคร '.$drama['t'];


_::$meta['image']='http://s3.boxza.com/drama/'.$drama['fd'].'/t.jpg';
_::$meta['type']='article';

//_::time();

if(!$drama['ds'])
{
	$drama['ds']=$drama['da'];
}
$relate=$db->find('drama',array('_id'=>array('$ne'=>$drama['_id']),'c'=>$drama['c'],'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>6));

$poster=_::user()->profile($drama['u']);
if($poster['google'])
{
	_::$meta['google']=$poster['google'];
}


$template->assign('c',$drama['c']);
$template->assign('user',$poster);
$template->assign('drama',$drama);
$template->assign('relate',$relate);
_::$content=$template->fetch('view');
?>