<?php


$cache=_::cache();
if(!$data=$cache->get('ca1','news_view_'.intval(_::$path[0])))
{
	$db=_::db();
	if(!$news=$db->findone('news',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'c'=>1,'cs'=>1,'cs2'=>1,'t'=>1,'sm'=>1,'d'=>1,'rf'=>1,'u'=>1,'exl'=>1,'url'=>1,'da'=>1,'do'=>1,'tags'=>1,'ds'=>1,'fd'=>1)))
	{
		_::move('/');
	}
	
	////$byuser=$db->find('news',array('_id'=>array('$ne'=>$news['_id']),'u'=>$news['u'],'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$relate=$db->find('news',array('_id'=>array('$ne'=>$news['_id']),'c'=>$news['c'],'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1),array('sort'=>array('_id'=>-1),'limit'=>6));
	
	$poster=_::user()->profile($news['u']);
	
	$cache->set('ca1','news_view_'.intval(_::$path[0]),array('news'=>$news,/*'byuser'=>$byuser,*/'relate'=>$relate,'poster'=>$poster),false,300);
}
else
{
	$news = $data['news'];
	////$byuser= $data['byuser'];
	$relate = $data['relate'];
	$poster = $data['poster'];	
}



if($news['exl'])
{
	_::move($news['url'],true);
}

if(isset($cate[$news['c']]['sl']))
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
$ctitle[]=$cate[$news['c']]['t'];
if($news['cs'])
{
	$ctitle[]=$cate[$news['c']]['s'][$news['cs']]['t'];
	if($news['cs2'])
	{
		$ctitle[]=$cate[$news['c']]['s'][$news['cs']]['s'][$news['cs2']]['t'];
	}
}
_::$meta['title']=$news['t'].' - ข่าว '.implode(' ',$ctitle).' ข่าวล่าสุด ข่าววันนี้ ';
_::$meta['description']=$news['t'].' - ข่าว '.implode(' ',$ctitle).' ข่าวล่าสุด ข่าววันนี้ ข่าวด่วน ข่าวเด่น';
_::$meta['keywords']=implode(', ',$ctitle).', ข่าว, ล่าสุด, วันนี้, ข่าวล่าสุด, ข่าววันนี้';
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


$template->assign('c',$news['c']);
$template->assign('user',$poster);
$template->assign('news',$news);
$template->assign('relate',$relate);
//$template->assign('byuser',$byuser);
_::$content=$template->fetch('view');
?>