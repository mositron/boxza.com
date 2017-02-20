<?php

$uid=intval($_GET['uid']);
$last=intval($_GET['last']);
if(_::$my['_id'])
{
	$db = _::db();
	
	if((!_::$my['dc'] || _::$my['dc']->sec+50<time()) && _::$path[2]!='offline')
	{
		_::user()->update(_::$my['_id'],array('$set'=>array('dc'=>new MongoDate())));
	}
						
	switch(_::$path[2])
	{
		case 'list':
		case 'online':
			if(_::$path[2]=='online')
			{
				_::user()->update(_::$my['_id'],array('$unset'=>array('op.ol'=>1)));
			}
			$tmp=($db->find('user',array('_id'=>array('$in'=>(array)_::$my['ct']['fr']),'op.ol'=>array('$exists'=>false),'dc'=>array('$exists'=>true,'$gte'=>new MongoDate(time()-60))),array('_id'=>1,'if'=>1),array(),false));
			$list=array();
			foreach($tmp as $l)$list[strtolower($l['if']['fn'].' '.$l['if']['ln'])]=array('_id'=>$l['_id'],'name'=>$l['if']['fn'].' '.$l['if']['ln'],'link'=>$l['if']['lk'],'img'=>'http://s1.boxza.com/profile/'.$l['if']['fd'].'/s.jpg');
			ksort($list);
			$list=array_values($list);
			$list[]=array('_id'=>0,'name'=>'ผู้ช่วยเหลือ (Bot)','link'=>'','img'=>'http://s1.boxza.com/profile/00/00/00/s.jpg');
			_::$content[] = array('method'=>'chat','type'=>'list','data'=>$list);
			break;
		case 'close':
			$db->update('chat',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>$uid),array('u'=>$uid,'p'=>_::$my['_id'])),'c-'._::$my['_id']=>array('$exists'=>false)),array('$set'=>array('c-'._::$my['_id']=>new MongoDate())),array('multiple'=>true));
			break;
		case 'typing':
			break;
		case 'info':
			if($uid)_::$content[] = array('method'=>'chat','type'=>'info','data'=>_::user()->profile($uid));
			break;
		case 'send':
			$ms=mb_substr(trim(strip_tags($_GET['ms'])),0,500,'utf-8');
			if($uid)
			{
				if(in_array($uid,(array)_::$my['ct']['fr']) && $ms)
				{
					$k=(_::$my['_id']<$uid?_::$my['_id'].'-'.$uid:$uid.'-'._::$my['_id']);
					$db->insert('chat',array('k'=>$k,'u'=>_::$my['_id'],'p'=>$uid,'ms'=>$ms,'n'=>_::$my['name'],'l'=>_::$my['link'],'i'=>_::$my['img']));
				}
			}
			else
			{
				$bot=true;
			}
			break;
		case 'offline':
			_::user()->update(_::$my['_id'],array('$set'=>array('op.ol'=>1)));
			_::$content[] = array('method'=>'chat','type'=>'offline');
			break;
	}
	$data=(array)($db->find('chat',array('_id'=>array('$gt'=>$last),'$or'=>array(array('u'=>_::$my['_id']),array('p'=>_::$my['_id'])),'c-'._::$my['_id']=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'p'=>1,'ms'=>1,'n'=>1,'l'=>1,'i'=>1,'da'=>1)));
	if(isset($bot))
	{
		$data[]=array('_id'=>'','u'=>_::$my['_id'],'p'=>0,'ms'=>$ms,'n'=>_::$my['name'],'l'=>_::$my['link'],'i'=>_::$my['img'],'da'=>array('sec'=>time()));
	}
	if(count($data))
	{
		_::$content[] = array('method'=>'chat','type'=>'chat','data'=>$data);
	}
}
else
{
	_::$content[] = array('method'=>'login');
}
?>