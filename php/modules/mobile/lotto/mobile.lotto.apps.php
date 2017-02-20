<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/lotto');

_::$content=$template->fetch('lotto.apps');
?>