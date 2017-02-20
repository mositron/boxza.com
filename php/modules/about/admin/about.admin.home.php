<?php

//_::time();

_::ajax()->register(array('delabout','newabout'),'admin.home');

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c'),array('ds'=>'อัพเดทล่าสุด'),$allby));

$url='/admin/';

$db=_::db();
extract(_::split()->get('/admin/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if($count=$db->count('about',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(50,$count,array($url,'page-'),$page);
	$about=$db->find('about',$arg,array('_id'=>1,'t'=>1,'u'=>1,'do'=>1,'da'=>1,'fd'=>1,'lk'=>1),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
}

$template->assign('count',$count);
$template->assign('about',$about);
$template->assign('pager',$pg);
$template->assign('user',_::user());
_::$content=$template->fetch('admin.home');





?>