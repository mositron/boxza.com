<?php

//_::time();
$db=_::db();

_::ajax()->register('setadmin');

$template->assign('user',_::user());
$template->assign('admin',$db->find('user',array('am'=>array('$gte'=>1)),array('_id'=>1,'if.am'=>1,'am'=>1,'du'=>1,'em'=>1),array('sort'=>array('du'=>-1))));


_::$content=$template->fetch('home');


function setadmin($frm)
{
	$db=_::db();
	$ajax=_::ajax();
	$user=_::user();
	if($admin=$db->find('user',array('am'=>array('$gte'=>1)),array('_id'=>1,'am'=>1,'du'=>1,'sc.gg.id'=>1),array('sort'=>array('du'=>-1))))
	{
		foreach($admin as $v)
		{
			$perm=$frm['perm_'.$v['_id']];
			if(!is_array($perm))
			{
				if($perm)
				{
					$perm=array($perm);	
				}
				else
				{
					$perm=array();	
				}
			}
			$user->update($v['_id'],array('$set'=>array('if.am'=>$perm)));
		}
	}
	$ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
	$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
}
?>