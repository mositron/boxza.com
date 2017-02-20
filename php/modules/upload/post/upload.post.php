<?php


define('UPLOAD_FOLDER','upload-s1/');
define('UPLOAD_PATH',FILES.UPLOAD_FOLDER);


$error=false;
$status =array('status'=>'FAIL','message'=>'ข้อมูลรูปภาพไม่ถูกต้อง');


$allows=array(
									'line/photos'=>'line.photos',
									'line/gif'=>'line.gif',
								);
$_url=trim(URL,'/');
if(!isset($allows[$_url]))
{
	$error='ปลายทางไม่ถูกต้อง';
}
elseif($_url=='line/gif')
{
	require_once(__DIR__.'/upload.post.line.gif.php');
	exit;
}
else
{
	if(!empty($_POST['session']))
	{
		list($s,$p) = explode('.', $_POST['session'], 2);
		$sig = base64_decode(strtr($s, '-_', '+/'));
		$data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);
		
		if($sig == hash_hmac('sha256', $p, $data['_id'].'-up-to-'.trim(URL,'/'), true))
		{
			_::$my=_::user()->get($data['_id'],true);
		}
	}
	else
	{
		$error='ข้อมูลการเข้าใช้งานไม่ถูกต้อง';
	}
}


if(!$error && _::$my && _::$my['st']!=-1)
{
	if($_FILES['file'])
	{
		require_once(__DIR__.'/upload.post.'.$allows[trim(URL,'/')].'.php');
	}
	else
	{
		$error='ไม่มีข้อมูลไฟล์อัพโหลด'.print_r($_FILES,true);
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