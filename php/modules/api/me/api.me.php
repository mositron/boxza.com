<?php

if(in_array(_::$path[1],array('line','chat','like','share','notifications','notify','photos','comment','poll','search','friend','friend_request','maps','info','setting','report','people','place','tag','team')))
{
	$who=array('uid'=>_::$my['_id']);
	require_once __DIR__.'/api.me.'._::$path[1].'.php';
}
?>