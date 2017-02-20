<?php
list($id,$link)=explode('-',_::$path[0],2);

$db=_::db();
if(!$lotto=$db->findone('lotto',array('_id'=>intval($id),'dd'=>array('$exists'=>false),'pl'=>1)))
{
	_::move('/');
}

if(_::$path[0]!=$lotto['_id'].'-'.$lotto['l'].'.html')
{
	_::move('/'.$lotto['_id'].'-'.$lotto['l'].'.html');
}

if($lotto['u'])
{
	$poster=_::user()->profile($lotto['u']);
	if($poster['google'])
	{
		_::$meta['google']=$poster['google'];
	}
}


$last=$db->find('lotto',array('dd'=>array('$exists'=>false),'_id'=>array('$ne'=>$lotto['_id']),'pl'=>1),array('_id'=>1,'tm'=>1,'l'=>1,'l3'=>1,'a1'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>3));
	
$tm=time::show($lotto['tm'],'date');
_::$meta['title'] = 'ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง งวดที่ '.$tm;
_::$meta['description'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล ย้อนหลังงวดที่ '.$tm.'  ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง อัพเดทรวดเร็ว';
_::$meta['keywords'] = $tm.', ตรวจหวยย้อนหลัง, ตรวจสลากกินแบ่งย้อนหลัง, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, หวยย้อนหลัง, เลขเด็ด, หวยเด็ด';


$template->assign('last',$last);
$template->assign('lotto',$lotto);
_::$content=$template->fetch('view');
?>