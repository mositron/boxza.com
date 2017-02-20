<?php

# check session/login
_::session();

$template=_::template();

_::$content = $template->fetch('home');
?>