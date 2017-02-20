<?php
_::session()->logged();

$db=_::db();
$user=_::user();
$tmp=array();
$notify = $db->find('notify',array('p'=>_::$my['_id']),array('_id'=>1,'u'=>1,'p'=>1,'ty'=>1,'dr'=>1,'tt'=>1,'da'=>1,'rl'=>1),array('sort'=>array('da'=>-1),'limit'=>100),false);


if(_::$my['nf']['fr'] || _::$my['nf']['ot'])
{
	$db->update('notify',array('p'=>_::$my['_id'],'dr'=>array('$exists'=>false)),array('$set'=>array('dr'=>new MongoDate())),array('multiple'=>true));
	$user->update(_::$my['_id'],array('$set'=>array('nf' => array('fr'=>0,'ot'=>0))));
}

$template=_::template();
$template->assign('user',$user);
$template->assign('notify',$notify);
$template->assign('service',_::sidebar()->service(array('line'=>1)));
_::$content=$template->fetch('notifications');


_::$meta['title'] = 'แจ้งเตือน - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'แจ้งเตือน - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'แจ้งเตือน, สังคมออนไลน์';
?>