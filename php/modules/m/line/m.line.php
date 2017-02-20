<?php

////_::time();
_::ajax()->register(array('postshare','delline','delcm','getvar'),'line');


if($_POST)require_once(__DIR__.'/m.line.post.php');


_::$meta['title'] = 'ไลน์ - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'ไลน์ - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ไลน์, หาเพื่อน, สังคมออนไลน์, แชท, พูดคุย';


$template=_::template();
$template->assign('user',_::user());
$template->assign('line',_::profile()->line(array('uid'=>_::$my['_id']),_::$path[0]));
if(is_numeric(_::$path[0]))
{
	define('HIDE_PANEL',1);
	_::$content=$template->fetch('line.view');
	$template->display();
	exit;
}
else
{
	$template->assign('line',$template->fetch('line.list'));
	_::$content=$template->fetch('line');
}
		

	




?>