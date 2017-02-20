<?php


_::$meta['title'] = _::$profile['name'].' - BoxZa โปรไฟล์ส่วนตัว';
_::$meta['description'] =  'เกี่ยวกับ '._::$profile['name'].' - '._::$meta['description'];
_::$meta['keywords'] = _::$profile['name'].', '._::$profile['if']['fn'].', '._::$profile['if']['ln'].', ประวัติ, โปรไฟล์';


if($_FILES['header']||$_FILES['avatar']||$_POST['upload_bg'])
{
	require_once(__DIR__.'/www.user.post.php');
}

_::ajax()->register(array('vote','setrec','sendgift','addpoint','setban','resetavatar','setblock','hackbywut','setverify','sethideall','buypet','sellpet','savecrop'),'user');



$template=_::template();


$pf=array(array(),array());

$pf[0]['gd']=_::$config['gender'][_::$profile['if']['gd']];
$pf[1]['gd']='<span>'.$pf[0]['gd'].'</span>';
if($rl2=_::$config['relate'][intval(_::$profile['if']['rl'])])
{
	$pf[0]['rl']=$rl2;
	$pf[1]['rl']='<span>'.$pf[0]['rl'].'</span>'; 
}
$month=array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
$d = explode('-',date('d-m-Y',_::$profile['if']['bd']->sec));
$pf[0]['bd']=$d[0].' '.$month[intval($d[1])-1].' '.intval($d[2]+543);
$pf[1]['bd']='วันเกิด <span>'.$pf[0]['bd'].'</span>';


$prov = require(HANDLERS.'boxza/province.php');
$pf[0]['pr']=(_::$profile['if']['pr']?'จังหวัด ':'').$prov[_::$profile['if']['pr']]['name_th'];
$pf[1]['pr']='<span>'.$pf[0]['pr'].'</span>';


$template->assign('user',_::user());
$template->assign('pf',$pf);


$cache=_::cache();

$key='profile-about-'._::$profile['_id'];
//if(!_::$content=$cache->get('ca1',$key))
//{
	$template->assign('service',_::sidebar()->service(array('movie'=>false,'game'=>false,'sexy'=>false)));
	$template->assign('gift', _::db()->find('gift',array('u'=>_::$profile['_id'],'ex'=>array('$gte'=>new MongoDate())),array(),array('sort'=>array('_id'=>-1))));
	_::$content=$template->fetch('user.view');
	//$cache->set('ca1',$key,_::$content,false,3600);
//}


	
?>