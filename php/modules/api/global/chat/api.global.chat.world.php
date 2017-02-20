<?php
$ms=trim($chat->cmd);

if($ms&&in_array($chat->myid,$chat->super))
{
	$cache=_::cache();
	
	$time=$chat->time;
	$al=array(
								'ty'=>'ms',
								'u'=>-1,
								'_id'=>$chat->time,
								'_sn'=>str_replace('.','_',strval($chat->time)),
								't'=>date('H:i',$chat->time),
								'p'=>'',
								'm'=>$ms,
								'mb'=>1,
								'c'=>21,
								'n'=>'^C21,21-^C0,21ประกาศถึงทุกห้อง^C21,21-',
								'l'=>'',
								'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
								'am'=>9,
								'ip'=>$_SERVER['REMOTE_ADDR'],
								'rk'=>rand(1,5),
								'vid'=>'',
							);
	$c = _::db()->find('chatroom',array('dd'=>array('$exists'=>false),'du'=>array('$gte'=>new MongoDate(time()-600))),array('_id'=>1),array('sort'=>array('cu'=>-1),'limit'=>50),false);
	foreach($c as $v)
	{
		$key='chatroom_data_'.$v['_id'];
		if($data=$cache->get('ca2',$key))
		{
			if(is_array($data['text']))
			{
				array_push($data['text'],$al);
				$cache->set('ca2',$key,$data,false,3600*24*7);
			}
		}
	}
}
?>