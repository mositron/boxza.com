<?php
$db=_::db();
if(!$poem=$db->findone('poem',array('_id'=>intval(VIEW_ID),'dd'=>array('$exists'=>false))))
{
	_::move('/');
}
define('poem_ID',intval($poem['_id']));

_::ajax()->register('recommend');

_::$meta['title']=$poem['t'].' - '._::$meta['title'];
_::$meta['image']='http://s3.boxza.com/poem/'.$poem['fd'].'/l.'.$poem['ty'];

$c=0;
$in=false;
if(count($poem['c']))
{
	$c=$poem['c'][0];
	$relate=$db->find('poem',array('dd'=>array('$exists'=>false),'_id'=>array('$ne'=>$poem['_id']),'c'=>array('$in'=>$poem['c'])),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('_id'=>-1),'limit'=>80));
}
else
{
		$relate=$db->find('poem',array('dd'=>array('$exists'=>false),'_id'=>array('$ne'=>$poem['_id'])),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('_id'=>-1),'limit'=>80));
}
shuffle($relate);
$relate=array_slice(array_values($relate),0,52);



$poster=_::user()->profile($poem['u']);
if($poster['google'])
{
	_::$meta['google']=$poster['google'];
}
	
	
$template->assign('relate',$relate);
$template->assign('poem',$poem);
$template->assign('c',$c);
$template->assign('user',$poster);
_::$content=$template->fetch('view');

function recommend()
{
	if(_::$my['am'])
	{
		_::db()->update('poem',array('_id'=>poem_ID),array('$set'=>array('rc'=>new MongoDate())));
		_::cache()->delete('ca1','poem_home',0);
		_::ajax()->alert('ตั้งเป็นกลิตเตอร์แนะนำเรียบร้อยแล้ว');
	}
}
?>