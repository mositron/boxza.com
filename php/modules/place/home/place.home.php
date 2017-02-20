<?php

define('HIDE_SIDEBAR',1);
//_::$meta['google']=array('id'=>'112235668332689047152');

//_::time();
//_::link();

$db=_::db();
$template=_::template();

$hot=$db->findone('place',array('pl'=>1,'pr'=>1));
$template->assign('hot',$hot);
$template->assign('hnews',(array)$db->find('news',array('pl'=>1,'place'=>$hot['_id']),array('_id'=>1,'c'=>1,'cs'=>1,'t'=>1,'fd'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
$template->assign('place',(array)$db->find('place',array('pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'n'=>1,'fd'=>1,'lk'=>1,'tt'=>1,'ty'=>1),array('sort'=>array('_id'=>-1),'limit'=>24)));
_::$content=$template->fetch('home');

?>