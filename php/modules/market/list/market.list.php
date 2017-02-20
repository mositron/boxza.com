<?php

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
$all=array('order','by','search','page','day','month','year','position','category');
extract(_::split()->get('/',0,array('z','p','c','t','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($z) && !isset($zone[$z]))
{
	unset($z);
}
if(isset($p) && !isset($province[$p]))
{
	unset($p);
}
if(isset($c) && !isset($acate[$c]))
{
	unset($c);
}
if(isset($t) && !isset($type[$t]))
{
	unset($t);
}

$_=array('dd'=>array('$exists'=>false),'pl'=>1);
if($z)
{
	$_['pr']=array('$in'=>$zone[$z]['l']);
}
elseif($p)
{
	$_['pr']=intval($p);
}
if($c)
{
	$_['$or']=array(array('c'=>intval($c)),array('cs'=>intval($c)));
}

if(isset($p))
{
	$tm=$db->findone('deal_province',array('_id'=>intval($p)));
	$z=$tm['z'];
}

if($t)
{
	$_['ty']=$t;
}
if($c&&$p)
{
	_::$meta['title']='ลงประกาศฟรี '.($t?$type[$t].' ':'').($acate[$c]['p']?$acate[$acate[$c]['p']]['t'].'('.$acate[$c]['t'].')':$acate[$c]['t']).'ในจังหวัด'.$province[$p]['name_th'];
}
elseif($c&&$z)
{
	_::$meta['title']='ลงประกาศฟรี '.($t?$type[$t].' ':'').($acate[$c]['p']?$acate[$acate[$c]['p']]['t'].'('.$acate[$c]['t'].')':$acate[$c]['t']).'ใน'.$zone[$z]['n'];
}
elseif($c)
{
	_::$meta['title']='ลงประกาศฟรี '.($t?$type[$t].' ':'').($acate[$c]['p']?$acate[$acate[$c]['p']]['t'].'('.$acate[$c]['t'].')':$acate[$c]['t']);
}
elseif($p)
{
	_::$meta['title']='ลงประกาศฟรี '.($t?$type[$t].' ':'').'สินค้าทั้งหมดในจังหวัด'.$province[$p]['name_th'];
}
elseif($z)
{
	_::$meta['title']='ลงประกาศฟรี '.($t?$type[$t].' ':'').'สินค้าทั้งหมดใน'.$zone[$z]['n'];
}
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

if($count=$db->count('deal',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(40,$count,array($url,'page-'),$page);
	$last=$db->find('deal',$_,array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('ds'=>-1),'skip'=>$skip,'limit'=>40));
}

$template->assign('z',$z);
$template->assign('p',$p);
$template->assign('c',$c);
$template->assign('t',$t);
$template->assign('last',$last);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

/*
# เหนือ
							'5','13','14','23','26','34','37','38','40','41','45','53','54','75','76'
# ออก
							'7','8','9','16','31','50',
# อีสาน
							'4','6','11','20','21','27','28','43','44','46','48','55','56','57','63','69','70','71','73','74','77',
# ตก
							'3','17','30','39','51',
# กลาง
							'2','10','18','19','24','29','33','52','60','61','62','64','65','66','67','72',
# ใต้
							'1','12','15','22','25','32','35','36','42','47','49','58','59','68',
*/