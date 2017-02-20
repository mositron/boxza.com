<?php

//_::time();

_::ajax()->register(array('delpeople','newpeople'),'admin.home');

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c'),array('ds'=>'อัพเดทล่าสุด'),$allby));

$url='/admin/';

$db=_::db();
extract(_::split()->get('/admin/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if($count=$db->count('people',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(50,$count,array($url,'page-'),$page);
	$people=$db->find('people',$arg,array('_id'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'u'=>1,'do'=>1,'da'=>1,'fd'=>1,'lk'=>1),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
}

$template->assign('count',$count);
$template->assign('people',$people);
$template->assign('pager',$pg);
$template->assign('user',_::user());
_::$content=$template->fetch('admin.home');





?>