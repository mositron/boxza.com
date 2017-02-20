<?php


_::$meta['title'] = _::$profile['name'].' - BoxZa โปรไฟล์ส่วนตัว';
_::$meta['description'] =  'เกี่ยวกับ '._::$profile['name'].' - '._::$meta['description'];
_::$meta['keywords'] = _::$profile['name'].', '._::$profile['if']['fn'].', '._::$profile['if']['ln'].', ประวัติ, โปรไฟล์';

if(_::$my)
{
	$template->assign('line', _::profile()->line(array('uid'=>_::$profile['_id']),'profile',0,10));
	$template->assign('line',$template->fetch('line.list'));
	$template->assign('gift', _::db()->find('gift',array('u'=>_::$profile['_id'],'ex'=>array('$gte'=>new MongoDate())),array(),array('sort'=>array('_id'=>-1))));
	_::$content=$template->fetch('user.about');
}
else
{
	
	$cache=_::cache();

	$key='profile-about-'._::$profile['_id'];
	if(!_::$content=$cache->get('ca1',$key))
	{
		$template->assign('line', _::profile()->line(array('uid'=>_::$profile['_id']),'profile',0,10));
		$template->assign('line',$template->fetch('line.list'));
		$template->assign('gift', _::db()->find('gift',array('u'=>_::$profile['_id'],'ex'=>array('$gte'=>new MongoDate())),array(),array('sort'=>array('_id'=>-1))));
		_::$content=$template->fetch('user.about');
		$cache->set('ca1',$key,_::$content,false,3600);
	}
}

	
?>