<?php

define('FORUM_IN',1);
define('FORUM_URL','/forum/');
define('FORUM_TPL','forum.');
define('FORUM_CHAT','3');
define('FORUM_FILES','s3');
define('FORUM_CACHE','entertain');
define('FORUM_ID',intval(_::$path[1]));
define('FORUM_HOME','ข่าวบันเทิง');
define('FORUM_HOME_TT','ข่าวบันเทิง บันเทิง ข่าวดารา');

define('HIDE_SIDEBAR',1);



_::$meta['title'] = 'เว็บบอร์ดบันเทิง รูปภาพดารา พูดคุยสนทนา ซุบซิบเกี่ยวกับดารา วงการบันเทิง';
_::$meta['description'] = 'เว็บบอร์ดบันเทิง ข่าวบันเทิง ดารานักร้อง รูปภาพดารา พูดคุยสนทนา ซุบซิบเกี่ยวกับดารา วงการบันเทิง';
_::$meta['keywords'] = 'เว็บบอร์ดบันเทิง, ข่าวบันเทิง, รูปภาพดารา';


$cate=array();
$forum_link=array();
//$forum_mod=array(3=>'moderator');


$option = array(
										'tpl'=>array(
																		418=>array('list'=>'picpost','th_page'=>'forum_picpost'),
										),
										'list'=>array(
																		418=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
									),
);

$db=_::db();

$tmp=$db->find('forum_cate',array('_id'=>array('$in'=>array(418,501,502,503,504,505,510,511))),array(),false);
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

$template->assign('cate',$cate);
$template->assign('forum_link',$forum_link);
$template->assign('forum_mod',$forum_mod);

if($mod=='home')
{
	require_once(__DIR__.'/entertain.forum.home.php');
}
else
{
	require_once(ROOT.'modules/forum/'.$mod.'/forum.'.$mod.'.php');
}
?>