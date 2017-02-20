<?php

$types=array(
						'news'=>'news',
						'forum'=>'forum',
						'video'=>'video',
						'glitter'=>'glitter',
						'lotto'=>'lotto',
);
$formats=array(
						''=>'json',
						'json'=>'json',
						'xml'=>'xml',
						'rss'=>'rss',
						'iframe'=>'iframe'
);

$serv=explode('-',_::$path[0]);
if(isset($types[$serv[0]]))
{
	$type=$types[$serv[0]];
	array_shift($serv);
	$cate=array();
	foreach($serv as $v)
	{
		if($cid=intval($v))
		{
			$cate[]=$cid;	
		}
	}
	$cate=array_unique($cate);
	if(isset($formats[_::$path[1]]))
	{
		$format=$formats[_::$path[1]];
		$key=_::$type.'_'.$type.'_'.join('_',$cate).'_'.$format;
	}
	else
	{
		_::move('/',true);
	}
	require_once(__DIR__.'/feed.data.'.$type.'.php');
}
else
{
	_::move('/',true);	
}

?>