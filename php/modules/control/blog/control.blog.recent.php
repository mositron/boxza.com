<?php

extract(_::split()->get('/',1,array('page')));


$db=_::db();
$user=_::user();


if($count=$db->count('wpbg'))
{
	list($pg,$skip)=_::pager()->bootstrap(100,$count,array('/recent/page-'),$page);
	$lastseo=$db->find('wpbg',array(),array(),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>100));
}

$template=_::template();
$template->assign('user',$user);
$template->assign('lastseo',$lastseo);
$template->assign('pager',$pg);

_::$content=$template->fetch('blog.recent');

?>