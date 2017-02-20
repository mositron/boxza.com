<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/mobile');

_::$content=$template->fetch('mobile.apps');
?>