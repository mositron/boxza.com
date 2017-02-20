<?php

define('HIDE_SIDEBAR',1);

//_::time();
//_::link();

$db=_::db();
$template=_::template();


if(defined('CYEAR'))
{
	$year=CYEAR;	
}
else
{
	$year=date('Y')+543;	
}

_::$meta['title'] = 'วันสำคัญประจําปี '.$year.' วันสำคัญใน '.$year.' รายชื่อวันปี '.$year;
_::$meta['description'] = 'วันสำคัญประจําปี '.$year.' ฉบับสมบูรณ์ที่รวบรวม วันสำคัญในปี '.$year.' รายชื่อวันปี '.$year;
_::$meta['keywords'] = 'วันสำคัญประจําปี, ปฏิทิน, '.$year.', วันสำคัญ, รายชื่อวัน';


$template->assign('year',$year-543);
_::$content=$template->fetch('important');
?>