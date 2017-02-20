<?php

_::move('/image');

_::$meta['title'] = 'BoxZa PicPost - แบ่งปันรูปภาพ สาวน่ารัก สาวไทยน่ารัก สาวเซ็กส์ซี่ สาวไทยเซ็กส์ซี่ หนุ่มหล่อ เอเชีย อินเตอร์';
_::$meta['description'] = 'ศูนย์รวมการแบ่งปันรูปภาพ สาวน่ารัก สาวไทยน่ารัก สาวเซ็กส์ซี่ สาวไทยเซ็กส์ซี่ หนุ่มหล่อ เอเชีย อินเตอร์';
_::$meta['keywords'] = 'รูปภาพ, สาวน่ารัก, สาวไทยน่ารัก, สาวเซ็กส์ซี่, สาวไทยเซ็กส์ซี่, หนุ่มหล่อ, เอเชีย, อินเตอร์';

$cache=_::cache();
#if(!_::$content=$cache->get('ca1','fb_home'))
#{
	$db=_::db();
	
	
	$topic=$db->find('forum',array('c'=>array('$in'=>array(411,412,413,414,415,38)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'fd'=>1,'s'=>1,'o'=>1,'u'=>1,'do'=>1,'c'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>20),false);
	
	$template->assign('topic',$topic);
	$template->assign('user',_::user());
	_::$content=$template->fetch('page.picpost');


#	$cache->set('ca1','fb_home',_::$content,false,300);
#}
?>