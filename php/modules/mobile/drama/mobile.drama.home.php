<?php


$template->assign('tv',_::db()->find('tvreturn',array('dd'=>array('$exists'=>false),'type'=>'drama'),array('_id'=>1,'name'=>1,'img'=>1,'last'=>1,'count'=>1),array('sort'=>array('order'=>-1),'limit'=>50)));


_::$content=$template->fetch('drama.home');



?>
