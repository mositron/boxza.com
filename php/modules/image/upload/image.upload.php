<?php
/*
_::$meta['title'] = 'ผลบอล ข่าวฟุตบอล วิเคราะห์บอล ผลบอลสด ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางการแข่งขัน บอลวันนี้ ติดตามข่าวสารเกี่ยวกับฟุตบอล';
_::$meta['description'] = 'ฟุตบอล ข่าวฟุตบอล ผลบอล ผลบอลสด วิเคราะห์บอล ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางคะแนน ตารางการแข่งขัน ฟุตบอลไทย พรีเมียร์ลีก ';
_::$meta['keywords'] = 'ฟุตบอล, ข่าวฟุตบอล, ผลบอล, ไฮไลท์ฟุตบอล, โปรแกรมฟุตบอล, วิเคราะห์บอล, ผลบอลสด, ตารางคะแนน, เซียนบอล';
*/
if($_GET['redirect_uri']&&isset($_POST['uphash']))
{
	require_once(__DIR__.'/image.upload.post.php');
}

#if(!_::$content=$cache->get('ca1','boyz_home'))
#{
$error='';
if(!$_GET['redirect_uri'])
{
	$error.=' - คุณยังไม่กำหนดค่า redirect_uri สำหรับการส่งค่ากลับ<br>';
}
$template->assign('error',$error);
_::$content=$template->fetch('upload');
$template->display('content.upload');
exit;

#	$cache->set('ca1','boyz_home',_::$content,false,300);
#}




function getkey()
{
	$data=array('sesimage'=>SESIMAGE,'uid'=>intval(_::$my['_id']));
	$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
	$s = strtr(base64_encode(hash_hmac('sha256', $d, $data['sesimage'].'-up-image-'.$data['uid'], true)), '+/', '-_');
	return $s.'.'.$d;
}
?>