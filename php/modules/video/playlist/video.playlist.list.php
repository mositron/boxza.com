<?php

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
$all=array('order','by','search','page','day','month','year','position','category');
extract(_::split()->get('/',0,array('z','p','c','t','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

$_=array('dd'=>array('$exists'=>false));

$c1=0;
$c2=0;
$c3=0;
if($c)
{
	if($cs=$acate[$c])
	{
		if($cs['lv']==2)
		{
			$c1 = $cs['p0'];
			$c2 = $cs['p1'];
			$c3 = $cs['_id'];
		}
		elseif($cs['lv']==1)
		{
			$c1 = $cs['p0'];
			$c2 = $cs['_id'];
		}
		else
		{
			$c1 = $cs['_id'];
		}
		$_['c']=array('$in'=>(array)$cs['in']);
	
		print_r($_['c']);
		_::$meta['title']=$cs['t'].' '._::$meta['title'];
	}
	else
	{
		unset($c);
	}
}

$video=$db->find('video',$_,array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'c'=>1,'cs'=>1,'n'=>1,'dr'=>1),array('sort'=>array('ds'=>-1,'limit'=>20)));


$template->assign('c',$c);
$template->assign('c1',$c1);
$template->assign('c2',$c2);
$template->assign('c3',$c3);
$template->assign('video',$video);
_::$content=$template->fetch('list');
