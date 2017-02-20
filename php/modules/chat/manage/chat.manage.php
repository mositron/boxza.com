<?php
_::session()->logged();

$template=_::template();
$template->assign('html',_::html());

if(is_numeric(_::$path[0]))
{
	require_once(__DIR__.'/chat.manage.view.php');
}
else
{
	require_once(__DIR__.'/chat.manage.home.php');
}
?>