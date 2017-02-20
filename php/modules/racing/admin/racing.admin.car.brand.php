<?php


//_::ajax()->register(array('newbrand'),'admin.car');

$db=_::db();
if(!$brand=$db->findone('car_brand',array('link'=>_::$path[1])))
{
	_::move('/admin/car');	
}
define('BRAND_ID',$brand['_id']);

$template=_::template();
$template->assign('html',_::html());
$template->assign('brand',$brand);
$template->assign('spectype',array('0'=>'ไม่มีประเภท','1'=>'รถเก๋ง','2'=>'รถกระบะ','3'=>'รถตู้','4'=>'SUV (CR-V, Fortuner,...)','5'=>'MPV (Wish, Innova,...)'));
$template->assign('canedit',_::$my['am']>=9);


_::ajax()->register(array('newspec','update'),'admin.car');

if(isset($_FILES) && isset($_FILES['thumb']))
{
	$s=array('status'=>'FAIL','message'=>'ไฟล์ไม่ถูกต้อง');
	if($m=$_FILES['thumb']['tmp_name'])
	{
		$s['status']='OK';
		_::upload()->send('s3','racing-brand','@'.$m,array('name'=>$brand['link']));
		$s['pic']='http://s3.boxza.com/racing/brand/'.$brand['link'].'.png?rand='.rand(1,999);
	}
	echo json_encode($s);
	exit;
}

$template->assign('speclist',getspec());

_::$content=$template->fetch('admin.car.brand');


function getspec()
{
	$db=_::db();
	$template=_::template();
	$template->assign('spec',$db->find('car_spec',array('brand'=>BRAND_ID)));
	return $template->fetch('admin.car.brand.spec');
}
?>