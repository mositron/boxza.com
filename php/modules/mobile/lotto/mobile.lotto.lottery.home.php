<?php

//_::time();
$db=_::db();

$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1,'l'=>1,'a2'=>1,'a3'=>1,'a4'=>1,'a5'=>1),array('sort'=>array('tm'=>-1),'limit'=>24));

$template->assign('parent','/lotto');
$template->assign('lotto',$lotto);

_::$content=$template->fetch('lotto.lottery.home');

?>