<?php

_::ajax()->register(array('getmenu'));


_::$content=$template->fetch('matching.home');




function getmenu($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	if($user=$db->findone('matching_user',array('fb'=>$arg['id'])))
	{
		
	}
	else
	{
		$user=array('fb'=>$arg['id'],'name'=>$arg['name'],'email'=>$arg['email'],'lv'=>1,'score'=>0,'bonus'=>array('open'=>5,'answer'=>5));
		$id=$db->insert('matching_user',$user);
		$user['_id']=$id;
	}
	
	$ajax->script('showmenu('.json_encode($user).')');
}
?>
