<?php

_::ajax()->register(array('morephotos','morealbums','newalbum','editfilter','savefilter'));

$template=_::template();
$template->assign('myalbum', myalbums());
_::$content=$template->fetch('user.photos');

	
_::$meta['title'] = 'รูปภาพของ '._::$profile['name'].' - BoxZa โปรไฟล์ส่วนตัว';
_::$meta['description'] = 'รูปภาพของ '._::$profile['name'].' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'รูปภาพ, เพื่อน, สังคมออนไลน์';


function myalbums($start=0)
{
	$db = _::db();
	$profile = _::profile();
	$_=array('u'=>_::$profile['_id'],'ty'=>'album','dd'=>array('$exists'=>false));
	if((!_::$my) || ((_::$my['_id']!=_::$profile['_id']) && !defined('IS_FRIEND')))
	{
		$_['in']=0;
	}
	$line = $db->find('line',$_,array('_id'=>1,'tt'=>1,'lo'=>1,'pt'=>1),array('sort'=>array('_id'=>-1)),false);
	$album=array();
	
	$album=array();
	foreach($line as $v)
	{
		if($v['pt']['cv'])
		{
			$v['pt']['tmp']=$profile->crc32($v['pt']['cv']['f'],$v['pt']['cv']['n'],200,120,'both',$v['pt']['cv']['sv']);
		}
		elseif($v['pt']['f'])
		{
			$v['pt']['tmp']=$profile->crc32($v['pt']['f'][0]['f'],$v['pt']['f'][0]['n'],200,120,'both',$v['pt']['f'][0]['sv']);
		}
		else
		{
			if($p=$db->find('line',array('u'=>_::$my['_id'],'ty'=>array('$in'=>array('photo','cover')),'pt.a'=>$v['_id'],'dd'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>-1),'limit'=>1)))
			{
				$v['pt']['tmp']=$profile->crc32($p[0]['pt']['f'],$p[0]['pt']['n'],200,120,'both',$p[0]['pt']['sv']);
			}
		}
		$album[]=$v;
	}
		
		
	$template=_::template();
	$template->assign('album',$album);
	return $template->fetch('user.photos.album');
}
?>