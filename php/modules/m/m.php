<?php

_::$meta['title'] = '';
_::$meta['description'] = '';
_::$meta['keywords'] = '';

# check session/login
_::session();


if(_::$path[0]=='ajax')
{
	define('IS_AJAX',1);
	array_shift(_::$path);
}


if(!_::$my && !in_array(_::$path[0],array('oauth','json')))
{
	_::session()->logged();
}

require_once(
									_::run(
													[
														'' => 'line',
														'home' => 'line',
														'json'=>'json',
														'glitter'=>'glitter',
														'lotto'=>'lotto',
														'movie'=>'moive',
														'video'=>'video',
														'friend'=>'friend',
														'music'=>'music',
														'line' => 'line',
														'user'=>'user',
														'oauth' => 'oauth',
														'messages'=>'messages',
														'notifications'=>'notifications',
														'settings'=>'settings',
													],
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
																_::move(array('sub'=>'m','path'=>'/oauth/login/?redirect_uri='.urlencode('http://m.boxza.com/me')));
															}
														}
														elseif(preg_match('/^(\_)?([0-9]+)$/',_::$path[0],$c))
														{
															if($c[1])
															{
																$p=_::$path;
																array_shift($p);
																_::move('/'.$c[2].'/'.implode('/',$p),true);
															}
															$prof=$user->get($c[2],true);
															if($prof['link'] && !is_numeric($prof['link']))
															{
																array_shift(_::$path);
																_::move('/'.$prof['link'].'/'.implode('/',_::$path),true);
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
																	_::move('/',true);
																}
																elseif(in_array(_::$my['_id'],(array)_::$profile['ct']['bl2']))
																{
																	_::move('/',true);
																}
															}
															_::$meta['image']=_::$profile['img-n']='http://s1.boxza.com/profile/'._::$profile['if']['fd'].'/n.'.(_::$profile['pf']['av']?_::$profile['pf']['av']:'jpg');
															define('MODULE','user');
															array_shift(_::$path);
															require_once ROOT_MODULES.'user/m.user.php';
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
	echo _::$content;
	exit;
}

_::template()->display('content');




?>