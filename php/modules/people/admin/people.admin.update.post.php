<?php

/*


https://instagram.com/oauth/authorize/?client_id=e6bf31079dc64528ad6798861785e1a1&response_type=code&redirect_uri=http://boxza.com


http://boxza.com/?code=7936f55f01b24dee8b82ea71cb668191


https://api.instagram.com/oauth/access_token?client_id=e6bf31079dc64528ad6798861785e1a1&client_secret=65e30d52b1c241d1a8b4d47b62ac686a&grant_type=authorization_code&redirect_uri=http://boxza.com


client_id=CLIENT-ID' \
    -F 'client_secret=CLIENT-SECRET' \
    -F 'grant_type=authorization_code' \
    -F 'redirect_uri=YOUR-REDIRECT-URI
	
*/

$arg=array(
						'fn'=>mb_substr(trim($_POST['first']),0,100,'utf-8'),
						'ln'=>mb_substr(trim($_POST['last']),0,100,'utf-8'),
						'nn'=>mb_substr(trim($_POST['nick']),0,100,'utf-8'),
						'n'=>mb_substr(trim($_POST['name']),0,100,'utf-8'),
						'h'=>intval($_POST['height']),
						'w'=>intval($_POST['weight']),
						'rs'=>trim($_POST['result']),
						'edu'=>trim($_POST['edu']),
						'bd'=>array(intval($_POST['day']),intval($_POST['month']),intval($_POST['year'])),
						'gd'=>intval($_POST['gender']),
						'pl'=>($_POST['publish']?1:0),
						'ps'=>(array)$_POST['position'],
						'pr'=>$_POST['promote']?1:0,
						'tw'=>mb_substr(trim($_POST['twitter']),0,100,'utf-8'),
						'fb'=>mb_substr(trim($_POST['facebook']),0,100,'utf-8'),
						'ct'=>(array)$_POST['country'],
						'du'=>new mongodate()
);


if(isset($_POST['instagram']))
{
	$ins=mb_substr(mb_strtolower(trim($_POST['instagram']),'utf-8'),0,100,'utf-8');
	
	if($people['in']!=$ins)
	{
		if($ins)
		{
			$tmp=_::http()->get('https://api.instagram.com/v1/users/search?q='.$ins.'&client_id='._::$config['social']['instagram']['appid']);
			$data=json_decode($tmp,true);
			if($data['data'])
			{
				$tmp=$data['data'];
				for($i=0;$i<count($tmp);$i++)
				{
					if($ins==$tmp[$i]['username'])
					{
						$arg['in']=$ins;
						$arg['in_id']=$tmp[$i]['id'];	
						break;	
					}
				}
			}
		}
		else
		{
			$arg['in']='';
			$arg['in_id']='';
		}
	}
}

if(!count($error))
{
	if(!$people['fd'])
	{
		$fd = _::folder()->fd($people['_id']);
		$people['fd'] = $arg['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	}
	
	if($arg['pr']&&$arg['pl'])
	{
		$db->update('people',array('pr'=>1),array('$set'=>array('pr'=>0)),array('multiple'=>true));	
	}
	
	if($arg['pl']&&!$people['lk'])
	{
		$format=_::format();
		$arg['lk']=$format->link($arg['fn']).'_'.$format->link($arg['ln']);
	}
	
	$db->update('people',array('_id'=>$people['_id']),array('$set'=>$arg));
	
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
					_::upload()->send('s3','people-post','@'.$f,array('folder'=>$people['fd']));
				}
		}
	}
	
	_::cache()->delete('ca1','people_home',0);
	_::move('/admin/'.$people['_id'].'?completed');
}
?>