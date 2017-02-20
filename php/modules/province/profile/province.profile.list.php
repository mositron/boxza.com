<?php


extract(_::split()->get($p.'/('.WORD_SPLIT.')',PLACE_SPLIT,array('page')));


$_=array('pl'=>1,'ty'=>5);	

$c=0;
if(WORD_SPLIT!='ทั้งหมด')
{
	$c=$_['c']=intval($clink[WORD_SPLIT]);
}

if($place['ty']==1)
{
	$_['p1']=$place['_ky'];
}
elseif($place['ty']==2)
{
	$_['p2']=$place['_ky'];
	$_['p1']=$place['p1'];
}
elseif($place['ty']==3)
{
	$_['p3']=$place['_ky'];
	$_['p2']=$place['p2'];
	$_['p1']=$place['p1'];
}
elseif($place['ty']==4)
{
	$_['p4']=$place['_ky'];
	$_['p3']=$place['p3'];
	$_['p2']=$place['p2'];
	$_['p1']=$place['p1'];
}

if($count=$db->count('place',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(50,$count,array($url,'/page-'),$page);
	$build=$db->find('place',$_,array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1),array('sort'=>array('du'=>-1),'skip'=>$skip,'limit'=>50));
}

$template->assign('c',$c);
$template->assign('build',$build);
$template->assign('count',$count);
$template->assign('pager',$pg);

$template->assign('page',$template->fetch('profile.list'));
?>