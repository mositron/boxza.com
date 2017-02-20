<?php

_::$meta['title'] = 'Blog บทความ - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'Blog บทความ - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'Blog, บทความ, สังคมออนไลน์';

//_::time();

_::ajax()->register(array('moreblogs'),'blogs');

if(_::$my['_id'])
{
	$template=_::template();
	$template->assign('getblogs', getblogs());
	_::$content=$template->fetch('blogs');
}
else
{
	$cache=_::cache();
	if(!_::$content=$cache->get('ca1','blogs-'._::$path[0]))
	{
		$template=_::template();
		$template->assign('getblogs', getblogs());
		_::$content=$template->fetch('blogs');
		
		$cache->set('ca1','blogs-'._::$path[0],_::$content,false,3600);
	}
}

function getblogs($next=0)
{
	$db = _::db();
	$limit = 50;
	if(_::$my['_id'])
	{
		$_ = array(
									'$or'=>array(
																			array('in'=>0),
																			array('u'=>_::$my['_id']),
																			array(
																							'in'=>-1,
																							'u'=>array('$in'=>(array)_::$my['ct']['fr']),
	 																					),
									),
									'ty'=>'blog',
									'hi'=>array('$exists'=>false),
									'dd'=>array('$exists'=>false)
						);
	}
	else
	{
		$_ = array('in'=>0,'ty'=>'blog','hi'=>array('$exists'=>false),'dd'=>array('$exists'=>false));
	}
	$line = $db->find('line',$_,array('_id'=>1,'u'=>1,'cm.c'=>1,'lk'=>1,'sh'=>1,'in'=>1,'tt'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>$limit,'skip'=>$next));
	$template=_::template();
	$template->assign('blog',$line);
	$template->assign('user',_::user());
	$template->assign('next', (count($line)==$limit?$next+$limit:''));
	return $template->fetch('blogs.list');
}

?>