<?php

$db=_::db();
if(!$news=$db->findone('news',array('_id'=>intval(_::$path[1]),'dd'=>array('$exists'=>false))))
{
	exit;
//	_::move('/');
}
if(!$news['fd'])
{
	$fd = _::folder()->fd($news['_id']);
	$news['fd'] =  substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	$db->update('news',array('_id'=>$news['_id']),array('$set'=>array('fd'=>$news['fd'])));
}
define('AFILE','news/'.$news['fd'].'/');
	
_::ajax()->register(array('delattach'));


if($_FILES&&is_array($_FILES['photo']['tmp_name']))
{
	for($i=0;$i<count($_FILES['photo']['tmp_name']);$i++)
	{
		if($f=$_FILES['photo']['tmp_name'][$i])
		{
			$type='';
			$size=@getimagesize($f);
			switch (strtolower($size['mime']))
			{
				case 'image/gif':
				case 'image/jpg':
				case 'image/jpeg':
				case 'image/png':
				case 'image/x-png':
				case 'image/wbmp':
				case 'image/bmp':
					$type='image';
					break;
			}
			if($type=='image')
			{
				if($size[0]>1&&$size[1]>1)
				{
					$q=_::upload()->send('s3','upload','@'.$f,array('name'=>time().'_'.($i+1),'folder'=>'news/'.$news['fd'],'width'=>600,'height'=>1000,'fix'=>'inboth','type'=>'jpg'));
					_::upload()->send('s3','watermark','news/'.$news['fd'].'/'.$q['data']['n'],array('watermark'=>'news/watermark2.png'));
					//_::photo()->thumb(time(),$f,'news/'.$news['fd'],600,1000,'inboth','jpg');
				}
			}	
		}
	}
}



$template=_::template();

$file=array();
$q=_::upload()->send('s3','news-list',$news['fd']);
if($q['status']=='OK')
{
	$file=$q['data'];
}

$template->assign('news',$news);
$template->assign('file',$file);
$template->assign('getattach',$template->fetch('admin.upload.file'));
echo $template->fetch('admin.upload');

function delattach($a)
{
	$ajax=_::ajax();
	if($a)
	{
		_::upload()->send('s3','delete',AFILE.$a);
	}
	$ajax->redirect(URL);
}
exit;
?>