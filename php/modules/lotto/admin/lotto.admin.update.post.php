<?php
_::session()->logged();
$db=_::db();

$error=array();


$a1=trim($_POST['a1']);
$a2=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a2'])))));
sort($a2);
$a3=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a3'])))));
sort($a3);
$a4=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a4'])))));
sort($a4);
$a5=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a5'])))));
sort($a5);
$l3=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['l3'])))));
sort($l3);
$l2=trim($_POST['l2']);

if(!$_POST['day']||!$_POST['month']||!$_POST['year'])
{
	$error['title']='กรุณากรอกข้อมูลให้ครบถ้วน';
}

if(!count($error))
{
	$t='ตรวจหวย งวดที่ '.$_POST['day'].' '.(time::$month[$_POST['month']-1]).' '.($_POST['year']+543);
	$link=_::format()->link(strtolower($t));
	if(!$link)$link=$_POST['type'];
	$arg=array(
								'tm'=>new MongoDate(strtotime($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'])),
								'l'=>_::format()->link($t,false),
								'a1'=>$a1,
								'a2'=>$a2,
								'a3'=>$a3,
								'a4'=>$a4,
								'a5'=>$a5,
								'l3'=>$l3,
								'l2'=>$l2,
								'pl'=>$_POST['publish']?1:0,
							);
	$db->update('lotto',array('_id'=>$lotto['_id']),array('$set'=>$arg));
	_::cache()->delete('ca1','lotto_home',0);
	_::cache()->delete('ca1','lotto_global',0);
	_::cache()->delete('ca1','home',0);
	header('Location: /admin/'.$lotto['_id'].'?completed');
	exit;
}
print_r($error);
exit;
?>