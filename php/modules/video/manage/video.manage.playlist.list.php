<?php

_::ajax()->register(array('newplaylist','delplaylist'));


$template->assign('getplaylist',getplaylist());
_::$content=$template->fetch('manage.playlist');


function getplaylist()
{
	extract(_::split()->get('/manage/playlist/',2,array('page')));
	//_::time();
	$db=_::db();
	$template=_::template();
	$arg = array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
	if($count=$db->count('video_playlist',$arg))
	{
		list($pg,$skip)=_::pager()->bootstrap(20,$count,array('/manage/playlist/','page-'),$page);
		$playlist=$db->find('video_playlist',$arg,array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'c'=>1,'v'=>1),array('skip'=>$skip,'limit'=>20,'sort'=>array('da'=>-1)));
	}
	$template->assign('count',$count);
	$template->assign('playlist',$playlist);
	$template->assign('pager',$pg);
	return $template->fetch('manage.playlist.list');
}


function newplaylist($arg)
{
	$ajax=_::ajax();
	$title=trim(mb_substr(trim($arg['title']),0,100,'utf-8'));
	if(!$title)
	{
		$ajax->alert('กรุณากรอกชื่อเพลย์ลิส');
	}
	elseif($db->findone('video_playlist',array('u'=>_::$my['_id'],'t'=>$title)))
	{
		$ajax->alert('คุณมีชื่อเพลย์ลิสนี้อยู่แล้ว');
	}
	else
	{	
		$link=_::format()->link(strtolower($title));
		if(!$link)$link='playlist';
		_::db()->insert('video_playlist',array('u'=>_::$my['_id'],'d'=>'','l'=>$link,'t'=>$title,'c'=>0,'v'=>array()));
		$ajax->jquery('#getplaylist','html',getplaylist());
	}
}

function delplaylist($id)
{
	_::db()->update('video_playlist',array('_id'=>intval($id),'u'=>_::$my['_id']),array('$set'=>array('dd'=>new MongoDate())));
	_::ajax()->jquery('#getplaylist','html',getplaylist());
}
?>