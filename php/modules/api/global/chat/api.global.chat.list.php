<?php
$poem_delay = 600;
$tmp=array();
$found=false;
$foundbot=false;
$uadmin=array();
//$sadmin=array();
//$sadmin=array(7,88,43416);
$nick=getnicks($chat->cache,$chat->room);
foreach($nick as $k=>$v)
{
	if($v['_id']==$chat->myid)
	{
		$found=true;
		$mynick=array('_id'=>$chat->myid,'t'=>$chat->time2,'n'=>$chat->myname,'d'=>'','l'=>'','i'=>$chat->myimg,'ip'=>$_SERVER['REMOTE_ADDR'],'mb'=>0,'am'=>0,'rk'=>0,'vid'=>$chat->vid);
		if(_::$my)
		{
			$pb=$chat->time2-$v['t'];
			if($v['t'] && ($chat->time2>$v['t']) && ($pb < 90))
			{
				if(!$chat->data['last'])
				{
					$chat->data['last']=$chat->time2;
					$chat->save=true;
				}
				elseif($chat->data['last']<($chat->time2 - 300))
				{
					$_cu=0;
					$_cv=0;
					foreach($nick as $conline)
					{
						if($conline['mb'])
						{
							$_cu++;
						}
						else
						{
							$_cv++;
						}
					}
					$chat->data['last']=$chat->time2;
					_::db()->update('chatroom',array('_id'=>$chat->room),array('$set'=>array('cu'=>$_cu,'cv'=>$_cv,'du'=>new MongoDate())));	
					$chat->save=true;
				}
	
				if(!is_array(_::$my['if']['ch']))
				{
					_::$my['if']['ch']=array();
				}
				if(!_::$my['if']['ch']['du'])
				{
					_::user()->update(_::$my['_id'],array('$set'=>array('if.ch.du'=>new MongoDate())));
				}
				elseif($chat->time2 > _::$my['if']['ch']['du']->sec+300)
				{
					if($chat->time2 < _::$my['if']['ch']['du']->sec+ 420)
					{
						$exp=1;
						if(_::$my['if']['ch']['ci'])
						{
							$item=require_once(ROOT.'modules/game/dialog/game.dialog.item.config.php');
							if($item[_::$my['if']['ch']['ci']])
							{
								if(intval($item[_::$my['if']['ch']['ci']]['s'])>0)
								{
									$exp=(100+intval($item[_::$my['if']['ch']['ci']]['s']))/100;
								}
							}
						}
						$chat->mybux+=abs(floor((($chat->inner?EXP_RATE:1)*5)*$exp));
						_setmybux($chat->mybux);
						if($chat->myadmin!=9)
						{
							_::db()->update('chat_online',array('u'=>_::$my['_id'],'r'=>$chat->room,'m'=>date('n')),array('$inc'=>array('t'=>5)),array('upsert'=>true));
						}
					}
					_::user()->update(_::$my['_id'],array('$set'=>array('if.ch.du'=>new MongoDate())));
				}
				if($chat->myadmin && isset($chat->data['admin'][_::$my['_id']]))
				{
					$chat->data['admin'][_::$my['_id']]['ds']=$chat->time2;
					$chat->saveadmin();
				}
			}
			$mynick=array_merge($mynick,array('d'=>_::$my['name'],'l'=>_::$my['link'],'mb'=>1,'am'=>$chat->myadmin,'bux'=>number_format($chat->mybux),'box'=>number_format($chat->mybox),'rk'=>$chat->myitem));
			if($chat->myimg!=_::$my['img'])
			{
				$mynick['i']=$chat->myimg=_::$my['img'];
			}
		}
		
		if(count($chat->data['wait']))
		{
			$wait=array();
			for($i=0;$i<count($chat->data['wait']);$i++)
			{
				if($chat->data['wait'][$i]['wt'] && $chat->data['wait'][$i]['wt']<=$chat->time2)
				{
					$chat->inserttext($chat->data['wait'][$i]);
				}
				elseif($chat->data['wait'][$i]['wt'])
				{
					$wait[]=$chat->data['wait'][$i];
				}
			}
			$chat->data['wait']=$wait;
			$chat->save=true;
		}
		
		if(!isset($chat->data['bot'][$v['_id']]))
		{
			$v=$mynick;
		}
	}
	/*
	elseif($chat->room==1&&in_array($v['_id'],$sadmin))
	{
		$uadmin[$v['_id']]=1;
		if($v['t'] && ($chat->time2-$v['t'] > 60))
		{
			$au=_::user()->get($v['_id'],true);
			if($chat->time2 > $au['if']['ch']['du']->sec+300)
			{				
				_::db()->update('chat_online',array('u'=>$au['_id'],'r'=>$chat->room,'m'=>date('n')),array('$inc'=>array('t'=>5)),array('upsert'=>true));
				_::user()->update($au['_id'],array('$set'=>array('if.ch.du'=>new MongoDate())));
			}
			$v['t']=$chat->time2;
		}
	}
	*/
	if(isset($chat->data['bot'][$v['_id']]))
	{
		$v['n']=$chat->data['bot'][$v['_id']]['n'];
		$v['i']=$chat->data['bot'][$v['_id']]['i'];
		$v['l']=$chat->data['bot'][$v['_id']]['l'];
		$v['am']=intval($chat->data['admin'][$v['_id']]['lv']);
		$v['rk']=0;
		
		
		if(_::$my && $v['_id']==$chat->myid)
		{
			$v=$mynick;
		}
		$cbot=$chat->data['bot'][$v['_id']];
		if($cbot['ty']=='poem1'||$cbot['ty']=='poem2'||$cbot['ty']=='poem3'&&!$foundpoem)
		{
			if(!isset($v['ck']))
			{
				$v['ck']=rand(10,$poem_delay);
			}
			if($v['ck']+$poem_delay <= $chat->time2)
			{
				$v['ck']=$chat->time2;
				$pm=@file(__DIR__.'/'.$cbot['ty'].'.txt');
				if(!isset($v['ln']))
				{
					$v['ln']=rand(1,count($pm));
				}
				if($v['ln']>=count($pm))$v['ln']=0;
				if($ms=trim($pm[$v['ln']]))
				{
					$clbot=1;
					$ambot=0;
					if(isset($chat->data['admin'][$v['_id']]))
					{
						$ambot=$chat->data['admin'][$v['_id']]['lv'];
					}
					if($cbot['color'])
					{
						$clbot=$cbot['color'];
						if(is_array($cbot['color']))
						{
							$clbot=$cbot['color'];
							shuffle($clbot);
							$clbot=$clbot[0];
						}
					}
					$chat->inserttext(array('ty'=>'ms','u'=>$v['_id'],'m'=>$ms,'c'=>$clbot,'n'=>$v['n'],'l'=>$v['l'],'i'=>$v['i'],'mb'=>1,'rk'=>$v['rk'],'am'=>$ambot));	
				}
				$v['ln']++;
				$foundpoem=true;
			}
		}
		$v['t']=$chat->time2;
		$chat->data['bot'][$v['_id']]['found']=true;
		$foundbot++;
	}
	if($v['t']+120>=$chat->time2)
	{
		$tmp[$v['_id']]=$v;
	}
}

