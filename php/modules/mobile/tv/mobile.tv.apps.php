<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/tv');

_::$content=$template->fetch('tv.apps');
?>