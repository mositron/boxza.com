<?php

_::$dbclick=2;

//_::$meta['google']=array('id'=>'112235668332689047152');


#$cache=_::cache();
if(!_::$content=$cache->get('ca1','music_home'))
{
	//_::time();
	$db=_::db();
	
	$music=$db->find('music',array(),array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>20));
	$template->assign('music',$music);
	
	$news=$db->find('news',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>NEWS_CATE),array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>16));
	$template->assign('news',$news);
	
	_::$content=$template->fetch('home');


	$cache->set('ca1','music_home',_::$content,false,600);
}
_::$yengo=array(53880,54000);

function getfirstchar($t)
{
	$r='!';
	$a=array('1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','ก','ข','ค','ฆ','ง','จ','ฉ','ช','ซ','ฌ','ญ','ฎ','ฐ','ฑ','ฒ','ฐ','ณ','ด','ต','ถ','ท','ธ','น','บ','ป','ผ','ฝ','พ','ฟ','ภ','ม','ย','ร','ฤ','ล','ว','ศ','ษ','ส','ห','ฬ','อ','ฮ');
	$t=mb_strtolower($t,'utf-8');
	$l=mb_strlen($t,'utf-8');
	for($i=0;$i<$l;$i++)
	{
		$s=mb_substr($t,$i,1,'utf-8');
		if(in_array($s,$a))
		{
			if(is_numeric($s))
			{
				return $r;
			}
			else
			{
				return $s;
			}
		}
	}
	return $r;
}
?>