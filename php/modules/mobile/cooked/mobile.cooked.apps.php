<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/cooked');

_::$content=$template->fetch('cooked.apps');
?>