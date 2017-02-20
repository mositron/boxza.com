<?php


function checkout_nofollow($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(boxza|boxzacar|boxzaracing|doodroid|google|teededball|boxzafootball|autocar)\.(.*)$/',$arg[1]))
	{
		return 	'<a href="'.$arg[1].'" target="_blank">';
	}
	else
	{
		return 	'<a href="http://out.boxza.com/#'.base64_encode($arg[1]).'" target="_blank">';
	}
}
			
$db=_::db();

$error=array();
$arg=array();
$arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));

/*
# add title to image(alt)
$arg['sm']=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?boxza.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2boxza.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$arg['sm']);
# add title to image(alt)
$arg['sm']=preg_replace('/\<img([^\>]*)title="([^"]*)"([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?boxza.com\/([^"]*)"([^\>]*)\>/i','<img\1title="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\3src="http://\4boxza.com/\5"\6>',$arg['sm']);
*/

//$arg['s']=trim(mb_substr(strip_tags($_POST['summary']),0,500,'utf-8'));
//$arg['sm']=trim(mb_substr(strip_tags($_POST['summary']),0,1000,'utf-8'));
//$arg['sm']=stripslashes(trim($_POST['summary']));
//$arg['sm']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['sm']);

$arg['sm']='';
$arg['d']=stripslashes(trim($_POST['detail']));
if($_POST['summary'])
{
	$arg['d']=stripslashes(trim($_POST['summary'])).$arg['d'];
}
$arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['d']);
# add title to image(alt)
$arg['d']=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?boxza.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2boxza.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$arg['d']);
# add title to image(alt)
$arg['d']=preg_replace('/\<img([^\>]*)title="([^"]*)"([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?boxza.com\/([^"]*)"([^\>]*)\>/i','<img\1title="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\3src="http://\4boxza.com/\5"\6>',$arg['d']);
$_cs=explode('_',trim($_POST['cate']));
$arg['c']=intval($_cs[0]);
$arg['cs']=intval($_cs[1]);
$arg['cs2']=intval($_cs[2]);

$arg['url']=mb_strtolower(trim($_POST['url']),'utf-8');
$arg['exl']=intval($_POST['exlink']);
if((mb_substr($arg['url'],0,7,'utf-8')!='http://')&&$arg['exl'])
{
	$arg['exl']=0;
}
$arg['place']=array_filter(array_map('intval',(array)$_POST['place']));
$arg['people']=array_filter(array_map('intval',(array)$_POST['people']));

if(isset($_POST['team']))
{
	$arg['team']=array_filter(array_map('intval',(array)$_POST['team']));
}

if(_::$my['am'])
{
	$arg['pl']=($_POST['publish']?1:0);
	$arg['rc']=($_POST['recommend']?1:0);
	$arg['wt']=0;
}
elseif(isset($_POST['waiting']))
{
	$arg['wt']=($_POST['waiting']?1:0);
}

if(!$arg['t'])
{
	$error['title']='กรุณากรอกชื่อข่าว';
}

if(!$arg['exl'])
{
	/*
	$sm=str_replace(array('&nbsp;',' '),array('',''),strip_tags($_POST['summary']));
	if(preg_match('/\<img([^\>]*)/i',$arg['sm']))
	{
		$error['summary']='ห้ามใส่รูปในเกริ่นนำ';	
	}
	elseif(mb_strlen($sm,'utf-8')<150)
	{
		$error['summary']='เกริ่นนำสั้นเกินไป อย่างน้อย 150 ตัวอักษร';
	}
	*/
}

if((!$arg['d'])&&(!$arg['exl']))
{
	$error['detail']='กรุณากรอกรายละเอียดข่าว';
}
elseif(mb_stripos($arg['d'],'kapook.com',0,'utf-8')>-1)
{
	$error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก kapook.com';
	$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('pl'=>0)));
}
elseif(mb_stripos($arg['d'],'sanook.com',0,'utf-8')>-1)
{
	$error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก sanook.com';
	$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('pl'=>0)));
}
if(!isset($cate[$arg['c']]))
{
	$error['category']='กรุณาเลือกชนิดของข่าว';	
}

