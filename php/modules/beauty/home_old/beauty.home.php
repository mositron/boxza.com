<?php

/*
_::$meta['title'] = 'ผลบอล ข่าวฟุตบอล วิเคราะห์บอล ผลบอลสด ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางการแข่งขัน บอลวันนี้ ติดตามข่าวสารเกี่ยวกับฟุตบอล';
_::$meta['description'] = 'ฟุตบอล ข่าวฟุตบอล ผลบอล ผลบอลสด วิเคราะห์บอล ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางคะแนน ตารางการแข่งขัน ฟุตบอลไทย พรีเมียร์ลีก ';
_::$meta['keywords'] = 'ฟุตบอล, ข่าวฟุตบอล, ผลบอล, ไฮไลท์ฟุตบอล, โปรแกรมฟุตบอล, วิเคราะห์บอล, ผลบอลสด, ตารางคะแนน, เซียนบอล';
*/
//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','beauty_home'))
{
	$db=_::db();
	
	$ho=array();
	$ho['h1']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h1'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h1'=>-1),'limit'=>4)));
	$ho['h5']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h5'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h5'=>-1),'limit'=>6)));
	$ho['h6']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h6'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h6'=>-1),'limit'=>6)));
	$ho['h7']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h7'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h7'=>-1),'limit'=>2)));
	$ho['h9']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h9'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h9'=>-1),'limit'=>20)));
	$ho['h10']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h10'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'u'=>1,'do'=>1,'cm.c'=>1),array('sort'=>array('ho.h10'=>-1),'limit'=>18)));
	$ho['h11']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h11'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h11'=>-1),'limit'=>6)));
	$ho['h12']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h12'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h12'=>-1),'limit'=>12)));
	$ho['h13']=(array)($db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho.h13'=>array('$exists'=>true),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('ho.h13'=>-1),'limit'=>2)));
	$template->assign('ho',$ho);
	$template->assign('user',_::user());
	_::$content=$template->fetch('home');


	$cache->set('ca1','beauty_home',_::$content,false,600);
}
?>

