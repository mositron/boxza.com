<?php

$db=_::db();
//_::time();


if(!$music=$db->findone('music',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/');
}
_::ajax()->register('setvdo');

$db->update('music',array('_id'=>$music['_id']),array('$inc'=>array('do'=>1)));

_::$meta['title']='เพลง'.$music['sn'].' เนื้อเพลง'.$music['sn'].' อัลบั้ม '.$music['al'].' ศิลปิน '.$music['ar'].' - ฟังเพลง '.$music['sn'].' ดาวน์โหลดเพลง '.$music['sn'].' ฟังเพลงออนไลน์ คอร์ดเพลง';
_::$meta['description']=_::$meta['title'].' - '._::$meta['description'];
_::$meta['type']='music.song';

if($music['fd']&&$music['s'])
{
	_::$meta['image']='http://s3.boxza.com/music/'.$music['fd'].'/'.$music['s'];
}
$music['sn2']=$music['sn'];
$z=mb_strpos($music['sn'],'(',0,'utf-8');
if($z>3)
{
	$music['sn2']=trim(mb_substr($music['sn'],0,$z,'utf-8'));
}

if(!$music['dv'] || !is_array($music['vd']) || !$music['dv']->sec || ($music['dv']->sec < time()-604800))
{
	$html=_::http()->get('http://gdata.youtube.com/feeds/videos?vq='.urlencode($music['sn'].' '.$music['ar']).'&start-index=1&max-results=10&orderby=relevance');
	$video=_::xml()->process($html);
	$set=array('dv'=>new MongoDate(),'vd'=>array());
	if(is_array($video['entry']))
	{
		foreach($video['entry'] as $k => $v)
		{
			$id_raw = explode('/',$video['entry'][$k]['id']);
			$y=array();
			$y['id']=array_pop($id_raw);
			if(mb_strlen($y['id'],'utf-8')>5)
			{
				$y['t']=$video['entry'][$k]['title'];
				$set['vd'][]=$y;
			}
		}
	}
	$music['vd']=$set['vd'];
	$db->update('music',array('_id'=>$music['_id']),array('$set'=>$set));
}

if(!$music['df'] || !is_array($music['fs']) || !$music['df']->sec || ($music['df']->sec < time()-604800))
{
	$html=_::http()->get('http://search.4shared.com/network/searchXml.jsp?q='.urlencode($music['sn']).'&searchExtention=music');
	$fs=_::xml()->process($html);
	$set=array('df'=>new MongoDate(),'fs'=>array());
	$fapi=false;
	if(is_array($fs['result-files']) && is_array($fs['result-files']['file']))
	{
		$fapi=$fs['result-files']['file'];
		if(!isset($fapi[0]))$fapi=array($fapi);
	}
	if(is_array($fs['result-file']) && is_array($fs['result-file']['file']))
	{
		$fapi=$fs['result-file']['file'];
		if(!isset($fapi[0]))$fapi=array($fapi);
	}
	if($fapi)
	{
		foreach($fapi as $k => $v)
		{
			$y=array();
			$y['n']=$v['name'];
			$y['da']=new MongoDate(strtotime($v['upload-date']));
			$y['l']=trim($v['url']);
			$y['s']=trim($v['size']);
			$set['fs'][]=$y;
		}
	}
	$music['fs']=$set['fs'];
	$db->update('music',array('_id'=>$music['_id']),array('$set'=>$set));
}
//http://search.4shared.com/network/searchXml.jsp?q=&searchExtention=music

$tmp = trim(str_replace("\r\n\r\n\r\n","\r\n\r\n",trim($music['ly'])));
if($tmp!=$music['ly'])
{
	$music['ly']=$tmp;
	$db->update('music',array('_id'=>$music['_id']),array('$set'=>array('ly'=>$music['ly'])));
}
$music['ly']=nl2br($music['ly']);

$relate=$db->find('music',array('_id'=>array('$ne'=>$music['_id']),'ar'=>$music['ar'],'al'=>$music['al'],'dd'=>array('$exists'=>false)),array('_id'=>1,'sn'=>1),array('sort'=>array('_id'=>-1),'limit'=>20));


$template->assign('type',array('rs'=>'RS','gm'=>'GMM','yp'=>''));
$template->assign('c',$music['c']);
$template->assign('music',$music);
$template->assign('relate',$relate);
_::$content=$template->fetch('lyric');

function setvdo($v)
{
	if(_::$my['am'])
	{
		_::db()->update('music',array('_id'=>intval(_::$path[0])),array('$set'=>array('yt'=>$v)));
		$ajax=_::ajax();
		$ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
		$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
	}
}
?>