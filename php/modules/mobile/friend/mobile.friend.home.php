<?php

_::ajax()->register(array('newfriend','delms'));


$pp=50;
$parm=_::split()->get('/friend',0,array('type','province','min','max'));


$_province=strval($parm['province']);
$_type=strval($parm['type']);
$_min=intval(strval($parm['min'])?strval($parm['min']):0);
$_max=intval(strval($parm['max'])?strval($parm['max']):60);

$template->assign('_province',$_province);
$template->assign('_type',$_type);
$template->assign('_min',$_min);
$template->assign('_max',$_max);

$arg=array('dd'=>array('$exists'=>false));
if($_province)
{
	$arg['pr']=array('$in'=>array_map('intval',explode('_',$_province)));
}
if($_type)
{
	$arg['ty']=$_type;
}
$arg['ag']=array();
if($_min)
{
	$arg['ag']['$gte']=$_min;
}
if($_max)
{
	$arg['ag']['$lte']=$_max;
}

$template->assign('friend',_::db()->find('appfriend',$arg,array(),array('sort'=>array('_id'=>-1),'limit'=>$pp)));
_::$content=$template->fetch('friend.home');

function delms($id)
{
	$db=_::db();
	$ajax=_::ajax();	
	if($m=$db->findone('appfriend',array('_id'=>intval($id),'dd'=>array('$exists'=>false))))
	{
		$db->update('appfriend',array('_id'=>$m['_id']),array('$set'=>array('dd'=>new mongodate(),'dd_fb'=>$fb_id)));
		$ajax->script('alert("ลบข้อความเรียบร้อยแล้ว")');
		$ajax->script('$(".ms-'.$m['_id'].'").remove();');
	}
	else
	{
		$ajax->script('alert("ข้อความนี้ถูกลบไปแล้ว")');
	}
}
function newfriend($arg)
{
	$db=_::db();
	$ajax=_::ajax();	
	$fb_id=trim($arg['fb_id']);
	$fb_name=trim($arg['fb_name']);
	$province=intval(trim($arg['province']));
	$type=trim($arg['type']);
	$age=intval(trim($arg['age']));
	$line=trim($arg['line']);
	$msg=trim($arg['msg']);
	if($fb_id&&$fb_name&&$province&&$type&&$age&&$msg)
	{
		$db->insert('appfriend',array(
															'pr'=>$province,
															'ty'=>$type,
															'ms'=>$msg,
															'ag'=>$age,
															'fb_id'=>$fb_id,
															'fb_name'=>$fb_name,
															'line'=>$line,
															'ds'=>new MongoDate(),
															'ip'=>$_SERVER['REMOTE_ADDR'],
															));
			
		$ajax->redirect('/friend?action=completed');	
	}
	else
	{
		$ajax->script('aelrt("ข้อมูลไม่ครบ กรุณาลองใหม่อีกครั้ง")');	
	}
}
?>
