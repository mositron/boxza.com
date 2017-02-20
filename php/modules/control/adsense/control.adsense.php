<?php


if(!isset($_GET['date']))
{
	$date=date('Y-m-d');
}
else
{
	$date=$_GET['date'];
}
$db=_::db();



$stats = $db->group('adsense_click',array('u'=>1), array('u'=>'','c'=>0,'t'=>''), "function(obj, prev) { prev.u=obj.u; prev.t=obj.t; prev.c++; }",
						array(
										'condition'=>array(
																					'kd'=>$date,
															 )
									)
					);
					

$sort=array();
for($i=0;$i<count($stats);$i++)
{
	$sort[]=$stats[$i]['c'];
}

array_multisort($stats, SORT_DESC, SORT_NUMERIC, $sort, SORT_DESC, SORT_NUMERIC);

$stats = array_slice($stats,0,100);

$template=_::template();
$template->assign('date',$date);
$template->assign('stats',$stats);





_::$content=$template->fetch('adsense');
?>