<?php
list($id,$link)=explode('-',_::$path[0],2);

$db=_::db();
if(!$playlist=$db->findone('video_playlist',array('_id'=>intval($id),'dd'=>array('$exists'=>false))))
{
	_::move('/playlist');
}

if(_::$path[0]!=$playlist['_id'].'-'.$playlist['l'].'.html')
{
	_::move('/playlist/'.$playlist['_id'].'-'.$playlist['l'].'.html');
}

define('PLAYLIST_ID',$playlist['_id']);

$db->update('video_playlist',array('_id'=>intval($id)),array('$set'=>array('do'=>intval($playlist['do'])+1)));


$video=array();
if($playlist['v'])
{
	$tmp=$db->find('video',array('_id'=>array('$in'=>(array)$playlist['v']),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'f'=>1,'n'=>1,'l'=>1,'dr'=>1,'do'=>1));
	$tmp2=array();
	$img=false;
	for($i=0;$i<count($tmp);$i++)
	{
		$tmp2[$tmp[$i]['_id']]=$tmp[$i];
	}
	for($i=0;$i<count($playlist['v']);$i++)
	{
		if($tmp2[$playlist['v'][$i]])
		{
			if(!$img)$img='http://s3.boxza.com/video/'.$tmp2[$playlist['v'][$i]]['f'].'/'.$tmp2[$playlist['v'][$i]]['n'];
			$video[]=$tmp2[$playlist['v'][$i]];
		}
	}
	if($img)_::$meta['image']=$img;
}

_::$meta['title']=$playlist['t'].' '.วิดีโอเพลย์ลิส.' - '._::$meta['title'];



$c1=0;
$c2=0;
$c3=0;

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

$template->assign('c1',$c1);
$template->assign('c2',$c2);
$template->assign('c3',$c3);
$template->assign('playlist',$playlist);
$template->assign('video',$video);
$template->assign('c',$playlist['c']);
$template->assign('user',_::user()->profile($playlist['u']));
_::$content=$template->fetch('playlist.view');
?>