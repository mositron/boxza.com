<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/hidden');

_::$content=$template->fetch('hidden.apps');
?>