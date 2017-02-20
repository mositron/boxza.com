<?php



//_::$meta['title'] = 'ผลบอล ข่าวฟุตบอล วิเคราะห์บอล ผลบอลสด ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางการแข่งขัน บอลวันนี้ ติดตามข่าวสารเกี่ยวกับฟุตบอล';
//_::$meta['description'] = 'ฟุตบอล ข่าวฟุตบอล ผลบอล ผลบอลสด วิเคราะห์บอล ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางคะแนน ตารางการแข่งขัน ฟุตบอลไทย พรีเมียร์ลีก ';
//_::$meta['keywords'] = 'ฟุตบอล, ข่าวฟุตบอล, ผลบอล, ไฮไลท์ฟุตบอล, โปรแกรมฟุตบอล, วิเคราะห์บอล, ผลบอลสด, ตารางคะแนน, เซียนบอล';

//_::$meta['google']=array('id'=>'112235668332689047152');

//$cache=_::cache();
#if(!_::$content=$cache->get('ca1','racing_home'))
#{
	//_::time();
/*
	$db=_::db();
	$template->assign('user',_::user());
	$template->assign('service',_::sidebar()->service(array('racing'=>1)));
	$template->assign('announcement',$db->find('forum',array('c'=>array('$in'=>array(1100,1200)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ic'=>1,'fd'=>1,'u'=>1,'do'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>20),false));
	$topic_rec=$db->find('forum',array('c'=>array('$gte'=>2000,'$lte'=>9999),'rc'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>20),false);
	$notin=array();
	foreach($topic_rec as $v)
	{
		$notin[]=$v['_id'];
	}
	$template->assign('topic_rec',$topic_rec);
	$template->assign('topic',$db->find('forum',array('c'=>array('$gte'=>2000,'$lte'=>9999),'_id'=>array('$nin'=>$notin),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>20),false));
	*/
	_::$content=$template->fetch('home');
#	$cache->set('ca1','racing_home',_::$content,false,20);
#}
?>