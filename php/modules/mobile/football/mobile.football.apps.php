<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/football');

_::$content=$template->fetch('football.apps');
?>