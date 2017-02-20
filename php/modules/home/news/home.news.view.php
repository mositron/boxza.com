<?php

$cache=_::cache();
if(!$data=$cache->get('ca1','news_view_'.intval(_::$path[0])))
{
	$db=_::db();
	if(!$news=$db->findone('news',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'c'=>1,'cs'=>1,'cs2'=>1,'t'=>1,'sm'=>1,'d'=>1,'rf'=>1,'u'=>1,'exl'=>1,'url'=>1,'da'=>1,'do'=>1,'tags'=>1,'ds'=>1,'fd'=>1)))
	{
		_::move('/');
	}

	//$byuser=$db->find('news',array('_id'=>array('$ne'=>$news['_id']),'u'=>$news['u'],'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$relate=$db->find('news',array('_id'=>array('$ne'=>$news['_id']),'c'=>$news['c'],'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>6));

	$poster=_::user()->profile($news['u']);
	
	$cache->set('ca1','news_view_'.intval(_::$path[0]),array('news'=>$news,/*'byuser'=>$byuser,*/'relate'=>$relate,'poster'=>$poster),false,300);
}
else
{
	$news = $data['news'];
	//$byuser= $data['byuser'];
	$relate = $data['relate'];
	$poster = $data['poster'];	
}


if($news['exl'])
{
	_::move($news['url'],true);
}

if(!isset($rlink[$news['cs']]))
{
	_::move('/',true);	
}
if(MODULE_LINK!=$rlink[$news['cs']])
{
	_::move('/'.$rlink[$news['cs']].'/'.$news['_id'],true);
}

if(!_::$my || !_::$my['am'])
{
	 if(stripos($_SERVER['HTTP_USER_AGENT'], 'bot') === false )
	 {
		_::db()->update('news',array('_id'=>$news['_id']),array('$inc'=>array('do'=>1)));
	 }
	if($_SERVER['HTTP_REFERER'])
	{
		$p=parse_url($_SERVER['HTTP_REFERER']);
		parse_str($p[ 'query' ],$s);
		if(($qtxt = str_replace(array('.','$'),array('#DOT#','#DOLLAR#'),trim(strval($s['q'])))) &&strpos($p['host'],'google.co')>-1)
		{
			_::db()->update('news',array('_id'=>$news['_id']),array('$inc'=>array('google.'.$qtxt=>1)));
		}
	}
}

$ctitle=(array)$news['tags'];
$ctitle[]='แบบบ้าน';
if($news['cs'])
{
	$ctitle[]=$cate[$news['cs']]['t'];
	if($news['cs2'])
	{
		$ctitle[]=$cate[$news['cs']]['s'][$news['cs2']]['t'];
	}
}
_::$meta['title']=$news['t'].' - '.implode(' ',$ctitle).' ตกแต่งบ้าน ออกแบบบ้าน บ้านและสวน จัดสวน';
_::$meta['description']=$news['t'].' - '.implode(' ',$ctitle).' แบบบ้านสวยๆ  บ้านและสวน ฮวงจุ้ยบ้าน แต่งบ้าน จัดสวน แบบห้องนอน ฮวงจุ้ยห้องนอน ห้องน้ำ ตกแต่งห้องครัว ห้องนั่งเล่น';
_::$meta['keywords']=implode(', ',$ctitle).', บ้าน, ตกแต่งบ้าน, ออกแบบบ้าน, บ้านและสวน, จัดบ้าน, จัดสวน, ห้องนอน, ห้องรับแขก, ห้องน้ำ, ห้องครัว';
_::$meta['image']='http://s3.boxza.com/news/'.$news['fd'].'/m.jpg';
_::$meta['type']='article';


if(!$news['ds'])
{
	$news['ds']=$news['da'];
}

if($poster['google'])
{
	_::$meta['google']=$poster['google'];
}

$template->assign('c',$news['cs']);
$template->assign('user',$poster);
$template->assign('news',$news);
$template->assign('relate',$relate);
//$template->assign('byuser',$byuser);
_::$content=$template->fetch('news.view');
?>