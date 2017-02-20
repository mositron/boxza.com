<?php


define('FORUM_IN',1);
define('FORUM_URL','/forum/');
define('FORUM_TPL','racing.forum.');
define('FORUM_PERPAGE',20);
define('FORUM_FILES','s3');
define('FORUM_ORDER','_id');
define('FORUM_ID',intval(_::$path[1]));



$cate=array();
$db=_::db();
$tmp=$db->find('forum_cate',array('_id'=>array('$gte'=>1000,'$lte'=>7999)),array(),array('sort'=>array('_id'=>1)),false);
foreach($tmp as $v)
{
	$cate[$v['_id']]=$v;
	if($v['sl'])
	{
		$forum_link[$v['sl']]=$v['_id'];
	}
}

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

//echo '<pre>'.print_r($cate,true).'</pre>';
$template->assign('cate',$cate);
$template->assign('forum_link',$forum_link);

require_once(ROOT.'modules/forum/'.$mod.'/forum.'.$mod.'.php');

?>