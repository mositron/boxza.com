<?php

#$cache=_::cache();


_::$meta['rss']='http://feed.boxza.com/forum/rss';
//_::$meta['google']=array('id'=>'112235668332689047152');

//_::time();

if(!defined('FORUM_IN'))
{
	$cache=_::cache();
	if(!_::$content=$cache->get('ca1','forum_home'))
	{
		
		$db=_::db();
		//$_chome=array(1,2,3,4,5,11,12,13,14,15,21,22,23,24,25,61,62,63,64,65,66,67,68,69,201,202,203,204,205,206,207,208,209,401,402,403,404,405,406,411,412,38,413,414,415,416);
		$_chome=array_keys($cate);
		$template->assign('topic1',$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>$_chome)),array('_id'=>1,'t'=>1,'ms'=>1,'c'=>1,'ic'=>1,'u'=>1,'ds'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>15),false));
		//$template->assign('topic2',$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>$_chome),'cm.c'=>array('$gt'=>1)),array('_id'=>1,'t'=>1,'ms'=>1,'c'=>1,'ic'=>1,'u'=>1,'ds'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>15),false));
		
		$template->assign('rec',$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>$_chome),'rc'=>1),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>15)));
		
		$template->assign('user',_::user());
		$template->assign('service',_::sidebar()->service());
		_::$content=$template->fetch2(FORUM_TPL.'home.default');
		
		$cache->set('ca1','forum_home',_::$content,false,300);
	}
	//_::$yengo=array(53880,54000);
}
else
{
	_::$meta['title'] = 'เว็บบอร์ด - '._::$meta['title'];
	_::$meta['description'] = 'เว็บบอร์ด - '._::$meta['description'];

	$cache=_::cache();
	if(!_::$content=$cache->get('ca1',_::$type.'_forum_home'))
	{
		if(is_array($cate))
		{
			$db=_::db();
			$_ch = array_keys($cate);
			$template->assign('user',_::user());
			$template->assign('topic',$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>$_ch)),array('_id'=>1,'t'=>1,'ms'=>1,'c'=>1,'ic'=>1,'u'=>1,'ds'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>15),false));
		}
		_::$content=$template->fetch2(FORUM_TPL.'home');
		
		
		$cache->set('ca1',_::$type.'_forum_home',_::$content,false,300);
	}
}
?>