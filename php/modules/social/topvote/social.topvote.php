<?php

//_::time();

$bn='สมาชิกยอดนิยม ประจำเดือน'.time::$month[date('n')-1];


_::$meta['title'] = $bn.' - BoxZa สังคมออนไลน์';
_::$meta['description'] = $bn.' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'สมาชิก, ยอดนิยม, ประจำเดือน, เพื่อน, สังคมออนไลน์';


$db=_::db();
$user=_::user();
$template=_::template();
$template->assign('user',$user);
$template->assign('bn',$bn);
$arg=array(
									'$or'=>array(
																	array('st'=>array('$gte'=>0)),
																	array('st'=>array('$exists'=>false))
									),
									'dd'=>array('$exists'=>false)
							);
							
							
if($topvote = $db->find('user',$arg,array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1),array('sort'=>array('pf.vt.m'=>-1,'pf.vt.a'=>-1),'limit'=>100)))
{
	//shuffle($birth);
	$template->assign('topvote',$topvote);
}
$last=$db->find('user_topvote',array('s'=>1),array(),array('sort'=>array('_id'=>-1)));
list($year,$month)=explode('-',$last[0]['k']);
$template->assign('last',$last);
$template->assign('lastmonth',time::$month[intval($month)-1]);

$template->assign('service',_::sidebar()->service(array('line'=>1)));
_::$content=$template->fetch('topvote');








?>