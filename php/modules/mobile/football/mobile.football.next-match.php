<?php


#$cache=_::cache();
#if(!_::$content=$cache->get('ca1','football_next_match'))
#{
	$db=_::db();
	$match=array();
	$d2=strtotime(date('Y-m-d 05:00:00'));
	if($d2<time())
	{
		$d2=$d2+(86400);
	}
	$d1=$d2+(86400*30);
	if($dd=$db->distinct('football_match','ky',array('tm'=>array('$gte'=>new MongoDate($d2),'$lt'=>new MongoDate($d1)))))
	{
		sort($dd);
		$dd=array_slice($dd,0,2);
	}
	for($i=0;$i<count($dd);$i++)
	{
		$d1=strtotime($dd[$i].' 05:00:00');
		$d2=$d1+(86400);
		$match[]=array(
												'tm'=>new MongoDate($d1),
											 	'list'=>$db->find('football_match',array('tm'=>array('$gte'=>new MongoDate($d1),'$lt'=>new MongoDate($d2))),array('_id'=>1,'_ng'=>1,'t1'=>1,'t2'=>1,'ft'=>1,'ht'=>1,'fp'=>1,'hp'=>1,'tm'=>1,'lg'=>1),array('sort'=>array('lg'=>1,'tm'=>1))),
												'next'=>true,
										);	
	}

	$template->assign('match',$match);

	_::$content=$template->fetch('football.next-match');


#	$cache->set('ca1','football_next_match',_::$content,false,300);
#}
?>