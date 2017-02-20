<?php

define('HIDE_SIDEBAR',1);
	_::$meta['title']='แชทผู้หญิง ห้องแชทสำหรับผู้หญิง พูดคุยสำหรับผู้หญิง สนทนาตามประสาผู้หญิงผู้หญิง';
	_::$meta['description']=_::$meta['title'].', '._::$meta['description'];
	_::$content=$template->fetch('chat');
#	$cache->set('ca1',$ckey,_::$content,false,600);

#}


?>