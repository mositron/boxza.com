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
			
			
$arg=array(
						't'=>mb_substr(trim($_POST['title']),0,100,'utf-8'),
						'd'=>trim($_POST['detail']),
						'pl'=>($_POST['publish']?1:0),
						'c'=>(array)$_POST['cate'],
						'pr'=>$_POST['promote']?1:0,
						'du'=>new mongodate()
);


$arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['d']);
# add title to image(alt)
$arg['d']=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?boxza.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2boxza.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$arg['d']);
# add title to image(alt)
$arg['d']=preg_replace('/\<img([^\>]*)title="([^"]*)"([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?boxza.com\/([^"]*)"([^\>]*)\>/i','<img\1title="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\3src="http://\4boxza.com/\5"\6>',$arg['d']);


$arg['place']=array_filter(array_map('intval',(array)$_POST['place']));
$arg['people']=array_filter(array_map('intval',(array)$_POST['people']));
if(is_array($_POST['tags']))
{
	$arg['tags']=array_filter(array_unique(array_map('trim',$_POST['tags'])));
}
else
{
	$arg['tags']=array_filter(array_unique(array_map('trim',explode(',',strip_tags($_POST['tags'])))));
}
if($_POST['link'])
{
	$link=_::format()->link($_POST['link']);
	if(!$link)	
	{
		$error['link']='ลิ้งค์ไม่ถูกต้อง';
	}
	elseif($db->findone('about',array('lk'=>$link,'_id'=>array('$ne'=>$about['_id']))))
	{
		$error['link']='มีลิ้งค์หน้านี้อยู่แล้ว';
	}
	else
	{
		$arg['lk']=$link;	
	}
}

if(!count($error))
{
	if(!$about['fd'])
	{
		$fd = _::folder()->fd($about['_id']);
		$about['fd'] = $arg['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	}
	
	if($arg['pr']&&$arg['pl'])
	{
		//$db->update('about',array('pr'=>1),array('$set'=>array('pr'=>0)),array('multiple'=>true));	
	}
	
	$db->update('about',array('_id'=>$about['_id']),array('$set'=>$arg));
	
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
					_::upload()->send('s3','about-post','@'.$f,array('folder'=>$about['fd']));
				}
		}
	}
	
	_::cache()->delete('ca1','about_home',0);
	_::move('/admin/'.$about['_id'].'?completed');
}
?>