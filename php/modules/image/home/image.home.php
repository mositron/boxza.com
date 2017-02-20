<?php
/*
_::$meta['title'] = 'ผลบอล ข่าวฟุตบอล วิเคราะห์บอล ผลบอลสด ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางการแข่งขัน บอลวันนี้ ติดตามข่าวสารเกี่ยวกับฟุตบอล';
_::$meta['description'] = 'ฟุตบอล ข่าวฟุตบอล ผลบอล ผลบอลสด วิเคราะห์บอล ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางคะแนน ตารางการแข่งขัน ฟุตบอลไทย พรีเมียร์ลีก ';
_::$meta['keywords'] = 'ฟุตบอล, ข่าวฟุตบอล, ผลบอล, ไฮไลท์ฟุตบอล, โปรแกรมฟุตบอล, วิเคราะห์บอล, ผลบอลสด, ตารางคะแนน, เซียนบอล';
*/
//_::$meta['google']=array('id'=>'112235668332689047152');
if(isset($_FILES['file_post']))
{
	require_once(__DIR__.'/image.home.post.php');
}

_::ajax()->register('sendreport','home');

#if(!_::$content=$cache->get('ca1','boyz_home'))
#{
	$template->assign('image',_::db()->find('image',array('dd'=>array('$exists'=>false)),array('_id'=>1,'ty'=>1,'fd'=>1,'f'=>1),array('sort'=>array('_id'=>-1),'limit'=>100)));
	_::$content=$template->fetch('home');


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