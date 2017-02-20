<?php

//_::time();

$db=_::db();
$set=$db->find('lotto_set',array(),array(),array('sort'=>array('_id'=>-1),'limit'=>31));

$index=$db->findone('msg',array('_id'=>'lotto_set'));

$template=_::template();

$template->assign('set',$set);
$template->assign('parent','/mobile');

_::$content=$template->fetch('mobile.set');

?>