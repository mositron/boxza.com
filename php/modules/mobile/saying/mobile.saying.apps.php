<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/saying');

_::$content=$template->fetch('saying.apps');
?>