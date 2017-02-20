<?php

//_::$meta['google']=array('id'=>'112235668332689047152');


$db=_::db();
$template=_::template();

$template->assign('about',$db->find('about',array('pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'lk'=>1,'du'=>1,'da'=>1),array('sort'=>array('du'=>-1),'limit'=>24)));
_::$content=$template->fetch('home');

?>