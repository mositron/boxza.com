<?php




$cache=_::cache();

if(!_::$content=$cache->get('ca1',$key))
{
	//_::time();
	$db=_::db();
	
	$arg=array('dd'=>array('$exists'=>false));
	
	
	if(count($cate)>=1)
	{
		$in=array($cate[0]);
		
		$tmp=$db->findone('forum_cate',array('_id'=>$cate[0]),array('_id'=>1,'l'=>1,'s'=>1,'sl'=>1));
		if($tmp['l'])
		{
			$in=array_merge($in,$tmp['l']);
		}
		$arg['c']=array('$in'=>$in);
	}
	$data=array();
	if($tmp=$db->find('forum',$arg,array('_id'=>1,'t'=>1,'d'=>1,'s'=>1,'fd'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>50)))
	{
		foreach($tmp as $v)
		{
			$data[]=array(
										'guid'=>$v['_id'],
										'title'=>$v['t'],
										'description'=>mb_substr(trim(str_replace(array('&nbsp;',' '),array(' ',' '),strip_tags($v['d']))),0,150,'utf-8').'...',
										'image'=>($v['s']?'http://s3.boxza.com/forum/'.$v['fd'].'/'.$v['s']:''),
										'link'=>'http://forum.boxza.com/topic/'.$v['_id'],
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
<title>BoxZa Forum</title>
<description><![CDATA[
กระดานสนทนา รูปภาพ รูปน่ารัก รูปการ์ตูน รูปตลกขำขัน เฟสบุ๊ค หาเพื่อน
]]></description>
<copyright>boxza.com</copyright>
<language>th-th</language>
<link>http://forum.boxza.com/</link>
<lastBuildDate>'.date('r').'</lastBuildDate>
<generator>BoxZa Feed</generator>
<ttl>15</ttl>
<image>
<url>http://s0.boxza.com/static/images/global/logo.png</url>
<title>BoxZa Forum</title>
<link>http://forum.boxza.com/</link>
<description><![CDATA[
กระดานสนทนา รูปภาพ รูปน่ารัก รูปการ์ตูน รูปตลกขำขัน เฟสบุ๊ค หาเพื่อน
]]></description>
<width>82</width>
<height>82</height>
</image>
<atom:link href="'.URI.'" rel="self" type="application/rss+xml" />
';
		for($i=0;$i<count($data);$i++)
		{
			_::$content.='<item>
<title><![CDATA[
'.$data[$i]['title'].'
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