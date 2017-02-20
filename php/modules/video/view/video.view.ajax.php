<?php

function getplaylist($page=1)
{
	if(_::$my)
	{
		$db=_::db();
		$template=_::template();
		$arg = array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
		$playlist=$db->find('video_playlist',$arg,array('_id'=>1,'t'=>1,'l'=>1,'v'=>1),array('sort'=>array('da'=>-1)));
		$template->assign('count',$count);
		$template->assign('playlist',$playlist);
		_::ajax()->jquery('#getplaylist','html',$template->fetch('view.playlist'));
	}
	else
	{
		_::ajax()->alert('กรุณาล็อคอินก่อนทำการเพิ่มวิดีโอเข้าเพลย์ลิส');
	}
}

function newplaylist($arg)
{
	$ajax=_::ajax();
	if(_::$my)
	{
		$title=trim(mb_substr(trim($arg['title']),0,100,'utf-8'));
		if(!$title)
		{
			$ajax->alert('กรุณากรอกชื่อเพลย์ลิส');
		}
		elseif(_::db()->findone('video_playlist',array('u'=>_::$my['_id'],'t'=>$title)))
		{
			$ajax->alert('คุณมีชื่อเพลย์ลิสนี้อยู่แล้ว');
		}
		else
		{	
			$link=_::format()->link(strtolower($title));
			if(!$link)$link='playlist';
			_::db()->insert('video_playlist',array('u'=>_::$my['_id'],'d'=>'','l'=>$link,'t'=>$title,'c'=>0,'v'=>array()));
			getplaylist();
		}
	}
	else
	{
		_::ajax()->alert('กรุณาล็อคอินก่อนทำการเพิ่มวิดีโอเข้าเพลย์ลิส');
	}
}

function addtoplaylist($id)
{
	//playlist-add-
	if(_::$my)
	{
		$db=_::db();
		if($p=$db->findone('video_playlist',array('_id'=>intval($id),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false))))
		{
			if(!in_array(VIDEO_ID,(array)$p['v']))
			{
				$db->update('video_playlist',array('_id'=>intval($id)),array('$push'=>array('v'=>VIDEO_ID)));
			}
			_::ajax()->jquery('.playlist-add-'.$id,'replaceWith','<span class="btn">มีวิดีโอนี้แล้ว</span> ');
		}
	}
	else
	{
		_::ajax()->alert('กรุณาล็อคอินก่อนทำการเพิ่มวิดีโอเข้าเพลย์ลิส');
	}
}
?>