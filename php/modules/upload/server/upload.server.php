<?php


$error=false;
$status =array('status'=>'FAIL','message'=>'รหัสไม่ถูกต้อง');


if($_POST['key']==md5($_POST['method'].'-'.$_POST['data']))
{
	if(in_array(MODULE_LINK,['s1','s2','s3']))
	{
		define('UPLOAD_FOLDER','upload-'.MODULE_LINK.'/');
		define('UPLOAD_PATH',FILES.UPLOAD_FOLDER);
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
			
			case 'line-gif':
			case 'line-photo':
			case 'line-thumb':
			case 'line-remove':
			
			case 'profile-crop':
			case 'profile-gif':
			case 'profile-reset':
			case 'profile-remove':
			
			case 'image-post':
			case 'image-clear':
			
			case 'forum-post':
			
			case 'people-post':
			case 'people-list':
			case 'place-post':
			case 'place-list':
			
			case 'news-post':
			case 'news-list':
			case 'news-facebook':
			
			case 'about-post':
			case 'about-list':
			
			case 'drama-post':
			case 'drama-list':
			
			case 'deal-post':
			
			case 'game-post':
			
			case 'glitter-post':
			
			case 'movie-post':
			case 'movie-wallpaper':
			
			case 'video-post':
			
			case 'football-team':
			case 'football-banner':
			
			case 'gift-upload':
			
			case 'guess-post':
			case 'guess-answer':
			
			case 'racing-brand':
			case 'racing-spec':
			case 'racing-gen':
			
			case 'sticker-post':
			case 'sticker-pic':
			case 'sticker-del':
			case 'sticker-clean':
			
			case 'watermark':
			case 'banner-upload':
			
			case 'fbimage':
			
				$_POST['data']=json_decode($_POST['data'],true);
				require_once(__DIR__.'/upload.server.'.$_POST['method'].'.php');
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