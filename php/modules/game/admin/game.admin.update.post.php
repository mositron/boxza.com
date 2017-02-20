<?php
_::session()->logged();
$db=_::db();

$error=array();

$_POST['title']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
$_POST['title2']=trim(mb_substr(strip_tags($_POST['title2']),0,100,'utf-8'));
$_POST['detail']=trim(mb_substr(strip_tags($_POST['detail']),0,3000,'utf-8'));
$_POST['howto']=trim(mb_substr(strip_tags($_POST['howto']),0,3000,'utf-8'));
$_POST['category']=array_map('trim',(array)$_POST['category']);

if(mb_strlen($_POST['title'],'utf-8')<1)
{
	$error['title']='กรุณากรอกชื่อเกมส์';
}
if(mb_strlen($_POST['detail'],'utf-8')<1)
{
	$error['detail']='กรุณากรอกรายละเอียดเกมส์';
}
if(mb_strlen($_POST['howto'],'utf-8')<1)
{
	$error['howto']='กรุณากรอกวิธีการเล่นเกมส์';
}
if(!count($error))
{
	$link=_::format()->link(strtolower($_POST['title']));
	if(!$link)$link=$_POST['type'];
	$arg=array(
								't'=>$_POST['title'],
								't2'=>$_POST['title2'],
								'l'=>$link,
								'c'=>$_POST['category'],
								'd'=>$_POST['detail'],
								'h'=>$_POST['howto'],
								'pl'=>$_POST['publish']?1:0,
								'rc'=>intval($_POST['recommend']),
							);
	if(!$game['fd'])
	{
		$fd = _::folder()->fd($game['_id']);
		$game['fd'] = $arg['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	}
	$db->update('game',array('_id'=>$game['_id']),array('$set'=>$arg));
	
	$photo=_::photo();
	
	for($i=2;$i<=5;$i++)
	{
		if($_POST['del_o'.$i])
		{
			if($game['o'.$i] && $game['fd'])
			{
				_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/'.$game['o'.$i]);
				$db->update('game',array('_id'=>$game['_id']),array('$unset'=>array('o'.$i => 1)));
			}
		}
	}
	for($i=1;$i<=5;$i++)
	{		
		$o='';
		$s='';
		if($f=$_FILES['o'.$i]['tmp_name'])
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
						$q=_::upload()->send('s3','game-post','@'.$f,array('id'=>$game['_id'],'index'=>$i,'folder'=>$game['fd']));
						//if($o=$photo->thumb($game['_id'].'-'.$i,$f,'game/'.$game['fd'],600,900,'inboth','jpg'))
						if($q['status']=='OK')
						{
							$db->update('game',array('_id'=>$game['_id']),array('$set'=>array('o'.$i => $q['data']['n'])));
						}
					}
			}
		}
	}
	
	if($f=$_FILES['swf']['tmp_name'])
	{
		$swf=_::swf($_FILES['swf']['tmp_name']);
		if($swf->isValid)
		{
			$flash=$swf->stat();
			$n=$game['_id'].'.'.rand(1,9999999).'.swf';					
			//@copy($_FILES['swf']['tmp_name'],FILES.'game/flash/'.$game['fd'].'/'.$n);
			if($game['swf']&&$game['swf']['n'])
			{
				_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/'.$game['swf']['n']);
			}
			_::upload()->send('s3','copy','@'.$_FILES['swf']['tmp_name'],array('folder'=>'game/flash/'.$game['fd'],'name'=>$n));
			$db->update('game',array('_id'=>$game['_id']),array('$set'=>array('swf'=>array(
																																																			'n'=>$n,
																																																			'w'=>intval($flash['movieSize'][0]),
																																																			'h'=>intval($flash['movieSize'][1]),
																																																			'fs'=>intval($flash['fileSize'][0]),
																																																			'fr'=>intval($flash['fileSize'][1]),
																																																			'v'=>$flash['version'],
																																																			'r'=>intval($flash['frameRate']),
																																																			'c'=>intval($flash['frameCount']),
																																																			'bg'=>(string)$flash['background']['hex']
				
			))));
			//$flash['movieSize'][0],$flash['movieSize'][1],$flash['fileSize'][0],$flash['fileSize'][1],$flash['version'],$flash['frameRate'],$flash['frameCount'],(string)$flash['background']['hex']
					
		}	
	}
	
	_::cache()->delete('ca1','game_home',0);
	header('Location: /admin/'.$game['_id'].'?completed');
	exit;
}
print_r($error);
exit;
?>