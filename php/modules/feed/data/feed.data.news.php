<?php




$cache=_::cache();

if(!_::$content=$cache->get('ca1',$key))
{
	//_::link();
	//_::time();
	$db=_::db();
	
	$arg=array('dd'=>array('$exists'=>false),'pl'=>1);
	if(count($cate)>=1)
	{
		$arg['c']=$cate[0];
	}
	if(count($cate)>=2)
	{
		$arg['cs']=$cate[1];
	}
	
	$data=array();
	if($tmp=$db->find('news',$arg,array('_id'=>1,'t'=>1,'d'=>1,'fd'=>1,'c'=>1,'cs'=>1,'da'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>50)))
	{
		foreach($tmp as $v)	
		{
			$data[]=array(
										'guid'=>$v['_id'],
										'title'=>$v['t'],
										'description'=>mb_substr(trim(str_replace(array('&nbsp;',' '),array(' ',' '),strip_tags($v['d']))),0,150,'utf-8').'...',
										'image'=>'http://s3.boxza.com/news/'.$v['fd'].'/s.jpg',
										'link'=>link::news($v),
										'pubDate'=>date('r',$v['da']->sec)
									);
		}
	}
	if($format=='json')
	{
		_::$content=json_encode(array('type'=>'news','category'=>$cate,'updated'=>date('r'),'format'=>$format,'data'=>$data));
	}
	elseif($format=='rss'||$format=='xml')
	{
		_::$content='<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>BoxZa News</title>
<description><![CDATA[
ข่าว ข่าวเด่น ข่าวติดกระแส ข่าวบันเทิง ข่าวเกมส์ ข่าวเทคโนโลยี ข่าวภาพยนตร์ ข่าวกีฬา ข่าวไลฟ์สไตล์ ข่าวหวย อัพเดทเรื่องอินเทรนด์
]]></description>
<copyright>boxza.com</copyright>
<language>th-th</language>
<link>http://news.boxza.com/</link>
<lastBuildDate>'.date('r').'</lastBuildDate>
<generator>BoxZa Feed</generator>
<ttl>15</ttl>
<image>
<url>http://s0.boxza.com/static/images/global/logo.png</url>
<title>BoxZa News</title>
<link>http://news.boxza.com/</link>
<description><![CDATA[
ข่าว ข่าวเด่น ข่าวติดกระแส ข่าวบันเทิง ข่าวเกมส์ ข่าวเทคโนโลยี ข่าวภาพยนตร์ ข่าวกีฬา ข่าวไลฟ์สไตล์ ข่าวหวย อัพเดทเรื่องอินเทรนด์
]]></description>
<width>82</width>
<height>82</height>
</image>
<atom:link href="'.URI.'" rel="self" type="application/rss+xml" />
';
		for($i=0;$i<count($data);$i++)
		{
			_::$content.='<item>
<title><![CDATA['.$data[$i]['title'].'
]]></title>
<description><![CDATA[
'.$data[$i]['description'].'
]]></description>
<enclosure url="'.$data[$i]['image'].'" length="0" type="image/jpeg" />
<link>'.$data[$i]['link'].'</link>
<guid>'.$data[$i]['link'].'</guid>
<pubDate>'.$data[$i]['pubDate'].'</pubDate>
</item>
';
		}
		_::$content.='</channel>
</rss>';
	}
	$cache->set('ca1',$key,_::$content,false,900);
}


while(@ob_end_clean());
if($format=='json')
{
	header('Content-type: application/json');
	if(_::$path[2])
	{
		echo _::$path[2].'('._::$content.')';
	}
	else
	{
		echo _::$content;
	}
}
elseif($format=='rss'||$format=='xml')
{
	header('Content-Type: application/xml');
//	header('Content-Type: application/rss+xml; charset=utf-8');
	echo _::$content;
}
exit;

?>