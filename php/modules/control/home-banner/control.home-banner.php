<?php


$access=check_perm('home-banner');

$position=array('img'=>'รูปภาพใหญ่ด้านซ้าย','text'=>'ข้อความลิ้งค์','bottom'=>'Hot Issue');
$template->assign('position',$position);

if(is_numeric(_::$path[0]))
{
	if($access)
	{
		require_once(__DIR__.'/control.home-banner.update.php');
	}
	else
	{
		_::move('/home-banner');	
	}
}
elseif(in_array(_::$path[0],array('stats')))
{
	require_once(__DIR__.'/control.home-banner.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/control.home-banner.home.php');
}

?>