<?php

$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('page'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($clink[MODULE_LINK]))
{
	$c=$clink[MODULE_LINK];
}
else
{
	_::move('/');
}
$_=array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>intval($c));

_::$meta['title']='ละคร'.$cate[$c]['t'].' - '._::$meta['title'];
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

//_::$meta['rss']='http://feed.boxza.com/drama-'.$c.'/rss';


if($count=$db->count('drama',$_))
{
	list($pg,$skip)=_::pager()->bootstrap(80,$count,array('/'._::$path[0],'/page-'),$page);
	$drama=$db->find('drama',$_,array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'lk'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>80));
}

$template->assign('c',$c);
$template->assign('drama',$drama);
$template->assign('pager',$pg);
_::$content=$template->fetch('list');

?>