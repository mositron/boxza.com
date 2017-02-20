<?php

$db=_::db();

$error=array();
$arg=array();
$arg['_id']=trim(mb_strtolower(mb_substr(strip_tags($_POST['key']),0,50,'utf-8'),'utf-8'));
$arg['n']=trim(mb_substr(strip_tags($_POST['name']),0,100,'utf-8'));
$arg['pl']=0;
$arg['pr']=max(1,intval($_POST['price']));
$arg['ex']=max(1,intval($_POST['expire']));
$arg['u']=_::$my['_id'];
$arg['ty']='gift';
$arg['da']=new MongoDate();

if(!$arg['n'])
{
	$error[]='กรุณากรอกชื่อของขวัญ';
}
elseif(!preg_match('/^[a-z0-9]+$/',$arg['_id'],$c))
{
	$error[]='คีย์นี้ไม่สามารถใช้งานได้';
}
elseif($db->findone('lionica_item_shop',array('_id'=>$arg['_id'])))
{
	$error[]='มีคีย์นี้อยู่ในระบบแล้ว';
}

if(!count($error))
{
	$db->_command('lionica_item_shop','insert',array($arg,array('safe'=>false)));
	if($f=$_FILES['gift_img']['tmp_name'])
	{
		_::upload()->send('s1','gift-upload','@'.$f,array('name'=>$arg['_id']));
	}
	_::move('/gift?cmd=editing');
}
else
{
	$template->assign('error',$error);	
}
?>