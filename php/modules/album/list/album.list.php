<?php

$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($c) && !isset(_::$config['album'][$c]))
{
	unset($c);
}

$_=array('dd'=>array('$exists'=>false),'pt.cv'=>array('$exists'=>true),'ty'=>'album','in'=>0);
if($c)
{
	$_['pt.ty']=intval($c);
	_::$meta['title']='อัลบั้มรูปภาพ ประเภท'._::$config['album'][$c];
}

_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

$album=array();
if($count=$db->count('line',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(40,$count,array($url,'page-'),$page);
	$album=$db->find('line',$_,array('_id'=>1,'tt'=>1,'lo'=>1,'pt'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>40));
}

$template->assign('c',$c);
$template->assign('album',$album);
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