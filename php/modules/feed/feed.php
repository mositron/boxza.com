<?php

# check session/login
_::session();

//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-chat.png';
_::$meta['title'] = 'BoxZa Feed - บริการข้อมูลภายใน boxza.com';
_::$meta['description'] = 'BoxZa Feed - ศูนย์รวมข้อมูลต่างๆภายใน boxza.com เพื่อนำไปใช้งานต่อภายในเว็บของคุณ';
_::$meta['keywords'] = 'boxza, feed, ข้อมูล, ศูนย์รวม, data';


$template=_::template();
require_once(
									_::run(
													array(
																	'' => 'home',
													),
													true,
													function()
													{
														define('MODULE','data');
													}
								)
);

$template->display('content');


/*
http://feed.boxza.com/news/iframe


*/
?>