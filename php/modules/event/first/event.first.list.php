<?php



extract(_::split()->get('/first/list/',1,['page']));


$db=_::db();
$_=['dd'=>['$exists'=>false],'dl'=>['$exists'=>false],'ev'=>EVENT_KEY];
if($count=$db->count('event',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(100,$count,array($url,'page-'),$page);
	$last=$db->find('event',$_,['_id'=>1,'n'=>1,'t'=>1,'ty'=>1,'fd'=>1,'pf'=>1],['sort'=>['_id'=>-1],'limit'=>100]);
}
$template->assign('last',$last);
$template->assign('count',$count);
$template->assign('pager',$pg);

$content=$template->fetch('first.list');


?>