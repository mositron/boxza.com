<?php


$db=_::db();
$cooked=$db->find('cooked_line',array('dd'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>-1),'limit'=>50));

$template->assign('parent','/cooked');
$template->assign('cooked',$cooked);
_::$content=$template->fetch('cooked.share');


?>