if(!$found)
{
	$tmp[$chat->myid]=array('_id'=>$chat->myid,'t'=>$chat->time2,'l'=>'','i'=>$chat->myimg,'n'=>$chat->myname,'d'=>'','ip'=>$_SERVER['REMOTE_ADDR'],'mb'=>0,'am'=>0,'bux'=>0,'box'=>0,'rk'=>$chat->myitem);
	if(_::$my)
	{
		$tmp[$chat->myid]['l']=_::$my['link'];
		$tmp[$chat->myid]['d']=_::$my['name'];
		$tmp[$chat->myid]['mb']=1;
		$tmp[$chat->myid]['am']=$chat->myadmin;
		$tmp[$chat->myid]['bux']=number_format($chat->mybux);
		$tmp[$chat->myid]['box']=number_format($chat->mybox);
		if($chat->myadmin && isset($chat->data['admin'][_::$my['_id']]))
		{
			$chat->data['admin'][_::$my['_id']]['ds']=$chat->time2;
			$chat->saveadmin();
		}
	}
	$mynick=$tmp[$chat->myid];
}
/*
if($chat->room==1)
{
	foreach($sadmin as $l)
	{
		if(!$uadmin[$l])
		{
			$ua=_::user()->get($l,true);
			$tmp[$l]=array('_id'=>$l,'t'=>$chat->time2,'l'=>'','i'=>$ua['img'],'n'=>$ua['cname'],'d'=>'','ip'=>$ua['ip'],'mb'=>1,'am'=>0,'bux'=>0,'box'=>0,'rk'=>intval($ua['if']['ch']['ci']));
			$tmp[$l]['l']=$ua['link'];
			$tmp[$l]['d']=$ua['name'];
			$tmp[$l]['mb']=1;
			$tmp[$l]['am']=9;
		}
	}
}
*/
if(is_array($chat->data['bot'])&&$foundbot<count($chat->data['bot']))
{
	foreach($chat->data['bot'] as $a=>$b)
	{
		if(!$chat->data['bot'][$a]['found'])
		{
			$tmp[$a]=array('_id'=>$a,'t'=>$chat->time2,'l'=>$b['l'],'i'=>$b['i'],'n'=>$b['n'],'mb'=>1,'am'=>($chat->data['admin'][$a]?$chat->data['admin'][$a]['lv']:0),'d'=>'','rk'=>intval($b['rk']));
		}
	}
}
$chat->cache->set('ca2','chatbox_user_'.$chat->room,$tmp,false,3600*24);
_::$content[] = array('method'=>'chatbox','type'=>'my','data'=>$mynick);
_::$content[] = array('method'=>'chatbox','type'=>'list','data'=>$tmp);


?>