<?php




$cache=_::cache();

if(!_::$content=$cache->get('ca1',$key))
{
	//_::time();
	$db=_::db();
	
	
	$cates=array(
							'1'=>array('t'=>'แสดงอารมณ์','l'=>array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30)),
							'41'=>array('t'=>'ทักทาย','l'=>array(42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58)),
							'71'=>array('t'=>'เทศกาล','l'=>array(72,73,74,75,76,77,78,79,80,81,82,83,90)),
							'91'=>array('t'=>'อื่นๆ','l'=>array(92,93,94)),
	);
	
	$_=array('dd'=>array('$exists'=>false));
	
	$c1=0;
	$c2=0;
	$c3=0;
	if(count($cate)>=1)
	{
		$c=$cate[0];
		if($cates[$c])
		{
			$_c['c']=array('$in'=>$cates[$c]['l']);	
		}
		else
		{
			$_c['c']=$c;	
		}
	}
	$data=array();
	
	if($tmp=$db->find('glitter',$_,array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'da'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('_id'=>-1),'limit'=>50)))
	{
		foreach($tmp as $v)
		{
			$data[]=array(
										'guid'=>$v['_id'],
										'title'=>$v['t'],
										'description'=>'',
										'image'=>'http://s3.boxza.com/glitter/'.$v['fd'].'/s.'.$v['ty'],
										'link'=>'http://glitter.boxza.com/'.$v['_id'].'.html',
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
<title>BoxZa Glitter</title>
<description><![CDATA[
Glitter กลิตเตอร์ รวมรูปภาพกลิตเตอร์ หลากหลายอารมณ์ ความรู้สึก ข้อความยินดี ทักทาย อวยพร เทศกาลต่างๆ ไว้ที่นี่เพียบ.
]]></description>
<copyright>boxza.com</copyright>
<language>th-th</language>
<link>http://glitter.boxza.com/</link>
<lastBuildDate>'.date('r').'</lastBuildDate>
<generator>BoxZa Feed</generator>
<ttl>15</ttl>
<image>
<url>http://s0.boxza.com/static/images/global/logo.png</url>
<title>BoxZa Glitter</title>
<link>http://glitter.boxza.com/</link>
<description><![CDATA[
Glitter กลิตเตอร์ รวมรูปภาพกลิตเตอร์ หลากหลายอารมณ์ ความรู้สึก ข้อความยินดี ทักทาย อวยพร เทศกาลต่างๆ ไว้ที่นี่เพียบ.
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