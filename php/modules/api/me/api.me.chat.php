<?php

$uid=intval($_GET['uid']);
$last=intval($_GET['last']);
if(_::$my['_id'])
{
	$db = _::db();
	
	if((!_::$my['dc'] || _::$my['dc']->sec+110<time()) && _::$path[2]!='offline')
	{
		_::user()->update(_::$my['_id'],['$set'=>['dc'=>new MongoDate()]]);
	}
	$online=true;
	$status=['online'=>0,'away'=>1,'busy'=>2,'invisible'=>3,'offline'=>4];	
	$_status=array_keys($status);			
	switch(_::$path[2])
	{
		case 'sound':
				$sd=intval($_GET['sound'])?1:0;
				_::user()->update(_::$my['_id'],['$set'=>['op.sd'=>$sd]]);
				_::$content[] = ['method'=>'chat','type'=>'sound','data'=>$sd];
				break;
		case 'online':
		case 'away':
		case 'busy':
		case 'invisible':
		case 'offline':
				_::user()->update(_::$my['_id'],['$set'=>['op.ol'=>$status[_::$path[2]]]]);
		case 'list':
			$flimit = (!isset($_GET['limit'])||$_GET['limit']<10||$_GET['limit']>50)?15:intval($_GET['limit']);
			if(_::$path[2]=='offline'||(_::$path[2]=='list'&&isset(_::$my['op']['ol'])&&_::$my['op']['ol']==4))
			{
				$online=false;
			}
			if($online)
			{
				if(isset($status[_::$path[2]]))
				{
					$cur=_::$path[2];
				}
				else
				{
					$cur=(isset($_status[intval(_::$my['op']['ol'])])?$_status[intval(_::$my['op']['ol'])]:'online');
				}
				$tmp=($db->find('user',['_id'=>['$in'=>(array)_::$my['ct']['fl']],'op.ol'=>['$nin'=>[3,4]],'dc'=>['$exists'=>true,'$gte'=>new MongoDate(time()-120)]],['_id'=>1,'if'=>1,'op.ol'=>1,'pf.av'=>1],[],false));
				$list=[];
				$not_id=[];
				foreach($tmp as $l)
				{
					$not_id[]=$l['_id'];
					$list[strtolower($l['if']['fn'].' '.$l['if']['ln'])]=['_id'=>$l['_id'],'name'=>$l['if']['fn'].' '.$l['if']['ln'],'link'=>$l['if']['lk'],'img'=>'http://s1.boxza.com/profile/'.$l['if']['fd'].'/s.'.($l['pf']&&$l['pf']['av']?$l['pf']['av']:'jpg'),'status'=>$_status[intval($l['op']['ol'])]];
				}
				ksort($list);
				$list=array_values($list);
				$list[]=['_id'=>0,'name'=>'ผู้ช่วยเหลือ (Bot)','link'=>'','img'=>'http://s1.boxza.com/profile/00/00/00/s.jpg','status'=>'online'];
				$flimit = min($flimit,count((array)_::$my['ct']['fl']));
				if(count($not_id)<$flimit)
				{
					$tmp=$db->find('user',['_id'=>['$in'=>(array)_::$my['ct']['fl'],'$nin'=>$not_id],'op.ol'=>['$nin'=>[3,4]]],['_id'=>1,'if'=>1],['sort'=>['dc'=>-1],'limit'=>($flimit-count($not_id))],false);
					foreach($tmp as $l)
					{
						$list[]=['_id'=>$l['_id'],'name'=>$l['if']['fn'].' '.$l['if']['ln'],'link'=>$l['if']['lk'],'img'=>'http://s1.boxza.com/profile/'.$l['if']['fd'].'/s.jpg','status'=>'offline'];
					}
				}
				_::$content[] = ['method'=>'chat','type'=>'sound','data'=>intval(_::$my['op']['sd'])];
				_::$content[] = ['method'=>'chat','type'=>$cur,'data'=>$list];
			}
			else
			{
				_::$content[] = ['method'=>'chat','type'=>'offline','data'=>[]];
			}
			break;
		case 'close':
			$db->update('chat',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>$uid),array('u'=>$uid,'p'=>_::$my['_id'])),'c-'._::$my['_id']=>array('$exists'=>false)),array('$set'=>array('c-'._::$my['_id']=>new MongoDate())),array('multiple'=>true));
			break;
		case 'typing':
			break;
		case 'info':
			if($uid)_::$content[] = ['method'=>'chat','type'=>'info','data'=>_::user()->profile($uid)];
		case 'more':
			if($uid)
			{
				$_=['$or'=>[
												['u'=>_::$my['_id'],'p'=>$uid,'c-u'=>['$exists'=>false]],
												['p'=>_::$my['_id'],'u'=>$uid,'c-p'=>['$exists'=>false]]
				]];
				if($more=intval($_GET['more']))
				{
					$_['_id']=['$lt'=>$more];	
				}
				$data = $db->find('chat',$_,
																		['_id'=>1,'u'=>1,'p'=>1,'ms'=>1,'n'=>1,'l'=>1,'i'=>1,'da'=>1],
																		['sort'=>['da'=>-1],'limit'=>30]
															);
				_::$content[] = array('method'=>'chat','type'=>'more','data'=>$data);
			}
			break;
		case 'send':
			$ms=mb_substr(trim(htmlspecialchars($_GET['ms'],ENT_QUOTES,'utf-8')),0,500,'utf-8');
			if($uid)
			{
				if($ms)
				{
					$k=(_::$my['_id']<$uid?_::$my['_id'].'-'.$uid:$uid.'-'._::$my['_id']);
					$db->insert('chat',array('k'=>$k,'u'=>_::$my['_id'],'p'=>$uid,'ms'=>$ms)); //,'n'=>_::$my['name'],'l'=>_::$my['link'],'i'=>_::$my['img']
				}
			}
			else
			{
				$bot=true;
			}
			break;
	}
	$data=(array)($db->find('chat',array('_id'=>array('$gt'=>$last),'$or'=>array(array('u'=>_::$my['_id']),array('p'=>_::$my['_id'])),'c-'._::$my['_id']=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'p'=>1,'ms'=>1,'n'=>1,'l'=>1,'i'=>1,'da'=>1),array('sort'=>array('_id'=>1))));
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