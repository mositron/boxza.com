<?php

define('HIDE_SIDEBAR',1);

list($id,$link)=explode('-',_::$path[0],2);

$db=_::db();
if(!$movie=$db->findone('movie',array('_id'=>intval($id),'dd'=>array('$exists'=>false),'pl'=>1)))
{
	_::move('/');
}

if(_::$path[0]!=$movie['_id'].'-'.$movie['l'].'.html')
{
	_::move('/'.$movie['_id'].'-'.$movie['l'].'.html');
}
_::$meta['title']=$movie['t'].($movie['t2']?' ('.$movie['t2'].')':'').' - '._::$meta['title'];
_::$meta['description']=$movie['t'].($movie['t2']?' ('.$movie['t2'].')':'').' - '._::$meta['description'];
_::$meta['image']='http://s3.boxza.com/movie/'.$movie['fd'].'/m.jpg';
_::$meta['type']='article';

if(count($movie['v'])&&$movie['v'][0]['yt'])
{
	_::$meta['video']='<meta property="og:video" content="http://www.youtube.com/v/'.$movie['v'][0]['yt'].'?autoplay=1&amp;autohide=1">
<meta property="og:video:type" content="application/x-shockwave-flash">
<meta property="og:video:width" content="678">
<meta property="og:video:height" content="381">
';
}
$c=$movie['c'][0]?$movie['c'][0]:0;
//_::time();


if($movie['u'])
{
	$poster=_::user()->profile($movie['u']);
	if($poster['google'])
	{
		_::$meta['google']=$poster['google'];
	}
}


$tm = strtotime(date('Y-m-d'));
$show=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm),'$gte'=>new MongoDate($tm-(3600*24*7*4)))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'c'=>1),array('sort'=>array('cs'=>-1,'tm'=>-1),'limit'=>5));
$soon=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$gt'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'c'=>1),array('sort'=>array('cs'=>-1,'tm'=>1),'limit'=>5));
$template->assign('show',$show);
$template->assign('soon',$soon);

	
$template->assign('c',$c);
$template->assign('movie',$movie);
_::$content=$template->fetch('view');
?>