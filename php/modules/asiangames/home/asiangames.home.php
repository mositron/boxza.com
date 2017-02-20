<?php

_::$meta['title'] = 'เอเชียนเกมส์ 2014 สรุปเหรียญเอเชียนเกมส์ 2014 โปรแกรมเอเชียนเกมส์ 2014 ติดตามข่าว Asian Games 2014';
_::$meta['description'] = 'แหล่งรวมข่าว เอเชียนเกมส์ 2014  สรุปเหรียญเอเชียนเกมส์ 2014 โปรแกรมเอเชียนเกมส์ 2014 แบบอัพเดทครบถ้วน  พร้อมติดตาม Asian Games 2014  ถ่ายทอดสดเอเชียนเกมส์ 2014 และคลิปไฮไลท์ ได้อย่างมากมาย';
_::$meta['keywords'] = 'เอเชียนเกมส์ 2014, สรุปเหรียญเอเชียนเกมส์ 2014, โปรแกรมเอเชียนเกมส์ 2014, Asian Games 2014';
//_::$meta['google']=array('id'=>'112235668332689047152');

define('HIDE_SIDEBAR',1);

$cache=_::cache();
#if(!_::$content=$cache->get('ca1',_::$type.'_home'))
#{
	$db=_::db();
	
	$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>25,'cs'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>32));
	$news_rc=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>25,'cs'=>2),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	$news_cl=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>25,'cs'=>5),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>9));
	$template->assign('news',$news);
	$template->assign('news_rc',$news_rc);
	$template->assign('news_cl',$news_cl);
	
	
	_::$content=$template->fetch('home');


#	$cache->set('ca1',_::$type.'_home',_::$content,false,300);
#}

function _getboxname($b)
{
	return '';
}
?>