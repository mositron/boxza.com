<?php

_::$dbclick=2;

//_::$meta['google']=array('id'=>'112235668332689047152');


$cache=_::cache();
if(!_::$content=$cache->get('ca1','horo_home'))
{
	$db=_::db();
	$a=range(11, 100);
	shuffle($a);
	shuffle($a);
	$a=array_slice($a,0,10);
	$template->assign('mhit',$db->find('horo_phone',array('_id'=>array('$in'=>$a,'$ne'=>53)),array('_id'=>1,'d'=>1)));
	
	
	$news=array();
	for($i=1;$i<=6;$i++)
	{
		$news[$i]=$db->find('news',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>NEWS_CATE,'cs'=>$i),array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>8));
	}
	$template->assign('news',$news);
	_::$content=$template->fetch('home');
	$cache->set('ca1','horo_home',_::$content,false,300);
}


	


	

?>