<?php
define('HIDE_SIDEBAR',1);

_::ajax()->register(array('visible'));


$template->assign('getimage',getimage());
_::$content=$template->fetch('fbimage');


function getimage($page=1)
{
	_::time();
	$rows = 100;
	$allorder = array('_id'=>'#','p'=>'รูปภาพ','t'=>'คำถาม','s'=>'สถานะ');
	$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
	$all=array('order','by','search','page');
	
	extract(_::split()->get('/fbimage/',0,$all,$allorder,$allby));
	
	$arg = array();
	
	
	$db=_::db();
	if($count=$db->count('fbimage2',$arg))
	{
		list($pg,$skip)=_::pager()->bootstrap($rows,$count,array($url,'page-'),$page);
		$images=$db->find('fbimage2',$arg,array(),array('skip'=>$skip,'limit'=>$rows,'sort'=>array($order=>($by=='desc'?-1:1))));
	}
	
	$template=_::template();
	$template->assign(array('images'=>$images,'pager'=>$pg,'count'=>number_format($count)));
	for($i=0;$i<count($all);$i++)if(${$all[$i]}) $template->assign($all[$i],${$all[$i]});
	return $template->fetch('fbimage.list');
}


function visible($i,$v=0)
{
	$db=_::db();
	$arg=array('_id'=>intval($i));
	if($v)
	{
		$db->update('fbimage2',$arg,array('$unset'=>array('dd'=>1)));
	}
	else
	{
		$db->update('fbimage2',$arg,array('$set'=>array('dd'=>new MongoDate())));
	}
	
	_::ajax()->jquery('#getimage','html',getimage());
}

?>