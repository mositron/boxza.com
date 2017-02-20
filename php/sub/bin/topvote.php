<?php


require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

$db=_::db();

$key=date('Y-m',time());

$topvote = $db->find('user',array('st'=>array('$gte'=>1)),array('_id'=>1,'pf'=>1),array('sort'=>array('pf.vt.m'=>-1),'limit'=>10));

$arg=[];
for($i=0;$i<count($topvote);$i++)
{
	$arg['n'.($i+1)]=array('u'=>$topvote[$i]['_id'],'v'=>$topvote[$i]['pf']['vt']['m']);
}

$arg['du']=new MongoDate();
if($d=$db->findone('user_topvote',array('k'=>$key),array('_id'=>1,'k'=>1)))
{
	$db->update('user_topvote',array('_id'=>$d['_id']),array('$set'=>$arg));
}
else
{
	if($last=$db->find('user_topvote',array(),array('_id'=>1,'k'=>1),array('sort'=>array('_id'=>-1))))
	{
		$db->update('user_topvote',array('_id'=>$last[0]['_id']),array('$set'=>array('s'=>1)));
	}
	$arg['da']=$arg['du'];
	$arg['k']=$key;
	$db->insert('user_topvote',$arg);
}
?>