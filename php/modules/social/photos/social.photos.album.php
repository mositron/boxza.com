<?php
if($_FILES)require_once(__DIR__.'/social.photos.post.php');

if($id=intval($line))
{
	$db = _::db();
	if($album=$db->findOne('line',array('_id'=>$id,'ty'=>'album','dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'pt'=>1,'lo'=>1,'tt'=>1,'in'=>1,'ms'=>1,'sh'=>1,'lk'=>1,'ds'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-30))))
	{
		$u=_::user();
		$album['ds']=$album['ds']->sec;
		$album['u']=$u->profile($album['u']);
		if($album['cm'])
		{
			for($j=0;$j<count($album['cm']['d']);$j++)
			{
				$album['cm']['d'][$j]['u'] = $u->profile($album['cm']['d'][$j]['u']);
				$album['cm']['d'][$j]['t'] = $album['cm']['d'][$j]['t']->sec;
			}
		}
		$template=_::template();
		$template->assign('album',$album);
		$template->assign('getphotos',getphotos($id));
		_::$content = $template->fetch('photos.album');
	}
}
if(!$album)
{
	_::move('/photos',true);
}


function getphotos($id,$next=0)
{
	
	$db = _::db();
	$limit = 50;
	$line = $db->find('line',array('ty'=>array('$in'=>array('photo','cover')),'pt.a'=>$id,'dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-3),'lk'=>1,'sh'=>1,'in'=>1,'pt'=>1),array('sort'=>array('_id'=>-1),'limit'=>$limit,'skip'=>$next),false);
	$u = _::user();
	$profile = _::profile();
	
	$site = array();
	$l = array();
	foreach($line as $v)
	{
		//$v['u'] = $u->get($v['u']);
		for($j=0;$j<count($v['cm']['d']);$j++)
		{
			$v['cm']['d'][$j]['u'] = $u->profile($v['cm']['d'][$j]['u']);
			$v['cm']['d'][$j]['t'] = $v['cm']['d'][$j]['t']->sec;
		}
		$v['public']=(in_array('0',(array)$v['in']));
		$v['pt']['tmp']=$profile->crc32($v['pt']['f'],$v['pt']['n'],200,120,'both',$v['pt']['sv']);
		$v['pt']['w']=200;
		$v['pt']['h']=120;
		$l[] = $v;
	}
	if(count($l))
	{
		$template=_::template();
		$template->assign('photo',$l);
		$template->assign('next', (count($l)==$limit?$start+$per:''));
		return $template->fetch('photos.album.photo');
	}
	return '';
}

function morephotos($next=0)
{
	_::ajax()->jquery('#getphotos','append',getphotos($next));
}
?>