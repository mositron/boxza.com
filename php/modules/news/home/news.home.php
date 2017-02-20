<?php

_::$dbclick=2;

_::$meta['title'] = 'ข่าว ข่าววันนี้ ข่าวเด่น ข่าวการเมือง ข่าวสังคมออนไลน์ ข่าวติดกระแส ข่าวบันเทิง ข่าวเกมส์ ข่าวเทคโนโลยี ข่าวภาพยนตร์ ข่าวกีฬา ข่าวไลฟ์สไตล์ ข่าวหวย';
_::$meta['description'] = 'ข่าว ข่าววันนี้ ข่าวเด่น ข่าวการเมือง ข่าวสังคมออนไลน์ ข่าวติดกระแส  ข่าวบันเทิง เกาะติด ข่าวเด็ดประเด็นข่าวร้อน ใหม่ สด ทันเหตุการณ์ จากทุกสำนักข่าว ถูกรวบรวมไว้ที่นี่';
_::$meta['keywords'] = 'ข่าว, ข่าววันนี้, ข่าวเด่น, ข่าวสังคมออนไลน์, ข่าวติดกระแส, การเมือง, เศรษฐกิจ, บันเทิง, อาชญากรรม, เทศโนโลยี, สังคม, ดารา, กีฬา, ท่องเที่ยว';


_::$meta['rss']='http://feed.boxza.com/news/rss';
//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','news_home'))
{
	//_::link();
	//_::time();
	$db=_::db();

	$news_rc=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'rc'=>array('$gt'=>0),'c'=>array('$ne'=>8)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>21));
	$notid=array();
	foreach($news_rc as $v)
	{
		$notid[]=$v['_id'];
	}
	$people=$db->find('people',array('dn'=>array('$exists'=>true),'pl'=>1,'dd'=>array('$exists'=>false),'ps'=>array('$ne'=>'politic')),array('_id'=>1,'n'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'fd'=>1,'lk'=>1),array('sort'=>array('dn'=>-1),'limit'=>12));
	$news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'_id'=>array('$nin'=>$notid)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>76));
	$template->assign('news_rc',$news_rc);
	$template->assign('news',$news);
	$template->assign('people',$people);
	_::$content=$template->fetch('home');


	$cache->set('ca1','news_home',_::$content,false,300);
}
?>