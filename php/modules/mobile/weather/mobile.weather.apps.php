<?php

//_::link();
//_::time();
$db=_::db();


$template->assign('parent','/weather');

_::$content=$template->fetch('weather.apps');
?>