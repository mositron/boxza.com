<?php


$db=_::db();
if(!_::$path[1] || !$user=$db->findone('matching_user',array('_id'=>intval(_::$path[1]))))
{
	_::move('/matching');	
}

define('USER_ID',$user['_id']);
define('USER_FB',$user['fb']);
define('USER_LV',$user['lv']);



$games=require(__DIR__.'/mobile.matching.game.config.php');


$template->assign('parent','/matching');
$template->assign('games',$games);
$template->assign('maxlv',count($games)+1);
$template->assign('user',$user);
_::$content=$template->fetch('matching.score');


?>