<?php
$template=_::template();
#$template->assign('site',$site);


_::$content=$template->fetch('unsubscribe');

_::template()->display('content');
exit;

?>