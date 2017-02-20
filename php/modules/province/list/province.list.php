<?php

define('HIDE_SIDEBAR',1);


//_::time();
//_::link();
$db=_::db();


extract(_::split()->get('/('.WORD_SPLIT.')',1,array('page')));


$_=array('pl'=>1,'ty'=>5,'p2'=>$province['_ky']);	

$c=0;
if(WORD_SPLIT!='ทั้งหมด')
{
	$c=$_['c']=intval($clink[WORD_SPLIT]);
}

if($count=$db->count('place',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(50,$count,array($url,'/page-'),$page);
	$build=$db->find('place',$_,array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1,'c'=>1,'zip'=>1),array('sort'=>array('du'=>-1),'skip'=>$skip,'limit'=>50));
}

$template->assign('c',$c);
$template->assign('build',$build);
$template->assign('count',$count);
$template->assign('pager',$pg);

_::$content=$template->fetch('list');
?>