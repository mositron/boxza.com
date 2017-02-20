<?php

# check session/login
_::session();

//_::time();


#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-chat.png';
_::$meta['title'] = 'Chat แชท พูดคุย สนทนา ผ่านกล้องเว็บแคม สร้างห้องแชทฟรี กับเพื่อนๆใน boxza';
_::$meta['description'] = 'Chat แชท พูดคุย สนทนา ผ่านกล้องเว็บแคม ส่องเว็บแคม ส่องกล้อง สร้างห้องแชทฟรี กับเพื่อนๆใน boxza.com';
_::$meta['keywords'] = 'สร้างแชทฟรี, สร้างห้องแชทฟรี, Chat, แชท, พูดคุย, สนทนา, เว็บแคม, กล้อง';


$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	$data['service']=_::sidebar()->service(array('beauty'=>0,'football'=>0,'boyz'=>0,'lesbian'=>0));
	$data['_banner']=_::banner(_::$type);
	
	
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto']=$lotto[0];
	
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}

$template=_::template();
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);
$template->assign('lotto',$data['lotto']);



require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'list' => 'list',
																	'create'=>'create',
																	'manage'=>'manage',
																	'room'=>'view',
																	'game'=>'game',
																	'__oauth'=>'oauth',
													),
													true,
													function()
													{
														define('MODULE','view');
														define('MODULE_LINK','name');
													}
								)
);

$template->display('content');

?>