<?php

_::ajax()->register(array('sendreport','setrec'),'home');
if($_POST)require_once(__DIR__.'/friend.home.post.php');
//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
if(!_::$content=$cache->get('ca1','friend_home'))
{
	//_::time();
	$db=_::db();
	$template=_::template();
	$pc=array();
	foreach($zone as $k=>$v)
	{
		if($k!=4)$pc[$k]=$db->find('msn_province',array('z'=>intval($k)),array('t'=>1,'c'=>1),array('sort'=>array('c'=>-1),'limit'=>5),false);
	}
	if($count=$db->count('msn',array('dd'=>array('$exists'=>false),'ty'=>array('$nin'=>array('gay','lesbian')))))
	{
		list($pg,$skip)=_::pager()->bootstrap(100,$count,array('/','page-'),$page);
		$msn=$db->find('msn',array('dd'=>array('$exists'=>false),'ty'=>array('$nin'=>array('gay','lesbian'))),array(),array('sort'=>array('au'=>1,'da'=>-1),'skip'=>0,'limit'=>100),false);
	}
	//$template->assign('topp',$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>9)));
	$template->assign('rec',$db->find('msn_rec',array('dd'=>array('$exists'=>false),'fd'=>array('$exists'=>true),'ty'=>array('$nin'=>array('gay','lesbian'))),array(),array('sort'=>array('_id'=>-1),'limit'=>20),false));
	
	$_chome=array(1,2,3,4,5,11,12,13,14,15,21,22,23,24,25,61,62,63,64,65,66,67,68,69,401,402,403,404,405,406,411,412,38,413,414,415,416);
	$template->assign('topic',$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>$_chome)),array('_id'=>1,'t'=>1,'u'=>1,'ds'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>14),false));
		
	$template->assign('service',_::sidebar()->service());
	$template->assign('pager',$pg);
	$template->assign('pc',$pc);
	$template->assign('error',$error);
	$template->assign('msn',$msn);
	_::$content=$template->fetch('home');

	$cache->set('ca1','friend_home',_::$content,false,3600);
}

_::$yengo=array(53880,54000);

?>