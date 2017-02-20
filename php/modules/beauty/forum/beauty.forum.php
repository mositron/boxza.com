<?php

define('FORUM_IN',1);
define('FORUM_URL','/forum/');
define('FORUM_TPL','beauty.forum.');
define('FORUM_PERPAGE',20);
define('FORUM_FILES','s3');
define('FORUM_ORDER','_id');
define('FORUM_CACHE','beauty');
define('FORUM_ID',intval(_::$path[1]));
define('FORUM_HOME','ผู้หญิง');
define('FORUM_HOME_TT','ผู้หญิง แฟชั่น แต่งตัว');


$option = array(
										'home'=>array(
																			'h1'=>array(
																											't'=>'Hot Review',
																											'c'=>array(311,312,313,314,315,316,317,318,319),
																			),
																			'h2'=>array(
																											't'=>'Hot Item',
																											'c'=>array(321,322,323,324,325,326,327,328,329),
																			),
																			'h3'=>array(
																											't'=>'Street Fashion',
																											'c'=>array(331),
																			),
																			'h4'=>array(
																											't'=>'How to',
																											'c'=>array(332),
																			),
																			'h5'=>array(
																											't'=>'Open Box',
																											'c'=>array(333),
																			),
																			'h6'=>array(
																											't'=>'Fashion',
																											'c'=>array(334),
																			),
																			'h7'=>array(
																											't'=>'Did you known',
																											'c'=>array(335),
																			),
																			'h8'=>array(
																											't'=>'PR News',
																											'c'=>array(336),
																			),
																			'h9'=>array(
																											't'=>'Hot News',
																											'c'=>array(343),
																			),
																			'h10'=>array(
																											't'=>'Hot Topic',
																			),
																			'h11'=>array(
																											't'=>'Hot Video',
																			),
																			'h12'=>array(
																											't'=>'New Update',
																											'i'=>array(475,300),
																			),
																			'h13'=>array(
																											't'=>'Most Poppular',
																			),
										),
										'list'=>array(
																		311=>array('pp'=>50),
																		312=>array('pp'=>50),
																		313=>array('pp'=>50),
																		314=>array('pp'=>50),
																		315=>array('pp'=>50),
																		316=>array('pp'=>50),
																		317=>array('pp'=>50),
																		318=>array('pp'=>50),
																		319=>array('pp'=>50),
																		331=>array('cm'=>-3,'pp'=>20),
																		332=>array('pp'=>50),
																		333=>array('pp'=>50),
																		334=>array('pp'=>50),
																		335=>array('pp'=>50),
																		336=>array('pp'=>50),
																		337=>array('pp'=>50),
																		341=>array('pp'=>40),
																		342=>array('pp'=>50),
																		343=>array('pp'=>50),
																		344=>array('pp'=>50),
										),
										'tpl'=>array(
																		321=>array('list'=>'hot-item'),
																		322=>array('list'=>'hot-item'),
																		323=>array('list'=>'hot-item'),
																		324=>array('list'=>'hot-item'),
																		325=>array('list'=>'hot-item'),
																		326=>array('list'=>'hot-item'),
																		327=>array('list'=>'hot-item'),
																		328=>array('list'=>'hot-item'),
																		329=>array('list'=>'hot-item'),
																		331=>array('list'=>'street-fashion'),
																		341=>array('list'=>'photo-box'),
										),
);
/*

hot review - 311-319 : 4
hot item - 321-329 : 4
street fashion - 331 : 4
how to - 332 : 4
open box - 333 : 6
fashion - 334 : 6
did u - 335 : 1
pr news - 336 : 2


hot news - 343 : 12

hot topic - all - 8
hot video - all - 4
้new update - all - 5
้most poppular - all - 5

*/


$cate=array();
$db=_::db();
$tmp=$db->find('forum_cate',array('_id'=>array('$gte'=>301,'$lte'=>399)),array(),false);
foreach($tmp as $v)$cate[$v['_id']]=$v;

foreach($cate as $k=>$v)
{
	$cate[$k]['tp']=intval($cate[$k]['tp']);
	$cate[$k]['rp']=intval($cate[$k]['rp']);
	$cate[$k]['do']=intval($cate[$k]['do']);
	$cate[$k]['lk']=intval($cate[$k]['lk']);
	if($cate[$k]['l'])
	{
		for($j=0;$j<count($cate[$k]['l']);$j++)
		{
			$b=$cate[$k]['l'][$j];
			$cate[$k]['tp']+=intval($cate[$b]['tp']);
			$cate[$k]['rp']+=intval($cate[$b]['rp']);
			$cate[$k]['do']+=intval($cate[$b]['do']);
			$cate[$k]['lk']+=intval($cate[$b]['lk']);				
		}
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
$template->assign('option',$option);
if($mod=='view')
{
	$template->assign('service',_::sidebar()->service(array('beauty'=>0)));
}
if($mod=='home')
{
	require_once(__DIR__.'/beauty.forum.home.php');
}
else
{
	require_once(ROOT.'modules/forum/'.$mod.'/forum.'.$mod.'.php');
}

function getclassbyid($cate)
{
	$l=array(311=>'review',321=>'hot-item',331=>'street-fashion',332=>'how-to',333=>'open-box',334=>'fashion',335=>'did-u',336=>'pr-news',337=>'mouth-2-mouth',341=>'photo-box',342=>'healthy',343=>'news',344=>'travel');
	if(isset($l[$cate['_id']]))
	{
		return array($cate['_id'],$l[$cate['_id']]);
	}
	elseif($cate['p']&&isset($l[$cate['p']]))
	{
		return array($cate['p'],$l[$cate['p']]);
	}
}
?>