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

if($news['cs']&&!isset($rlink[$news['cs']]))
{
	_::move(link::news($news),true);
}
if(MODULE_LINK!=$rlink[$news['cs']])
{
	_::move(link::news($news),true);
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
$ctitle[]='เกมส์';
if($news['cs'])
{
	$ctitle[]=$cate[$news['cs']]['t'];
	if($news['cs2'])
	{
		$ctitle[]=$cate[$news['cs']]['s'][$news['cs2']]['t'];
	}
}
_::$meta['title']=$news['t'].' - '.implode(' ',$ctitle).' เกม ข่าวเกมส์ เล่นเกม ข่าวเกมส์ล่าสุด ข่าวเกมส์วันนี้';
_::$meta['description']=$news['t'].' - '.implode(' ',$ctitle).' เกม ข่าวเกมส์ เล่นเกม ข่าวเกมส์ล่าสุด ข่าวเกมส์วันนี้ เกมส์ทําอาหาร เกมส์แต่งตัว เกมส์จับคู่ เกมส์ต่อสู้ เกมส์รถแข่ง เกมส์แข่งรถ เกมส์เต้น';
_::$meta['keywords']=implode(', ',$ctitle).', เกม, ข่าวเกมส์, เกมส์วันนี้, เกมส์ล่าสุด, เล่นเกม, เกมส์ทําอาหาร, เกมส์แต่งตัว, เกมส์จับคู่, เกมส์ต่อสู้, เกมส์รถแข่ง, เกมส์แข่งรถ, เกมส์เต้น';
_::$meta['image']='http://s3.boxza.com/news/'.$news['fd'].'/m.jpg';
_::$meta['type']='article';

if(!$news['ds'])
{
	$news['ds']=$news['da'];
}

if($user['google'])
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