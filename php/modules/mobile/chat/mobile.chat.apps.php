<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/chat');

_::$content=$template->fetch('chat.apps');
?>