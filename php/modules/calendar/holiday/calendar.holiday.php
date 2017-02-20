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

_::$meta['title'] = 'วันหยุดประจําปี '.$year.' วันหยุดราชการ '.$year.' วันหยุดธนาคาร '.$year.' วันหยุดเอกชน '.$year;
_::$meta['description'] = 'ปฏิทินปี '.$year.' ฉบับสมบูรณ์ที่รวบรวม วันหยุดประจําปี '.$year.' วันหยุดราชการปี '.$year.' วันหยุดธนาคาร '.$year.' วันหยุดเอกชน '.$year;
_::$meta['keywords'] = 'วันหยุดประจําปี, ปฏิทิน, '.$year.', วันหยุด, ราชการ, ธนาคาร, เอกชน, วันพระ, วันสำคัญ';


$template->assign('year',$year-543);
_::$content=$template->fetch('holiday');
?>