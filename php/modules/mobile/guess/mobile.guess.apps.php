<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/guess');

_::$content=$template->fetch('guess.apps');
?>