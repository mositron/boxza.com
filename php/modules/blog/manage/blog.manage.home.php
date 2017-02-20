<?php


_::ajax()->register(array('delnews','newnews'),'admin.home');


$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(!empty($c) && empty($cate[$c]))
{
	unset($c);
}

$url='/admin/';
//_::time();
$db=_::db();
extract(_::split()->get('/admin/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if(!_::$my['am'])
{
	$arg['u']=_::$my['_id'];
}
if($c)
{
	$arg['c']=intval($c);
	$url .= 'c-'.$c.'/';
}
if($count=$db->count('news',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(50,$count,array($url,'page-'),$page);
	$news=$db->find('news',$arg,array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'c'=>1,'cs'=>1,'ty'=>1,'tm'=>1,'pl'=>1,'do'=>1,'u'=>1,'da'=>1,'wt'=>1,'ds'=>1),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
}

$template->assign('count',$count);
$template->assign('news',$news);
$template->assign('pager',$pg);
$template->assign('user',_::user());
_::$content=$template->fetch('admin.home');





?>