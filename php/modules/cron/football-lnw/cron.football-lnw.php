<?php


$db=_::db();
$match=array();
$d2=strtotime(date('Y-m-d 05:00:00'));
if($d2>time())
{
	$d2=$d2-(86400);
}
$d1=$d2-(86400*30);
if($dd=$db->distinct('football_match','ky',array('tm'=>array('$gte'=>new MongoDate($d1),'$lt'=>new MongoDate($d2)))))
{
	rsort($dd);
	$match=$db->find('football_match',array('ft'=>array('$ne'=>''),'ky'=>$dd[0]),array('_id'=>1));
	$mid=array();
	for($i=0;$i<count($match);$i++)
	{
		$mid[]=$match[$i]['_id'];
	}
	
	$time = new MongoDate(strtotime($dd[0].' 00:00:00'));
	
	$u=array();
	$game=$db->find('football_game',array('m'=>array('$in'=>$mid),'fn'=>1));
	for($i=0;$i<count($game);$i++)
	{
		$g=$game[$i];
		if(!isset($u[$g['u']]))
		{
			$u[$g['u']]=array('u'=>$g['u'],'tm'=>$time,'win'=>0,'all'=>0,'match'=>array(),'b-2'=>0,'b-1'=>0,'b0'=>0,'b1'=>0,'b2'=>0);
		}
		if($g['box']>0)
		{
			$u[$g['u']]['win']++;
		}
		$u[$g['u']]['b'.$g['box']]++;
		$u[$g['u']]['match'][]=array('m'=>$g['m'],'b'=>$g['box'],'t1'=>intval($g['t1']),'t2'=>intval($g['t2']));
		$u[$g['u']]['all']++;
	}
	
	if(count($u)>0)
	{
		$db->remove('football_lnw');
		foreach($u as $k=>$v)
		{
			$v['per']=intval(($v['win']/$v['all'])*100);
			$db->insert('football_lnw',$v);
			//array('u'=>$k,'match'=>$v['match'],'win'=>$v['win'],'all'=>$v['all'],'per'=>intval(($v['win']/$v['all'])*100),'tm'=>$time)
		}
	}
}

?>