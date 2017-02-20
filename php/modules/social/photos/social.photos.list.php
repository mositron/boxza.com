<?php

if($_FILES)require_once(__DIR__.'/social.photos.post.php');

_::ajax()->register(array('morephotos','morealbums','newalbum','editfilter','savefilter','setdetail','setcover','setalbum'),'photos.list');


if(_::$my['_id'])
{
	$template=_::template();
	$template->assign('myalbum', myalbums());
	$template->assign('getphotos', getphotos());
	_::$content=$template->fetch('photos.list');
}
else
{
	$cache=_::cache();
	if(!_::$content=$cache->get('ca1','photos-'._::$path[0]))
	{
		$template=_::template();
		$template->assign('getphotos', getphotos());
		_::$content=$template->fetch('photos.list');
		
		$cache->set('ca1','photos-'._::$path[0],_::$content,false,3600);
	}
}
function myalbums($start=0)
{
	$db = _::db();
	$profile = _::profile();
	$line = $db->find('line',array('u'=>_::$my['_id'],'ty'=>'album','dd'=>array('$exists'=>false)),array('_id'=>1,'tt'=>1,'lo'=>1,'pt'=>1),array('sort'=>array('_id'=>-1)),false);
	$album=array();
	foreach($line as $v)
	{
		if($v['pt']['cv'])
		{
			$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['cv']['f'].'/s.'.$v['pt']['cv']['e'];
		}
		elseif($v['pt']['f'])
		{
			$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['f'][0]['f'].'/s.'.$v['pt']['f'][0]['e'];
		}
		else
		{
			if($p=$db->find('line',array('u'=>_::$my['_id'],'ty'=>array('$in'=>array('photo','cover')),'pt.a'=>$v['_id'],'dd'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>-1),'limit'=>1)))
			{
				$v['pt']['tmp']='http://s1.boxza.com/line/'.$p[0]['pt']['f'].'/s.'.$p[0]['pt']['e'];
			}
		}
		$album[]=$v;
	}
	$template=_::template();
	$template->assign('album',$album);
	return $template->fetch('photos.list.album');
}

function getphotos($next=0)
{
	$db = _::db();
	$limit = 50;
	if(_::$my['_id'])
	{
		$_ = array(
		/*
									'$or'=>array(
																			array('in'=>0),
																			array(
																							'in'=>-1,
																							'u'=>array('$in'=>(array)_::$my['ct']['fr']),
	 																					),
									),
			*/
									'u'=>array('$ne'=>_::$my['_id']),
									'ty'=>'photo',
									'hi'=>array('$exists'=>false),
									'dd'=>array('$exists'=>false),
									'ex'=>array('$gte'=>new mongodate()),
						);
	}
	else
	{
		$_ = array('in'=>0,'ty'=>'photo','hi'=>array('$exists'=>false),'dd'=>array('$exists'=>false),'ex'=>array('$gte'=>new mongodate()));
	}

	$line = $db->find('line',$_,array('_id'=>1,'u'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-3),'lk'=>1,'sh'=>1,'in'=>1,'pt'=>1),array('sort'=>array('_id'=>-1),'limit'=>$limit,'skip'=>$next),false);
	$u = _::user();
	$profile = _::profile();
	
	$site = array();
	$l = array();
	foreach($line as $v)
	{
		$v['u'] = $u->profile($v['u']);
		for($j=0;$j<count($v['cm']['d']);$j++)
		{
			$v['cm']['d'][$j]['u'] = $u->profile($v['cm']['d'][$j]['u']);
			$v['cm']['d'][$j]['t'] = $v['cm']['d'][$j]['t']->sec;
		}
		$v['public']=(in_array('0',(array)$v['in']));
		$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['f'].'/s.'.$v['pt']['e']; // $profile->crc32($v['pt']['f'],$v['pt']['n'],200,120,'both',$v['pt']['sv']);
		$v['pt']['w']=200;
		$v['pt']['h']=120;
		$l[] = $v;
	}
	$template=_::template();
	$template->assign('photo',$l);
	$template->assign('next', (count($l)==$limit?$next+$limit:''));
	return $template->fetch('photos.list.photo');
}

?>