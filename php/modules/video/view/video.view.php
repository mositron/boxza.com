<?php
//list($id,$link)=explode('-',_::$path[0],2);

$db=_::db();
if(!$video=$db->findone('video',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/');
}
/*
if(_::$path[0]!=$video['_id'].'-'.$video['l'].'.html')
{
	_::move('/'.$video['_id'].'-'.$video['l'].'.html');
}
*/

define('VIDEO_ID',$video['_id']);

_::ajax()->register(array('getplaylist','addtoplaylist','newplaylist'),'view');

$db->update('video',array('_id'=>intval(_::$path[0])),array('$set'=>array('do'=>intval($video['do'])+1)));

_::$meta['title']=$video['t'].' - '._::$meta['title'];
_::$meta['image']='http://s3.boxza.com/video/'.$video['f'].'/'.$video['n'];

_::$meta['video']='<meta property="og:video" content="http://www.youtube.com/v/'.$video['yt'].'?autoplay=1&amp;autohide=1">
<meta property="og:video:type" content="application/x-shockwave-flash">
<meta property="og:video:width" content="710">
<meta property="og:video:height" content="'.intval(710*($video['w']?9/16:3/4)).'">
';
_::$meta['type']='video.other';


$c1=0;
$c2=0;
$c3=0;

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

if(isset($_GET['playlist']))
{
	if($playlist=$db->findone('video_playlist',array('_id'=>intval($_GET['playlist']),'dd'=>array('$exists'=>false))))
	{
		$playlist['v']=(array)$playlist['v'];
		$index=array_search(VIDEO_ID,$playlist['v']);
		if($index>-1)
		{
			$template->assign('playlist',$playlist);
			for($i=$index-1;$i>=0;$i--)
			{
				if($prev=$db->findone('video',array('_id'=>intval($playlist['v'][$i]),'dd'=>array('$exists'=>false))))
				{
					$template->assign('prev',array('title'=>$prev['t'],'img'=>'http://s3.boxza.com/video/'.$prev['f'].'/'.$prev['n'],'link'=>'/'.$prev['_id'].'-'.$prev['l'].'.html?playlist='.$_GET['playlist']));
					break;
				}
			}
			for($i=$index+1;$i<count($playlist['v']);$i++)
			{
				if($next=$db->findone('video',array('_id'=>intval($playlist['v'][$i]),'dd'=>array('$exists'=>false))))
				{
					$template->assign('next',array('title'=>$next['t'],'img'=>'http://s3.boxza.com/video/'.$next['f'].'/'.$next['n'],'link'=>'/'.$next['_id'].'-'.$next['l'].'.html?playlist='.$_GET['playlist']));
					break;
				}
			}
		}
	}
}
/*
if($relate=$db->find('video',array('c'=>$video['c'],'_id'=>array('$ne'=>$video['_id']),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'f'=>1,'n'=>1,'l'=>1),array('sort'=>array('do'=>-1),'limit'=>20)))
{
	shuffle($relate);
	$own=array_slice($relate,0,6);
	$template->assign('relate',$relate);
}*/
$relate=$db->find('video',array('dd'=>array('$exists'=>false),'c'=>$video['c']),array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'c'=>1,'cs'=>1,'n'=>1,'dr'=>1),array('sort'=>array('_id'=>-1),'limit'=>50));
shuffle($relate);
$relate=array_slice($relate,0,20);

if($video['u'])
{
	$poster=_::user()->profile($video['u']);
	if($poster['google'])
	{
		_::$meta['google']=$poster['google'];
	}
}


$template->assign('c1',$c1);
$template->assign('c2',$c2);
$template->assign('c3',$c3);
$template->assign('video',$video);
$template->assign('relate',$relate);
$template->assign('c',$video['c']);
$template->assign('user',$poster);
_::$content=$template->fetch('view');
?>