<?php

_::session()->logged();

$db=_::db();
$arg=array('_id'=>intval(_::$path[1]),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
if(_::$my['am']>=9)
{
	unset($arg['u']);
}
if(!$playlist=$db->findone('video_playlist',$arg))
{
	_::move('/');
}
_::ajax()->register(array('updateplaylist'));


$c1 = 0;
$c2 = 0;
$c3 = 0;
if($cs=$acate[$playlist['c']])
{
	if($cs['lv']==2)
	{
		$c1 = $cs['p0'];
		$c2 = $cs['p1'];
		$c3 = $cs['_id'];
	}
	elseif($cs['lv']==1)
	{
		$c1 = $cs['p0'];
		$c2 = $cs['_id'];
	}
	else
	{
		$c1 = $cs['_id'];
	}
}
$video=array();
if($playlist['v'])
{
	$tmp=$db->find('video',array('_id'=>array('$in'=>(array)$playlist['v']),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'f'=>1,'n'=>1,'l'=>1,'dr'=>1));
	$tmp2=array();
	for($i=0;$i<count($tmp);$i++)
	{
		$tmp2[$tmp[$i]['_id']]=$tmp[$i];
	}
	for($i=0;$i<count($playlist['v']);$i++)
	{
		if($tmp2[$playlist['v'][$i]])
		{
			$video[]=$tmp2[$playlist['v'][$i]];
		}
		else
		{
			$video[]=false;
		}
	}
}
$template->assign('c1',$c1);
$template->assign('c2',$c2);
$template->assign('c3',$c3);
$template->assign('playlist',$playlist);
$template->assign('video',$video);
_::$content=$template->fetch('manage.playlist.update');


function updateplaylist($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$cate=intval($arg['cate3']?$arg['cate3']:$arg['cate2']);
	if(!trim($arg['title']))
	{
		$ajax->alert('กรุณากรอกชื่อเพลย์ลิส');
	}
	else
	{
		$title=trim(mb_substr(strip_tags($arg['title']),0,100,'utf-8'));
		$detail=trim(mb_substr(strip_tags($arg['detail']),0,500,'utf-8'));
		$v=(array)$arg['video'];
		$video=array();
		foreach($v as $t)
		{
			$video[]=intval($t);
		}
		$video=array_values(array_filter(array_unique($video)));
		$link=_::format()->link(strtolower($title));
		if(!$link)$link='playlist';
						
		$db->update('video_playlist',array('_id'=>intval(_::$path[1])),array('$set'=>array('t'=>$title,'d'=>$detail,'l'=>$link,'c'=>$cate,'v'=>$video)));
		$ajax->redirect('/manage/playlist/'._::$path[1].'?completed');	
	}
}
?>