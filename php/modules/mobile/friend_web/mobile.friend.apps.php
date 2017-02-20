<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/friend');

_::$content=$template->fetch('friend.apps');
?>