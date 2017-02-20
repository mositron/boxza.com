<?php

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('z','c','t','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($c) && !isset($cate[$c]))
{
	unset($c);
}
if(isset($t) && !isset($type[$t]))
{
	unset($t);
}
if(isset($z) && !isset($zone[$z]))
{
	unset($z);
}

$_=array('dd'=>array('$exists'=>false),'pl'=>1);
if($c)
{
	$_['c']=$c;
}
if($t)
{
	$_['ty']=$t;
}

$tt=_::$meta['title'];
_::$meta['title']='หนัง '.($c?str_replace(' - ','(',$cate[$c]).') ':'').($t?' '.$type[$t]:'').($z?' '.$zone[$z]:'').' ดูหนังออนไลน์ - '._::$meta['title'];

$sorttm = -1;

if($z)
{
	$tm = strtotime(date('Y-m-d'));
	if($z=='now-showing')
	{
		_::$meta['title']='หนังใหม่ '.($c?str_replace(' - ','(',$cate[$c]).') ':'').($t?' '.$type[$t]:'').($z?' '.$zone[$z]:'').' - '.$tt;
		$_['tm']=array('$lte'=>new MongoDate($tm),'$gte'=>new MongoDate($tm-(3600*24*7*4)));
	}
	else
	{
		$sorttm = 1;
		_::$meta['title']='โปรแกรมหน้า '.($c?str_replace(' - ','(',$cate[$c]).') ':'').($t?' '.$type[$t]:'').($z?' '.$zone[$z]:'').' - '.$tt;
		$_['tm']=array('$gt'=>new MongoDate($tm));
	}
}

_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

if($count=$db->count('movie',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(20,$count,array($url,'page-'),$page);
	$last=$db->find('movie',$_,array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>$sorttm),array('sort'=>array('cs'=>-1,'tm'=>-1),'skip'=>$skip,'limit'=>20));
}

$template->assign('c',$c);
$template->assign('t',$t);
$template->assign('z',$z);
$template->assign('last',$last);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

?>