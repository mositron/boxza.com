<?php

# check session/login
_::session();

_::$meta['image']='http://s0.boxza.com/static/images/global/logo.png';
_::$meta['profile']=true;
_::$meta['title'] = 'BoxZa สังคมออนไลน์ของคนไทย';
_::$meta['description'] = 'BoxZa สังคมออนไลน์ของคนไทยเต็มรูปแบบ พร้อมบริการ ข่าว เกมส์ อัลบั้ม รูปภาพ วิดีโอ หาเพื่อน ดูหนังออนไลน์ ลงประกาศฟรี และอื่นๆอีกมากมาย';
_::$meta['keywords'] = 'boxza, สังคมออนไลน์, อัลบั้ม, รูปภาพ, ดูหนังออนไลน์, วิดีโอ, เนื้อเพลง, ดูดวง, เกมส์, กลิตเตอร์, ลงประกาศฟรี, ตรวจหวย, หาเพื่อน, ผู้หญิง, เลสเบี้ยน, เกย์, ฝากรูป, ผลบอล, ข่าวฟุตบอล, ผลบอลสด, วิเคราะห์บอล';

/*
if(!_::$my || _::$my['_id']>3)
{
	if(_::$path[0])
	{
		_::move('/');	
	}
	require_once(__DIR__.'/close/close.php');
	exit;
}
*/

$template=_::template();

if(_::$path[0]=='ajax')
{
	define('IS_AJAX',1);
	array_shift(_::$path);
}


# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'line',
																	'l'=>'l',
																	'about'=>'about',
																	'ads'=>'ads',
																	'birthday' => 'birthday',
																	'blogs'=>'blogs',
																	'credit'=>'credit',
																	'dialog' => 'dialog',
																	'feedback'=>'feedback',
																	'friends'=>'friends',
																	'follow'=>'follow',
																	'game'=>'game',
																	'import'=>'import',
																	'line' => 'line',
																	'help'=>'help',
																	'maps'=>'maps',
																	'messages'=>'messages',
																	'notifications'=>'notifications',
																	'online'=>'online',
																	'people'=>'people',
																	'photos'=>'photos',
																	'quiz'=>'quiz',
																	'settings'=>'settings',
																	'share'=>'share',
																	'topvote'=>'topvote',
													),
													true,
													function()
													{
														$user=_::user();
														$cache=_::cache();
														$prof = false;
														if(_::$path[0]=='me')
														{
															if(_::$my)
															{
																_::move('/'._::$my['link']);
															}
															else
															{
																_::move(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode('http://social.boxza.com/me')));
															}
														}
														elseif(preg_match('/^(\_)?([0-9]+)$/',_::$path[0],$c))
														{
															if($c[1])
															{
																$p=_::$path;
																array_shift($p);
																_::move('/'.$c[2].(count($p)>0?'/'.implode('/',$p):''),true);
															}
															$prof=$user->get($c[2],true);
															if($prof['link'] && !is_numeric($prof['link']))
															{
																array_shift(_::$path);
																_::move('/'.$prof['link'].(count(_::$path)>0?'/'.implode('/',_::$path):''),true);
															}
														}
														else
														{
															if(!$pid=$cache->get('ca1','profile-link-'._::$path[0]))
															{
																if($prof=_::db()->findOne('user',array('if.lk'=>_::$path[0]),array('_id'=>1)))
																{
																	$cache->set('ca1','profile-link-'._::$path[0], $prof['_id'], false, 2592000);
																	$prof=$user->get($prof['_id'],true);
																}
																else
																{
																	_::move('/',true);
																}
															}
															else
															{
																$prof=$user->get($pid,true);
															}
														}
														if(_::$profile = $prof)
														{
															if(_::$my['_id'])
															{
																if(in_array(_::$my['_id'],(array)_::$profile['ct']['bl']))
																{
																	_::move('/line',true);
																}
																elseif(in_array(_::$my['_id'],(array)_::$profile['ct']['bl2']))
																{
																	_::move('/line',true);
																}
															}
															_::$meta['image']=_::$profile['img-n']='http://s1.boxza.com/profile/'._::$profile['if']['fd'].'/n.'.(_::$profile['pf']['av']?_::$profile['pf']['av']:'jpg');
															define('MODULE','user');
															array_shift(_::$path);
															//require_once ROOT_MODULES.'user/social.user.php';
														}
														else
														{
															_::move('/',true);
														}
													}
									)
);


if(defined('IS_AJAX'))
{
	echo '<html><body><script type="text/javascript">parent._.line.asyn('.json_encode(array('title'=>_::$meta['title'],'url'=>URL,'html'=>_::$content)).');</script></body></html>';
	exit;
}

#_::ajax()->register('h');



$cache=_::cache();
/*
if(!$mline=$cache->get('ca1','menu-line'))
{
	$mline=['hash'=>_::db()->find('line_hash',array(),array('_id'=>1,'c'=>1,'n'=>1),array('sort'=>array('c'=>-1),'limit'=>10))];
	$cache->set('ca1','menu-line',$mline,false,600);
}
$template->assign('mline',$mline);
*/
$template->display('content');

?>