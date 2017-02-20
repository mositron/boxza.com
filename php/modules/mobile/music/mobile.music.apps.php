<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/music');

_::$content=$template->fetch('music.apps');
?>