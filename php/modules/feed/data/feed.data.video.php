<?php




$cache=_::cache();

if(!_::$content=$cache->get('ca1',$key))
{
	//_::time();
	$db=_::db();
	
	$tmp=_::db()->find('video_cate',array(),array(),array('sort'=>array('_id'=>1)));
	$acate=array();
	$cate=array();
	for($i=0;$i<count($tmp);$i++)
	{
		$acate[$tmp[$i]['_id']]=$tmp[$i];
		$acate[$tmp[$i]['_id']]['in']=array($tmp[$i]['_id']);
		if($tmp[$i]['lv'])
		{
			if($tmp[$i]['lv']>1)
			{
				$cate[$tmp[$i]['p0']]['l'][$tmp[$i]['p1']]['l'][$tmp[$i]['_id']]=array('n'=>$tmp[$i],'l'=>array());
				$acate[$tmp[$i]['p1']]['in'][]=$tmp[$i]['_id'];
			}
			else
			{
				$cate[$tmp[$i]['p0']]['l'][$tmp[$i]['_id']]=array('n'=>$tmp[$i],'l'=>array());
			}
			$acate[$tmp[$i]['p0']]['in'][]=$tmp[$i]['_id'];
		}
		else
		{
			$cate[$tmp[$i]['_id']]=array('n'=>$tmp[$i],'l'=>array());
		}
	}
	unset($tmp);
	
	
	$_=array('dd'=>array('$exists'=>false));
	
	$c1=0;
	$c2=0;
	$c3=0;
	if(count($cate)>=1)
	{
		$c=$cate[0];
		if($cs=$acate[$c])
		{
			if($cs['lv']==2)
			{
				$c1 = $cs['p0'];
				$c2 = $cs['p1'];
				$c3 = $cs['_id'];
			}
			elseif($cs['lv']==1)
			{
				$c1 = $cs['p0'];
				$c2 = $cs['_id'];
			}
			else
			{
				$c1 = $cs['_id'];
			}
			$_['c']=array('$in'=>(array)$cs['in']);
		}
		else
		{
			unset($c);
		}
	}
	$data=array();
	if($tmp=$db->find('video',$_,array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'c'=>1,'cs'=>1,'n'=>1,'dr'=>1,'m'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>50)))
	{
		foreach($tmp as $v)
		{
			$data[]=array(
										'guid'=>$v['_id'],
										'title'=>$v['t'],
										'description'=>mb_substr(trim(str_replace(array('&nbsp;',' '),array(' ',' '),strip_tags($v['m']))),0,150,'utf-8').'...',
										'image'=>'http://s3.boxza.com/video/'.$v['f'].'/'.$v['n'],
										'link'=>'http://video.boxza.com/'.$v['_id'].'-'.$v['l'].'.html',
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
<title>BoxZa Video</title>
<description><![CDATA[
ดูหนังออนไลน์ ดูทีวีออนไลน์ ดูทีวีย้อนหลัง  คลิป วิดีโอ คลิปขำๆ ฮาๆ น่ารัก มิวสิควิดีโอ
]]></description>
<copyright>boxza.com</copyright>
<language>th-th</language>
<link>http://video.boxza.com/</link>
<lastBuildDate>'.date('r').'</lastBuildDate>
<generator>BoxZa Feed</generator>
<ttl>15</ttl>
<image>
<url>http://s0.boxza.com/static/images/global/logo.png</url>
<title>BoxZa Video</title>
<link>http://video.boxza.com/</link>
<description><![CDATA[
ดูหนังออนไลน์ ดูทีวีออนไลน์ ดูทีวีย้อนหลัง  คลิป วิดีโอ คลิปขำๆ ฮาๆ น่ารัก มิวสิควิดีโอ
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