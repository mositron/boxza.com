<?php

//_::time();

_::ajax()->register(array('delday','newday'),'admin.home');

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c'),array('ds'=>'อัพเดทล่าสุด'),$allby));

$url='/admin/';

$db=_::db();
extract(_::split()->get('/admin/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if($count=$db->count('calendar',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(30,$count,array($url,'page-'),$page);
	$day=$db->find('calendar',$arg,array('_id'=>1,'n'=>1,'day'=>1,'month'=>1,'year'=>1,'do'=>1,'da'=>1,'fd'=>1),array('skip'=>$skip,'limit'=>30,'sort'=>array('_id'=>-1)));
}

$template->assign('count',$count);
$template->assign('day',$day);
$template->assign('pager',$pg);
$template->assign('user',_::user());
_::$content=$template->fetch('admin');





?>