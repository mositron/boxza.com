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
			$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['cv']['f'].'/s.'.$v['pt']['cv']['e'];
		}
		elseif($v['pt']['f'])
		{
			$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['f'][0]['f'].'/s.'.$v['pt']['f'][0]['e'];
		}
		else
		{
			if($p=$db->find('line',array('u'=>_::$profile['_id'],'ty'=>array('$in'=>array('photo','cover')),'pt.a'=>$v['_id'],'dd'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>-1),'limit'=>1)))
			{
				$v['pt']['tmp']='http://s1.boxza.com/line/'.$p[0]['pt']['f'].'/s.'.$p[0]['pt']['e'];
			}
		}
		$album[]=$v;
	}
		
		
	$template=_::template();
	$template->assign('album',$album);
	return $template->fetch('user.photos.album');
}
?>