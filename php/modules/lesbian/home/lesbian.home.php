<?php

/*
_::$meta['title'] = 'ผลบอล ข่าวฟุตบอล วิเคราะห์บอล ผลบอลสด ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางการแข่งขัน บอลวันนี้ ติดตามข่าวสารเกี่ยวกับฟุตบอล';
_::$meta['description'] = 'ฟุตบอล ข่าวฟุตบอล ผลบอล ผลบอลสด วิเคราะห์บอล ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางคะแนน ตารางการแข่งขัน ฟุตบอลไทย พรีเมียร์ลีก ';
_::$meta['keywords'] = 'ฟุตบอล, ข่าวฟุตบอล, ผลบอล, ไฮไลท์ฟุตบอล, โปรแกรมฟุตบอล, วิเคราะห์บอล, ผลบอลสด, ตารางคะแนน, เซียนบอล';
*/
/*
if(_::$my['_id']==1&$_GET['em'])
{
	$db=_::db();
	$em=$db->find('msn',array('ty'=>'gay','dd'=>array('$exists'=>false)));
	for($i=0;$i<count($em);$i++)
	{
		echo $em[$i]['em']."\r\n";
	}
}
*/
//_::$meta['google']=array('id'=>'112235668332689047152');
$cache=_::cache();
if(!_::$content=$cache->get('ca1','lesbian_home'))
{
	$db=_::db();
	
	
	#$topic=$db->find('forum',array('c'=>array('$in'=>array(71,72,73,74,75,77,78,79,80,81,82,83,84,85,86,87,88,89)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ms'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>30),false);
	
	$video=$db->find('forum',array('c'=>456,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1,'d'=>1),array('sort'=>array('_id'=>-1),'limit'=>7));
	$hot=$db->find('forum',array('c'=>452,'dd'=>array('$exists'=>false),'do'=>array('$gte'=>20)),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	
	
	$fashion=$db->find('forum',array('c'=>454,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$health=$db->find('forum',array('c'=>455,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$album=$db->find('forum',array('c'=>457,'dd'=>array('$exists'=>false),'s'=>array('$exists'=>true)/*,'rc'=>1*/),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'limit'=>15));
	
	$banner=$db->find('lesbian_banner',array('pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'d'=>1,'l'=>1),array('sort'=>array('_id'=>-1)));
	
	$activity=$db->find('forum',array('c'=>array('$in'=>array(472,473,474)),'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>8));
	
	
	$template->assign('video',(array)$video);
	$template->assign('hot',(array)$hot);
	$template->assign('fashion',(array)$fashion);
	$template->assign('health',(array)$health);
	$template->assign('album',(array)$album);
	$template->assign('banner',(array)$banner);
	$template->assign('rec',$db->find('msn_rec',array('dd'=>array('$exists'=>false),'fd'=>array('$exists'=>true),'ty'=>'lesbian'),array(),array('sort'=>array('_id'=>-1),'limit'=>20),false));
	_::$content=$template->fetch('home');


	$cache->set('ca1','lesbian_home',_::$content,false,60);
}
?>

