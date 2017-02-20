<?php


# check session/login
_::session();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-forum.png';
_::$meta['title'] = 'รูป รูปภาพ รูปโป๊ รูปสาวสวย รูปน่ารัก รูปการ์ตูน รูปตลกขำขัน รูปดารา รูปเซ็กซี่ ';
_::$meta['description'] = 'รวมรูปภาพ รูปภาพสาวไทย สาวไทยเซ็กส์ซี่ รูปตลกฮาๆขำขัน รูปดารา รูปการ์ตูน รูปเซ็กซี่';
_::$meta['keywords'] = 'รูป, รูปภาพ, รูปน่ารัก, รูปสาวสวย, รูปการ์ตูน, รูปโป๊, รูปตลก, รูปสาวไทย';

//_::time();
$cate=array();
$forum_link=array();
$db=_::db();
//$tmp=$db->find('forum_cate',array('s'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>1)),false);
$tmp=$db->find('forum_cate',array('$or'=>array(array('s'=>array('$exists'=>false)),array('s'=>array('$in'=>array('game','entertain','car'))))),array(),array('sort'=>array('_id'=>1)),false);
foreach($tmp as $v)
{
	$cate[$v['_id']]=$v;
	if($v['sl'])
	{
		$forum_link[$v['sl']]=$v['_id'];
	}
}
$template=_::template();
$template->assign('cate',$cate);
$template->assign('_banner',_::banner('forum'));

$option = array(
										'tpl'=>array(
																		38=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		411=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		412=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		413=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		414=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		415=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		416=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		417=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		418=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		419=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		420=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		441=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		481=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		543=>array('list'=>'picpost','th_page'=>'forum_picpost'),
																		544=>array('list'=>'picpost','th_page'=>'forum_picpost'),
										),
										'list'=>array(
																		38=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		411=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		412=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		413=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		414=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		415=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		416=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		417=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		418=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		419=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		420=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		441=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		481=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		543=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
																		544=>array('nsk'=>true,'order'=>'da','th_page'=>'forum_picpost'),
									),
);

define('FORUM_URL','/');
define('FORUM_TPL','forum.');
define('FORUM_ID',intval(_::$path[1]));
define('FORUM_CACHE','forum');
define('FORUM_FILES','s3');
define('FORUM_HOME','รูป');
define('FORUM_HOME_TT','รูป');

require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'attachments'=>'attachments',
																	'new-topic'=>'new-topic',
																	'edit-topic'=>'edit-topic',
																	'edit-reply'=>'edit-reply',
																	'new-reply'=>'new-reply',
																	'setting'=>'setting',
																	'topic'=>'view',
																	'emoticon'=>'emoticon',
																	'addform.html'=>'addform',
													),
													true,
													function()
													{
														define('MODULE','list');
													}
								)
);


$template->display('content');


function getnavigate($parent,$last=false)
{
	
}
?>