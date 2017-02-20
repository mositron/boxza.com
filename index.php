<?php
set_time_limit(1800);
ini_set('html_errors',0);
ini_set('display_errors',E_ALL & ~E_NOTICE);
error_reporting(E_ALL & ~E_NOTICE);
set_include_path(dirname(__FILE__).PATH_SEPARATOR.get_include_path());

require_once('../../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::session()->logged();

if(in_array(_::$my['_id'],array(1,6,8,21149,19385)))
{
	require_once(__DIR__.'/wpbg.php');
}
else
{
	echo '<h1>Account ของคุณ ไม่มีสิทธิ์ใช้งานส่วนนี้</h1>';
}

exit;
?>
