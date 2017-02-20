<?php
_::session()->logged();
_::ajax()->register(array('morecredit'));

$template=_::template();
$template->assign('service',_::sidebar()->service());
$template->assign('getcredit',getcredit());

_::$content=$template->fetch('credit');


_::$meta['title'] = 'บ๊อก - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'บ๊อก - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'บ๊อก, สังคมออนไลน์';



function getcredit()
{
	//_::time();
	$per=50;
	$start=intval(trim($_GET['start']));
	
	$template=_::template();
	$res=_::db()->find('point',array('u'=>_::$my['_id']),array(),array('sort'=>array('_id'=>-1),'skip'=>$start,'limit'=>$per));
	$template->assign('point',$res);
	$template->assign('next', (count($res)==$per?$start+$per:''));
	return $template->fetch('credit.list');
}
function morecredit()
{
	_::ajax()->script('$("#getcredit .next").remove()');
	_::ajax()->jquery('#getcredit','append',getcredit());
}
?>