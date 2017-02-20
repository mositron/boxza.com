<?php

_::session()->logged();

$db=_::db();
if(!$video=$db->findone('video_playlist',array('_id'=>intval(_::$path[0]),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false))))
{
	_::move('/');
}
_::ajax()->register('updatevideo');


$c1 = 0;
$c2 = 0;
$c3 = 0;
$c = $db->findone('video_cate',array('_id'=>$video['c']));
if($c['lv']==2)
{
	$c1 = $c['p0'];
	$c2 = $c['p1'];
	$c3 = $video['c'];
}
elseif($c['lv']==1)
{
	$c1 = $c['p0'];
	$c2 = $video['c'];
}
$template->assign('c1',$c1);
$template->assign('c2',$c2);
$template->assign('c3',$c3);
$template->assign('video',$video);
_::$content=$template->fetch('update');


function updatevideo($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$cate=intval($arg['cate3']?$arg['cate3']:$arg['cate2']);
	if(!$cate)
	{
		$ajax->alert('กรุณาเลือกหมวดวิดีโอ');
	}
	elseif($db->findone('video_cate',array('$or'=>array(array('p0'=>$cate),array('p1'=>$cate)))))
	{
		$ajax->alert('กรุณาเลือกหมวดให้ถูกต้อง');
	}
	elseif(!trim($arg['title']))
	{
		$ajax->alert('กรุณากรอกชื่อวิดีโอ');
	}
	elseif(!trim($arg['detail']))
	{
		$ajax->alert('กรุณากรอกคำอธิบายเพิ่มเติมเกี่ยวกับวิดีโอนี้');
	}
	else
	{
		$title=trim(mb_substr(strip_tags($arg['title']),0,100,'utf-8'));
		$content=trim(mb_substr(strip_tags($arg['content']),0,500,'utf-8'));
		$detail=trim(mb_substr(strip_tags($arg['detail']),0,500,'utf-8'));
		
		$link=_::format()->link(strtolower($title));
		if(!$link)$link='video';
						
		$db->update('video',array('_id'=>intval(_::$path[0])),array('$set'=>array('t'=>$title,'m'=>$content,'d'=>$detail,'l'=>$link,'c'=>$cate)));
		$ajax->redirect('/update/'.intval(_::$path[0]).'?completed');	
	}
}
?>