<?php

define('HIDE_SIDEBAR',1);
//_::$meta['google']=array('id'=>'112235668332689047152');

//_::time();
//_::link();

$db=_::db();
$template=_::template();

$hot=$db->findone('people',array('pl'=>1,'pr'=>1));
$template->assign('hot',$hot);
$template->assign('hnews',$db->find('news',array('pl'=>1,'people'=>$hot['_id']),array('_id'=>1,'c'=>1,'cs'=>1,'t'=>1,'fd'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>4)));
$template->assign('people',$db->find('people',array('pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'n'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'fd'=>1,'lk'=>1),array('sort'=>array('_id'=>-1),'limit'=>24)));
_::$content=$template->fetch('home');

?>