if(!count($error))
{
	
	if($arg['pl']&&!$news['ds'])
	{
		$arg['ds']=new MongoDate();
		$key='chatroom_data_1';
		$cache=_::cache();
		if($data=$cache->get('ca2',$key))
		{
			if(is_array($data['text']))
			{
				$time=microtime(true);
				$al=array(
											'ty'=>'ms',
											'u'=>_::$my['_id'],
											'_id'=>$time,
											'_sn'=>str_replace('.','_',strval($time)),
											't'=>date('H:i',$time),
											'p'=>'',
											'm'=>'เขียนข่าวใหม่: "<a href="http://news.boxza.com/view/'.$news['_id'].'" target="_blank">'.$arg['t'].'</a>"',
											'mb'=>1,
											'c'=>21,
											'n'=>_::$my['cname'],
											'l'=>_::$my['link'],
											'i'=>_::$my['img'],
											'am'=>0,
											'ip'=>$_SERVER['REMOTE_ADDR'],
											'rk'=>(_::$my['pet']?intval(_::$my['pet']['ty']):0),
											'vid'=>'',
										);
				
				array_push($data['text'],$al);
				$cache->set('ca2',$key,$data,false,3600*24*7);
			}
		}
	}

	if(is_array($arg['people']))
	{
		foreach($arg['people'] as $v)
		{
			if($v&&!in_array($v,(array)$news['people']))
			{
				$db->update('people',array('_id'=>intval($v)),array('$set'=>array('dn'=>new mongodate())));
			}
		}
	}

	if(!$news['fd'])
	{
		$fd = _::folder()->fd($news['_id']);
		$news['fd'] = $arg['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	}
	$db->update('news',array('_id'=>$news['_id']),array('$set'=>$arg));
	
	$photo=_::photo();
	
	if($f=$_FILES['o']['tmp_name'])
	{
		$size=@getimagesize($f);
		switch (strtolower($size['mime']))
		{
			case 'image/gif':
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/bmp':
			case 'image/wbmp':
			case 'image/png':
			case 'image/x-png':
				if($size[0]>=100 && $size[1]>=100)
				{
					$q=_::upload()->send('s3','news-post','@'.$f,array('folder'=>$news['fd']));
					if($q['status']=='OK')
					{
						$news['img']=$q['data']['n'];
						$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('img'=>$q['data']['n'])));
					}
				}
		}
	}
	
	if($f=$_FILES['o2']['tmp_name'])
	{
		$size=@getimagesize($f);
		switch (strtolower($size['mime']))
		{
			case 'image/gif':
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/bmp':
			case 'image/wbmp':
			case 'image/png':
			case 'image/x-png':
				if($size[0]>=100 && $size[1]>=100)
				{
					$q=_::upload()->send('s3','news-facebook','@'.$f,array('folder'=>$news['fd']));
					if($q['status']=='OK')
					{
						$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('fbi'=>$q['data']['n'])));
					}
				}
		}
	}

	//if($arg['pl'])
	//{
		$news['c']=$arg['c'];
		$news['cs']=$arg['cs'];
	//}
	if(!$news['img'])
	{
		if($arg['pl'])
		{
			$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('pl'=>0)));
			_::move('/admin/'.$news['_id'].'?no-image');
		}
	}
	_::tags()->update($_POST['tags'], 'news', $news['_id'],$arg['t'],$arg['d'],link::news($news),'http://s3.boxza.com/news/'.$news['fd'].'/s.jpg',intval($arg['c']),$news['da']);
	_::cache()->delete('ca1','news_home',0);
	_::cache()->delete('ca1','home',0);
	_::move('/admin/'.$news['_id'].'?completed');
}
else
{
	$news=array_merge($news,$arg);
}
?>