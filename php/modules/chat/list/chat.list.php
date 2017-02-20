<?php

//_::move('/',true);

$template->assign('getchat',getchat());
_::$content=$template->fetch('list');


function getchat($page=1)
{
	//_::time();
	$rows = 30;
	$all=array('order','by','search','page');
	
	extract(_::split()->get('/list/',0,$all));
	
	$arg = array('pl'=>1,'dd'=>array('$exists'=>false));
	
	$db=_::db();
	if($count=$db->count('chatroom',$arg))
	{
		list($pg,$skip)=_::pager()->bootstrap($rows,$count,array($url,'page-'),$page);
		$chat=$db->find('chatroom',$arg,array('_id'=>1,'n'=>1,'w'=>1,'u'=>1,'da'=>1,'cu'=>1,'cv'=>1,'du'=>1,'l'=>1),array('skip'=>$skip,'limit'=>$rows,'sort'=>array('du'=>-1)));
	}
	
	$template=_::template();
	$template->assign(array('chat'=>$chat,'pager'=>$pg,'count'=>number_format($count)));
	$template->assign('user',_::user());
	return $template->fetch('list.list');
}

?>