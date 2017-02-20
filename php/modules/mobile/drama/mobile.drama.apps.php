<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/drama');

_::$content=$template->fetch('drama.apps');
?>