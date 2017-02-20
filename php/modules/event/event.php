<?php

# check session/login
_::session();

//_::time();

_::$meta['title'] = 'กิจกรรมแจกรางวัล ร่วมกิจกรรมกับ BoxZa.com';
_::$meta['description'] = 'กิจกรรมร่วมสนุก แจกของรางวัลมากมาย ร่วมลุ้นของรางวัลได้ที่นี่ กับ boxza.com';
_::$meta['keywords'] = 'กิจกรรม, แจกรางวัล, ร่วมสนุก';

$template=_::template();

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	//$data['profile']=$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>25));
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner(_::$type);
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('profile',$data['profile']);
$template->assign('service',$data['service']);

# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'first'=>'first',
													)
								)
);

$template->display('content');


?>