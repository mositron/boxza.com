<?php

$template->assign('user',_::db()->find('matching_user',array('dd'=>array('$exists'=>false)),array('_id'=>1,'name'=>1,'fb'=>1,'score'=>1,'lv'=>1),array('sort'=>array('score'=>-1,'lv'=>-1,'_id'=>1),'limit'=>100)));

$template->assign('parent','/matching');
_::$content=$template->fetch('matching.top');

?>
