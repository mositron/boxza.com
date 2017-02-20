<?php
_::session()->logged();

$c=FORUM_ID;

if(!_::$my['st'] || _::$my['st']<1)
{
	_::move('http://boxza.com/verify');
}


if(!isset($cate[$c]) || !$cate[$c]['n'] || ($cate[$c]['n']==2 && !_::$my['am']))
{
	_::move(FORUM_URL);
}

$template->assign('post',array());

if($_POST)
{
	require_once(__DIR__.'/forum.new-topic.post.php');
}

$template->assign('place',array());	
$template->assign('people',array());	
$template->assign('c',$c);
_::$content=$template->fetch2(FORUM_TPL.'new-topic');

?>