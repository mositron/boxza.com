<?php

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/music/song/',1,array('sn','ar','q','page')));

$sort=array('_id'=>-1);
$_=array('dd'=>array('$exists'=>false));

if(isset($q))
{
	if($q=trim($q))
	{
		$qr=new MongoRegex('/'.trim($q).'/i');
		$_['$or']=array(array('sn'=>$qr),array('al'=>$qr),array('ar'=>$qr));
	}
	else
	{
		unset($q);
	}
}
elseif(isset($sn))
{
	$sort=array('sn'=>1);
	$_['fc.sn']=$sn;
}
elseif(isset($ar))
{
	$sort=array('ar'=>1);
	$_['fc.ar']=$ar;
}

$pp=50;
if(!$page || $page<1)
{
	$page=1;
}
if($count=$db->count('music',$_))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array($url,'page-'),$page);
	$music=$db->find('music',$_,array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1),array('sort'=>$sort,'skip'=>$skip,'limit'=>$pp));
}

$template->assign('c',$c);
$template->assign('music',$music);
$template->assign('pager',$pg);
$template->assign('sn',$sn);
$template->assign('ar',$ar);
$template->assign('q',$q);

$template->assign('parent','/music');
$template->assign('page',$page);
$template->assign('maxpage',ceil($count/$pp));
$template->assign('cur','?parent='.urlencode(URL));


_::$content=$template->fetch('music.song.home');

?>