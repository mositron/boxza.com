<?php
define('HIDE_REQUEST',1);

$pp=50;

$db=_::db();

$image=$db->find('fbimage',array('ds'=>array('$gte'=>new mongodate(time()-3600*24)),'dd'=>array('$exists'=>false)),array(),array('sort'=>array('sh'=>-1),'limit'=>50));

$template=_::template();
$template->assign('parent','/fbimage');
$template->assign('image',$image);
_::$content=$template->fetch('fbimage.hit');

?>