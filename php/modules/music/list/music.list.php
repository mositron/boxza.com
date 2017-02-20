<?php

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/list/',0,array('sn','ar','q','page')));

$sort=array('_id'=>-1);
$_=array('dd'=>array('$exists'=>false));

_::$meta['title']='เพลงใหม่ เนื้อเพลงใหม่ ค้นหาเนื้อเพลง เพลงใหม่ๆ เนื้อเพลงไทย เนื้อเพลงสากล เนื้อเพลงลูกทุ่ง '.($page>1?' หน้า '.$page:'');

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
	_::$meta['title']='เพลงใหม่ เนื้อเพลงใหม่ เรียงตามชื่อเพลง '.$sn.' '.($page>1?' หน้า '.$page:'').' เพลงใหม่ๆ ค้นหาเนื้อเพลง เนื้อเพลงไทย เนื้อเพลงสากล เนื้อเพลงลูกทุ่ง';
}
elseif(isset($ar))
{
	$sort=array('ar'=>1);
	$_['fc.ar']=$ar;
	_::$meta['title']='เพลงใหม่ เนื้อเพลงใหม่ เรียงตามชื่อศิลปิน '.$sn.' '.($page>1?' หน้า '.$page:'').' เพลงใหม่ๆ ค้นหาเนื้อเพลง เนื้อเพลงไทย เนื้อเพลงสากล เนื้อเพลงลูกทุ่ง';
}


_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

if($count=$db->count('music',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(110,$count,array($url,'page-'),$page);
	$music=$db->find('music',$_,array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1),array('sort'=>$sort,'skip'=>$skip,'limit'=>110));
}

$template->assign('c',$c);
$template->assign('music',$music);
$template->assign('pager',$pg);
$template->assign('sn',$sn);
$template->assign('ar',$ar);
$template->assign('q',$q);
_::$content=$template->fetch('list');

?>