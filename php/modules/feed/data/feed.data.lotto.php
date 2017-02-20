<?php

$select=count($cate);

if($select==0)
{	// overview : last update;
	$db=_::db();
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('da'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>22),array('ds'=>1),array('sort'=>array('_id'=>-1),'limit'=>1));
	$set=$db->find('lotto_set',array(),array('da'=>1),array('sort'=>array('_id'=>-1),'limit'=>1));
	
	_::$content=json_encode(array('type'=>'lotto','category'=>array(),'updated'=>date('r'),'format'=>$format,'data'=>array(
																																																							'news'=>array('lastupdate'=>$news[0]['ds']->sec),
																																																							'lotto'=>array('lastupdate'=>$lotto[0]['da']->sec),
																																																							'set'=>array('lastupdate'=>$set[0]['da']->sec)
		)));
	
	
}
elseif($cate[0]==1)
{	// list/view : lottery 1
	if($cate[1])
	{	// view : id
		
	}
	else
	{	// list
			
	}
}
elseif($cate[0]==2)
{	// list : lottery 2
	
}

/*
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
	$cache->set('ca1',$key,_::$content,false,900);
}
*/

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