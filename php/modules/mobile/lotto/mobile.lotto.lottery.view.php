<?php
list($id,$link)=explode('-',_::$path[1],2);

$db=_::db();
if(!$lotto=$db->findone('lotto',array('_id'=>intval($id),'dd'=>array('$exists'=>false),'pl'=>1)))
{
	_::move('/lotto/lottery');
}

$tm=time::show($lotto['tm'],'date');
_::$meta['title'] = 'ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง งวดที่ '.$tm;
_::$meta['description'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล ย้อนหลังงวดที่ '.$tm.'  ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง อัพเดทรวดเร็ว';
_::$meta['keywords'] = $tm.', ตรวจหวยย้อนหลัง, ตรวจสลากกินแบ่งย้อนหลัง, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, หวยย้อนหลัง, เลขเด็ด, หวยเด็ด';

$template->assign('parent','/lotto/lottery');
$template->assign('lotto',$lotto);
_::$content=$template->fetch('lotto.lottery.view');
?>