<?php

_::ajax()->register('dellog');

$db=_::db();
$user=_::user();
$chat=array();

$tmp = $db->group('chat',array('k'=>1), array('last'=>'','count'=>0,'p'=>'','u'=>'','da'=>'','_id'=>''), "function(obj, prev) { prev.da=obj.da; prev.u=obj.u; prev.p=obj.p; prev._id=obj._id; prev.last=obj.ms; prev.count++; }",
						array(
										'condition'=>array(
																					'$or'=>array(
																													array('u'=>_::$my['_id'],'c-u'=>array('$exists'=>false)),
																													array('p'=>_::$my['_id'],'c-p'=>array('$exists'=>false))
																									)
															 )
									)
					);
/*
$tmp2=$db->aggregate('chat',[
																			'$match'=>[
																											'$or'=>[
																																['u'=>_::$my['_id'],'c-u'=>['$exists'=>false]],
																																['p'=>_::$my['_id'],'c-p'=>['$exists'=>false]]
																															]
																									],
																			'$group'=>['_id'=>'$k']
																			
																		]);
	*/  
#print_r($tmp);
#print_r($tmp2);
for($i=0;$i<count($tmp);$i++)
{
	$chat[$tmp[$i]['_id']]=$tmp[$i];
}
#print_r($chat);
if(count($chat))
{
	ksort($chat);
	$chat=array_values($chat);
}
$template=_::template();
$template->assign('user',$user);
$template->assign('chat',$chat);

print_r($chat);
$template->assign('service',_::sidebar()->service(array('line'=>1)));
_::$content=$template->fetch('messages.list');

 
function dellog($u)
{
	$db=_::db();
	$db->update('chat',array('u'=>_::$my['_id'],'p'=>intval($u)),array('$set'=>array(
																																												'c-'._::$my['_id']=>new MongoDate(),
																																												'c-u'=>new MongoDate(),
																																								)
																																),
									array('multiple'=>true)
					);
	$db->update('chat',array('p'=>_::$my['_id'],'u'=>intval($u)),array('$set'=>array(
																																												'c-'._::$my['_id']=>new MongoDate(),
																																												'c-p'=>new MongoDate(),
																																								)
																																),
									array('multiple'=>true)
					);
	_::ajax()->script('_.line.go("/messages",true)');
}
?>