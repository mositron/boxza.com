<?php
list($id,$link)=explode('-',_::$path[0],2);

$db=_::db();
if(!$game=$db->findone('game',array('_id'=>intval($id),'dd'=>array('$exists'=>false),'pl'=>1)))
{
	_::move('/flash');
}

if(_::$path[0]!=$game['_id'].'-'.$game['l'].'.html')
{
	_::move('/flash/'.$game['_id'].'-'.$game['l'].'.html');
}
_::$meta['title']=$game['t'].($game['t2']?' ('.$game['t2'].')':'').' - '._::$meta['title'];
_::$meta['image']='http://s3.boxza.com/game/flash/'.$game['fd'].'/m.jpg';

$db->update('game',array('_id'=>intval($id)),array('$set'=>array('do'=>intval($game['do'])+1)));
/*
if($game['swf'])
{
	_::$meta['video']='<meta property="og:video" content="http://s3.boxza.com/game/flash/'.$game['fd'].'/'.$game['swf']['n'].'">
<meta property="og:video:type" content="application/x-shockwave-flash">
<meta property="og:video:width" content="'.$game['swf']['w'].'">
<meta property="og:video:height" content="'.$game['swf']['h'].'">
';
}*/

if(is_array($game['c']))
{
	$or=array();
	foreach($game['c'] as $v)
	{
		$or[]=array('c'=>$v);
	}
	if($flash=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1,'$or'=>$or),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>60)))
	{
		shuffle($flash);
		$flash=array_slice($flash,0,12);
	}
}
$c=$game['c'][0]?$game['c'][0]:0;
//_::time();
/*
if($relate=$db->find('game',array('cs'=>$game['cs'],'_id'=>array('$ne'=>$game['_id']),'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('ds'=>-1),'limit'=>20)))
{
	shuffle($relate);
	$own=array_slice($relate,0,6);
	$template->assign('relate',$relate);
}
*/
//$template->assign('p',$game['pr']);
$template->assign('c',$c);
$template->assign('game',$game);
$template->assign('flash',$flash);
_::$content=$template->fetch('flash.view');
?>