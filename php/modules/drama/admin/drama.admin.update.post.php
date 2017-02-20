<?php


function checkout_nofollow($arg)
{
	if(preg_match('/^http\:\/\/([a-z0-9\.]+)?boxza\.com(.*)$/',$arg[1]))
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
$arg['sm']=trim(mb_substr(strip_tags($_POST['summary']),0,500,'utf-8'));
//$arg['s']=trim(mb_substr(strip_tags($_POST['summary']),0,500,'utf-8'));
$arg['d']=stripslashes(trim($_POST['detail']));
# remove nofollow for link to boxza.com
//$arg['d']=preg_replace('/\<a href\="http\:\/\/([a-z0-9\.]+)?boxza\.com([^"]+)"([^\>]+)?"\>/i','<a href="http://\1boxza.com\2" target="_blank">',$arg['d']);
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

$arg['tags']=array_filter(array_unique(array_map('trim',explode(',',strip_tags($_POST['tags'])))));

if(!$drama['lk'])
{
	$arg['lk']=_::format()->link($arg['t']);
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

if($arg['pl']&&!$drama['ds'])
{
	$arg['ds']=new MongoDate();
}
/*
$arg['rf']=array();
for($i=0;$i<3;$i++)
{
	if((isset($_POST['ref'][$i])&&trim($_POST['ref'][$i]))&&(isset($_POST['url'][$i])&&trim($_POST['url'][$i])))
	{
		$arg['rf'][]=array('ref'=>trim($_POST['ref'][$i]),'url'=>trim($_POST['url'][$i]));
	}
}
*/
if(!$arg['t'])
{
	$error['title']='กรุณากรอกชื่อละคร';
}
/*
if(!$arg['s'])
{
	$error['summary']='กรุณากรอกเนื้อเรื่องย่อ';
}
*/
if((!$arg['d'])&&(!$arg['exl']))
{
	$error['detail']='กรุณากรอกรายละเอียดละคร';
}
elseif(mb_stripos($arg['d'],'kapook.com',0,'utf-8')>-1)
{
	$error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก kapook.com';
	$db->update('drama',array('_id'=>$drama['_id']),array('$set'=>array('pl'=>0)));
}
elseif(mb_stripos($arg['d'],'sanook.com',0,'utf-8')>-1)
{
	$error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก sanook.com';
	$db->update('drama',array('_id'=>$drama['_id']),array('$set'=>array('pl'=>0)));
}
if(!isset($cate[$arg['c']]))
{
	$error['category']='กรุณาเลือกชนิดของละคร';	
}

if(!count($error))
{
	if(is_array($arg['people']))
	{
		foreach($arg['people'] as $v)
		{
			if($v&&!in_array($v,(array)$drama['people']))
			{
				$db->update('people',array('_id'=>intval($v)),array('$set'=>array('dn'=>new mongodate())));
			}
		}
	}

	if(!$drama['fd'])
	{
		$fd = _::folder()->fd($drama['_id']);
		$drama['fd'] = $arg['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	}
	$db->update('drama',array('_id'=>$drama['_id']),array('$set'=>$arg));
	
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
					_::upload()->send('s3','drama-post','@'.$f,array('folder'=>$drama['fd']));
				}
		}
	}

	if($arg['pl'])
	{
		$drama['c']=$arg['c'];
		$drama['cs']=$arg['cs'];
	}
	_::cache()->delete('ca1','drama_home',0);
	_::cache()->delete('ca1','home',0);
	_::move('/admin/'.$drama['_id'].'?completed');
}
?>