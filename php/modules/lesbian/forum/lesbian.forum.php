<?php

define('FORUM_IN',1);
define('FORUM_URL','/forum/');
define('FORUM_TPL','forum.');
define('FORUM_CHAT','3');
define('FORUM_FILES','s3');
define('FORUM_CACHE','lesbian');
define('FORUM_ID',intval(_::$path[1]));
define('FORUM_HOME','เลสเบี้ยน');
define('FORUM_HOME_TT','เลสเบี้ยน ทอมดี้');





$cate=array();
$db=_::db();
$tmp=$db->find('forum_cate',array('_id'=>array('$gte'=>451,'$lte'=>479)),array(),false);
foreach($tmp as $v)$cate[$v['_id']]=$v;


$mods = array(
		'' => 'home',
		'home' => 'home',
		'attachments'=>'attachments',
		'new-topic'=>'new-topic',
		'edit-topic'=>'edit-topic',
		'new-reply'=>'new-reply',
		'edit-reply'=>'edit-reply',
		'setting'=>'setting',
		'emoticon'=>'emoticon',
		'addform.html'=>'addform',
		'topic'=>'view',
);

if(isset($mods[_::$path[0]]))
{
	$mod=$mods[_::$path[0]];
}
else
{
	$mod='list';
}

$template->assign('cate',$cate);

require_once(ROOT.'modules/forum/'.$mod.'/forum.'.$mod.'.php');

?>