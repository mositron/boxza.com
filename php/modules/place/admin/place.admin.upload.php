<?php

$db=_::db();
if(!$place=$db->findone('place',array('_id'=>intval(_::$path[1]),'dd'=>array('$exists'=>false))))
{
	exit;
//	_::move('/');
}
if(!$place['fd'])
{
	$fd = _::folder()->fd($place['_id']);
	$place['fd'] =  substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	$db->update('place',array('_id'=>$place['_id']),array('$set'=>array('fd'=>$place['fd'])));
}
define('AFILE','place/'.$place['fd'].'/');
	
_::ajax()->register(array('delattach'));


if($_FILES)
{
	$status =array('status'=>'FAIL','message'=>'not found');
	if($_FILES['photo']['tmp_name'])
	{
		$size=@getimagesize($_FILES['photo']['tmp_name']);
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
			if($size[0]<1||$size[1]<1)
			{
			}
			else
			{
				$q=_::upload()->send('s3','upload','@'.$_FILES['photo']['tmp_name'],array('name'=>time(),'folder'=>'place/'.$place['fd'],'width'=>600,'height'=>1000,'fix'=>'inboth','type'=>'jpg'));
				//_::photo()->thumb(time(),$_FILES['photo']['tmp_name'],'place/'.$place['fd'],600,1000,'inboth','jpg');
			}
		}	
	}
}



$template=_::template();

$file=array();
$q=_::upload()->send('s3','place-list',$place['fd']);
if($q['status']=='OK')
{
	$file=$q['data'];
}

$template->assign('place',$place);
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