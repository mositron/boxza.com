<?php

_::$meta['title'] = 'รูปภาพของคุณ - '._::$meta['title'];
_::$meta['description'] = 'รูปภาพของคุณ - '._::$meta['description'];

#if(!_::$content=$cache->get('ca1','boyz_home'))
#{
	$_=array('dd'=>array('$exists'=>false));
	if(_::$my)
	{
		$_['$or']=array(array('u'=>_::$my['_id']),array('s'=>SESIMAGE));
	}
	else
	{
		$_['s']=SESIMAGE;;
	}
	$template->assign('image',_::db()->find('image',$_,array('_id'=>1,'ty'=>1,'fd'=>1,'f'=>1,'u'=>1),array('sort'=>array('_id'=>-1),'limit'=>100)));
	_::$content=$template->fetch('my');


#	$cache->set('ca1','boyz_home',_::$content,false,300);
#}

?>