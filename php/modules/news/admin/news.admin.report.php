<?php

define('HIDE_SIDEBAR',1);

$db=_::db();

if(_::$path[1])
{
	if(preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/',_::$path[1]))
	{
		$date=_::$path[1];
	}
	else
	{
		_::move('/admin/report');	
	}
}
else
{
	$date=date('Y-m-d');
}

$dfrom=strtotime($date.' 00:00:00');
$dto=strtotime($date.' 23:59:59');

$u=array();

$user=_::user();
$news=$db->find('news', array('dd'=>array('$exists'=>false),'da'=>array('$gte'=>new mongodate($dfrom),'$lte'=>new mongodate($dto))),array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'c'=>1,'cs'=>1,'ty'=>1,'tm'=>1,'pl'=>1,'do'=>1,'u'=>1,'da'=>1,'wt'=>1,'ds'=>1,'exl'=>1,'url'=>1));
for($i=0;$i<count($news);$i++)
{
	$n=$news[$i];
	if(!isset($u[$n['u']]))
	{
		$u[$n['u']]=array(
										'profile'=>$user->profile($n['u']),
										'news'=>array()
		);
	}
	$u[$n['u']]['news'][]=$n;
}



$template->assign('writer',$u);
$template->assign('news',$news);
$template->assign('dfrom',$dfrom);
_::$content=$template->fetch('admin.report');
?>