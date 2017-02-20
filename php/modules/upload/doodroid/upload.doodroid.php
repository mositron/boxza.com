<?php


$error=false;
$status =array('status'=>'FAIL','message'=>'รหัสไม่ถูกต้อง');


if($_POST['key']==md5($_POST['method'].'-'.$_POST['data']))
{
	if(in_array(MODULE_LINK,array('doodroid')))
	{	
		$photo=_::photo();
		$photo->folder=dirname(dirname(ROOT)).'/doodroid.com/files/';
	
		$folder=_::folder();
		$folder->folder=$photo->folder;
		define('UPLOAD_FOLDER','upload-'.MODULE_LINK.'/');
		define('UPLOAD_PATH',$photo->folder.UPLOAD_FOLDER);
			
		$status['message']='ข้อมูลไม่ถูกต้อง';
		switch($_POST['method'])
		{
			case 'copy':
			case 'delete':
			case 'fromstring':
			case 'getsize':
			case 'rotate':
			case 'upload':
			case 'thumb':
			
			case 'news-post':
			case 'news-list':
			
			case 'spec-post':
			case 'spec-list':
			
			case 'watermark':
				$_POST['data']=json_decode($_POST['data'],true);
				require_once(__DIR__.'/upload.doodroid.'.$_POST['method'].'.php');
				break;
		}
	}
	else
	{
		$error = 'ไม่มี server';
	}
}
if($error)
{
	$status['message']=$error;
}


header('Content-type: application/json');
echo json_encode($status);
exit;
?>