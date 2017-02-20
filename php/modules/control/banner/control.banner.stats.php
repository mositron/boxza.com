<?php

$db=_::db();
if(!$banner=$db->findone('banner',array('_id'=>intval(_::$path[1]),'dd'=>array('$exists'=>false))))
{
	_::move('/banner');
}

$last=$db->find('banner_click',array('b'=>$banner['_id']),array(),array('sort'=>array('_id'=>-1),'limit'=>100));

$template->assign('banner',$banner);
$template->assign('last',$last);





$mn=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');



$stats = $db->group('banner_click',array('kd'=>1), array('kd'=>'','c'=>0), "function(obj, prev) { prev.kd=obj.kd; prev.c++; }",
						array(
										'condition'=>array(
																					'da'=>array('$gte'=>new MongoDate(time()-(3600*24*31))),
																					'b'=>$banner['_id'],
															 )
									)
					);
					

$k=array(array(''));
$a = $x = array(array(0,''));
$sa = $su = $sv = 0;
//_::time();
for($i=0;$i<count($stats);$i++)
{
	$_a = intval($stats[$i]['c']);
	$sa += $_a;
	$a[]=array($i+1,$_a);
	$k[]=$stats[$i]['kd'];
	$e = explode('-',$stats[$i]['kd']);
	$x[]=array($i+1,$e[2].'<br>'.$mn[intval($e[1])-1]);
}

$c=count($stats);
if($c>1)
{
	$a1 = $a[$c][1];
	$a2 = $a[$c-1][1];
	$_a = intval((($a1-$a2)/max(1,$a2))*100);
	$_a = ': <strong>'.number_format($sa).'</strong> <span class="stats-'.($_a>0?'u">(+':'d">(').$_a.'%)</span>';
}

$i=$c+1;
$a[] = array($i,'');
$k[] = '';


$template=_::template();
$template->assign('app',$var);
$template->assign('stats',$stats);
$template->assign('a',$a);
$template->assign('k',$k);
$template->assign('x',$x);
$template->assign('_a',$_a);




_::$content=$template->fetch('banner.stats');
?>