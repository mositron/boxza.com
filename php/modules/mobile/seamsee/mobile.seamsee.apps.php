<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/seamsee');

_::$content=$template->fetch('seamsee.apps');
?>