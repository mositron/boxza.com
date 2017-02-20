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

_::$meta['title'] = 'ปฏิทิน '.$year.' วันหยุดประจําปี '.$year.' วันหยุดราชการ '.$year.' วันพระ วันสำคัญ '.$year.' ดูปฎิทินปี '.$year.' Calendar '.($year-543).' ปฏิทินไทย '.$year;
_::$meta['description'] = 'ปฏิทินปี '.$year.' วันหยุดประจําปี '.$year.' วันหยุดราชการปี '.$year.' วันพระและวันสำคัญปี '.$year.' ดูปฎิทินปี '.$year.' Calendar '.($year-543).' ปฏิทินไทย '.$year;
_::$meta['keywords'] = 'ปฏิทิน, '.$year.', วันหยุดประจําปี, วันหยุดราชการ, วันพระ, วันสำคัญ, calendar, '.($year-543).', ปฏิทินไทย';
//_::$meta['google']=array('id'=>'112235668332689047152');

$template->assign('year',$year-543);
_::$content=$template->fetch('home');
?>