<?php

define('F_TYPE','girl');

_::ajax()->register(array('sendreport','setrec'),'home');


_::$meta['title']='หาเพื่อนหญิง หาเพื่อนสาว หาเพื่อนผู้หญิง - '._::$meta['title'];
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

$cache=_::cache();
if(!_::$content=$cache->get('ca1','friend_home_'.F_TYPE))
{
	//_::time();
	$db=_::db();
	$template=_::template();
	$msn=$db->find('msn',array('dd'=>array('$exists'=>false),'ty'=>F_TYPE),array(),array('sort'=>array('au'=>1,'_id'=>-1),'skip'=>0,'limit'=>30),false);
	//$template->assign('topp',$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>25)));
	$template->assign('rec',$db->find('msn_rec',array('dd'=>array('$exists'=>false),'ty'=>F_TYPE,'fd'=>array('$exists'=>true)),array(),array('sort'=>array('_id'=>-1),'limit'=>20),false));
	$template->assign('msn',$msn);
	_::$content=$template->fetch(F_TYPE);
	$cache->set('ca1','friend_home_'.F_TYPE,_::$content,false,3600);
}

_::$yengo=array(53880,54000);

?>