<?php

define('FORUM_IN',1);
define('FORUM_URL','/forum/');
define('FORUM_TPL','forum.');
define('FORUM_CHAT','3');
define('FORUM_FILES','s3');
define('FORUM_CACHE','game');
define('FORUM_ID',intval(_::$path[1]));
define('FORUM_HOME','เกมส์');
define('FORUM_HOME_TT','เกมส์ เกม เกมส์ออนไลน์');

define('HIDE_SIDEBAR',1);



_::$meta['title'] = 'เว็บบอร์ดเกมส์ออนไลน์ เกมส์เฟสบุ๊ค เกมส์ทั่วไป ข้อมูลเกมส์ แนวทางการเล่น รวมทั้งโปร บอท โปรโกง โปรปั๊ม โปรแกรมช่วยเล่นมากมาย';
_::$meta['description'] = 'ศูนย์รวมเกมส์ออนไลน์ เกมส์เฟสบุ๊ค เกมส์ทั่วไป ข้อมูลเกมส์ แนวทางการเล่น รวมทั้งโปร บอท โปรปั๊ม โปรโกง โปรแกรมช่วยเล่นมากมายไว้ที่นี่';
_::$meta['keywords'] = 'เกมส์ออนไลน์, โปรโกง, โปรปั๊ม, บอท, โปรแกรมช่วยเล่น, เกมส์';


$cate=array();
$forum_link=array();
$forum_mod=array(3=>'moderator');

$db=_::db();

$tmp=$db->find('forum_cate',array('_id'=>array('$in'=>array(11,12,13,14,15,16,17,18,19,20,51,52,53,54,55,61,62,63,64,65,66,67,68,69,70,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130))),array(),false);
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
	require_once(__DIR__.'/game.forum.home.php');
}
else
{
	require_once(ROOT.'modules/forum/'.$mod.'/forum.'.$mod.'.php');
}
?>