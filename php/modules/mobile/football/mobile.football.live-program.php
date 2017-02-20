<?php

#$cache=_::cache();
#if(!_::$content=$cache->get('ca1','football_live_program'))
#{
	$db=_::db();
	$msg=$db->findone('msg',['_id'=>'live_program'],['msg'=>1]);
	$template->assign('program',$msg['msg']);
	
	
	_::$content=$template->fetch('football.live-program');
#	$cache->set('ca1','football_live_program',_::$content,false,3600);
#}



?>