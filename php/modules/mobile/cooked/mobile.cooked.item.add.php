<?php


$db=_::db();

if(!_::$path[2] || !$user=$db->findone('cooked_user',array('_id'=>intval(_::$path[2]))))
{
	_::move('/cooked');	
}

_::ajax()->register(array('newitem'));

$template->assign('parent','/cooked');
$template->assign('user',$user);
_::$content=$template->fetch('cooked.item.add');



function newitem($arg)
{
	global $user;
	$db=_::db();
	$ajax=_::ajax();
	$n=trim($arg['name']);
	$m=array_values(array_filter(array_unique(array_map('trim',(array)$arg['mat']))));
	if($n&&count($m)>1)
	{
		if($db->findone('cooked',array('n'=>$n)))
		{
			$ajax->alert('มีเมนูอาหารนี้อยู่ในระบบแล้ว');	
		}
		else
		{
			$db->insert('cooked',array('n'=>$n,'m'=>$m,'ac'=>0));
			$ajax->alert('เพิ่มเมนูเรียบร้อย');
		}
	}
}

?>