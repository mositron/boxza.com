<?php
$db=_::db();
if(!$glitter=$db->findone('glitter',array('_id'=>intval(VIEW_ID),'dd'=>array('$exists'=>false))))
{
	_::move('/');
}
define('GLITTER_ID',intval($glitter['_id']));

_::ajax()->register('recommend');

_::$meta['title']=$glitter['t'].' - '._::$meta['title'];
_::$meta['image']='http://s3.boxza.com/glitter/'.$glitter['fd'].'/l.'.$glitter['ty'];

$c=0;
$in=false;
if(count($glitter['c']))
{
	$c=$glitter['c'][0];
	$relate=$db->find('glitter',array('dd'=>array('$exists'=>false),'_id'=>array('$ne'=>$glitter['_id']),'c'=>array('$in'=>$glitter['c'])),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('_id'=>-1),'limit'=>80));
}
else
{
		$relate=$db->find('glitter',array('dd'=>array('$exists'=>false),'_id'=>array('$ne'=>$glitter['_id'])),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('_id'=>-1),'limit'=>80));
}
shuffle($relate);
$relate=array_slice(array_values($relate),0,52);



$poster=_::user()->profile($glitter['u']);
if($poster['google'])
{
	_::$meta['google']=$poster['google'];
}
	
	
$template->assign('relate',$relate);
$template->assign('glitter',$glitter);
$template->assign('c',$c);
$template->assign('user',$poster);
_::$content=$template->fetch('view');

function recommend()
{
	if(_::$my['am'])
	{
		_::db()->update('glitter',array('_id'=>GLITTER_ID),array('$set'=>array('rc'=>new MongoDate())));
		_::cache()->delete('ca1','glitter_home',0);
		_::ajax()->alert('ตั้งเป็นกลิตเตอร์แนะนำเรียบร้อยแล้ว');
	}
}
?>