<?php


$error=false;
$status =array('status'=>'FAIL','message'=>'รหัสไม่ถูกต้อง');


if($_POST['key']==md5($_POST['method'].'-'.$_POST['data']))
{
	if(in_array(MODULE_LINK,array('boxzaracing')))
	{	
		$photo=_::photo();
		$photo->folder=dirname(dirname(ROOT)).'/boxzaracing.com/files/';
	
		$folder=_::folder();
		$folder->folder=$photo->folder;
		define('UPLOAD_FOLDER','upload-'.MODULE_LINK.'/');
		define('UPLOAD_PATH',$photo->folder.UPLOAD_FOLDER);
			
		$status['message']='ข้อมูลไม่ถูกต้อง';
		switch($_POST['method'])
		{
			case 'banner-upload':
			
			case 'copy':
			case 'delete':
			case 'fromstring':
			case 'getsize':
			case 'rotate':
			case 'upload':
			case 'thumb':
			
			case 'news-post':
			case 'news-list':
			case 'news-gallery':
			case 'news-delete':
			case 'news-event':
			case 'news-cover':
			
			case 'page-post':
			case 'page-list':
			case 'page-gallery':
			case 'page-delete':
			case 'page-event':
			case 'page-cover':
			
			case 'guide-post':
			case 'guide-list':
			case 'guide-cover':
			
			case 'wallpaper-post':
			
			case 'site-post':
			case 'site-list':
			case 'site-gallery':
			case 'site-delete':
			case 'site-event':
			case 'site-cover':

			case 'market-post':
			case 'market-delete':
			
			case 'watermark':
				$_POST['data']=json_decode($_POST['data'],true);
				require_once(__DIR__.'/upload.boxzaracing.'.$_POST['method'].'.php');
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