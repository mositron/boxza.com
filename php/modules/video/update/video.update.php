<?php

_::session()->logged();

$db=_::db();
$arg=array('_id'=>intval(_::$path[0]),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
if(_::$my['am'])
{
	unset($arg['u']);
}
if(!$video=$db->findone('video',$arg))
{
	_::move('/');
}
_::ajax()->register('updatevideo');


$c1 = 0;
$c2 = 0;
$c3 = 0;

if($cs=$acate[$video['c']])
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


$template->assign('c1',$c1);
$template->assign('c2',$c2);
$template->assign('c3',$c3);
$template->assign('video',$video);
_::$content=$template->fetch('update');


function updatevideo($arg)
{
	global $video;
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
		$upd=array('t'=>$title,'m'=>$content,'d'=>$detail,'l'=>$link,'c'=>$cate);
		if(_::$my['am'])
		{
			$upd['rc']=intval($arg['recommend']);
			_::cache()->delete('ca1','home',0);
		}
		$db->update('video',array('_id'=>intval(_::$path[0])),array('$set'=>$upd));

		_::tags()->update($arg['tags'], 'video', intval(_::$path[0]), $title,$content,'http://video.boxza.com/'.intval(_::$path[0]).'-'.$link.'.html','http://s3.boxza.com/video/'.$video['f'].'/'.$video['n'],$cate,$video['da']);
		
		$ajax->redirect('/update/'.intval(_::$path[0]).'?completed');	
	}
}
?>