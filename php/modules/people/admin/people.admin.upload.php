<?php

$db=_::db();
if(!$people=$db->findone('people',array('_id'=>intval(_::$path[1]),'dd'=>array('$exists'=>false))))
{
	exit;
//	_::move('/');
}
if(!$people['fd'])
{
	$fd = _::folder()->fd($people['_id']);
	$people['fd'] =  substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
	$db->update('people',array('_id'=>$people['_id']),array('$set'=>array('fd'=>$people['fd'])));
}
define('AFILE','people/'.$people['fd'].'/');
	
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
				$q=_::upload()->send('s3','upload','@'.$_FILES['photo']['tmp_name'],array('name'=>time(),'folder'=>'people/'.$people['fd'],'width'=>600,'height'=>1000,'fix'=>'inboth','type'=>'jpg'));
				//_::photo()->thumb(time(),$_FILES['photo']['tmp_name'],'people/'.$people['fd'],600,1000,'inboth','jpg');
			}
		}	
	}
}



$template=_::template();

$file=array();
$q=_::upload()->send('s3','people-list',$people['fd']);
if($q['status']=='OK')
{
	$file=$q['data'];
}

$template->assign('people',$people);
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