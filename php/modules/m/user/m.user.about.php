<?php


_::$meta['title'] = _::$profile['name'].' - BoxZa โปรไฟล์ส่วนตัว';
_::$meta['description'] =  'เกี่ยวกับ '._::$profile['name'].' - '._::$meta['description'];
_::$meta['keywords'] = _::$profile['name'].', '._::$profile['if']['fn'].', '._::$profile['if']['ln'].', ประวัติ, โปรไฟล์';



if(_::$my['_id']!=_::$profile['_id'] && defined('IS_FRIEND'))
{
	_::db()->update('friend',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>_::$profile['_id']),array('u'=>_::$profile['_id'],'p'=>_::$my['_id']))),array('$set'=>array('du-'._::$my['_id']=>new MongoDate())));
}
$template->assign('gift', _::db()->find('gift',array('u'=>_::$profile['_id'],'ex'=>array('$gte'=>new MongoDate()))));
_::$content=$template->fetch('user.about');

?>