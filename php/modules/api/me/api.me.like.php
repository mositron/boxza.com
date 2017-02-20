<?php
if(_::$my['_id'])
{
	if(_::$path[2])
	{
		list($line,$cm)=explode('-',_::$path[2]);
		$type=(_::$path[3]?_::$path[3]:'like');
		if($line=intval($line))
		{
			$cm=intval($cm);
			if(in_array($type,array('like','unlike','list')))
			{
				$db = _::db();
				switch($type)
				{
					case 'like':
						$cm?like_like_cm($line,$cm):like_like($line);
						break;
					case 'unlike':
						$cm?like_unlike_cm($line,$cm):like_unlike($line);
						break;
					case 'list':
						$cm?like_list_cm($line,$cm):like_list($line);
						break;
				}
			}
		}
	}
}
else
{
	_::$content[] = array('method'=>'login');
}


function like_like($line)
{
	$db = _::db();
	if($tmp = $db->findOne('line',array('_id'=>$line),array('lk'=>1,'u'=>1,'p'=>1,'s'=>1)))
	{
		$push = true;
		if(!is_array($tmp['lk']))
		{
			$tmp['lk']=array('c'=>0,'u'=>array());
			$push = false;
		}		
		$cm_u= (array)$tmp['lk']['u'];
		$cm_c = intval($tmp['lk']['c']);
		if(!in_array(_::$my['_id'],(array)$tmp['lk']['u']))
		{
			$cm_c++;
			array_push($cm_u,_::$my['_id']);
			if($push)
			{
				$arg = array('$set'=>array('ex'=>new MongoDate(time()+_::$config['line_expire']),'lk.c'=>$cm_c),'$push'=>array('lk.u'=>_::$my['_id']));
			}
			else
			{
				$arg = array('$set'=>array('ex'=>new MongoDate(time()+_::$config['line_expire']),'lk'=>array('c'=>$cm_c,'u'=>array(_::$my['_id']))));
			}
			$db->update('line',array('_id'=>$line),$arg);
			$notify = _::notify();
			$user = _::user();
			$cm_u=array($tmp['u'],$tmp['p']);
			for($i=0;$i<count($cm_u);$i++)
			{
				if((_::$my['_id']!=$cm_u[$i]) && $cm_u[$i])
				{
					if($c=$db->findOne('notify',array('u'=>_::$my['_id'],'p'=>$cm_u[$i],'rl'=>$line,'ty'=>'lk'),array('_id'=>1,'dr'=>1)))
					{
						$db->update('notify',array('_id'=>$c['_id']),array('$set'=>array('da'=>new MongoDate()),'$unset'=>array('dr'=>1)));
						if($c['dr'])
						{
							if($uid=$user->get($cm_u[$i],true))
							{
								if(!is_array($uid['nf']))$uid['nf']=array('ot'=>0,'fr'=>0);
								$uid['nf']['ot']=(intval($uid['nf']['ot'])+1);
								$user->update($uid['_id'],array('$set'=>array('nf'=>$uid['nf'])));
							}
						}
					}
					else
					{
						$notify->insert($cm_u[$i],'lk',$line);
					}
				}
			}
		}
		_::$content[] = array('method'=>'lk','data'=>array('l'=>$line,'c'=>$cm_c,'s'=>'like'));
	}
}

function like_unlike($line)
{
	$db = _::db();
	if($tmp = $db->findOne('line',array('_id'=>$line),array('lk'=>1,'u'=>1,'p'=>1,'s'=>1)))
	{
		if(!is_array($tmp['lk']))
		{
			$tmp['lk']=array('c'=>0,'u'=>array());
		}
		$cm_u= (array)$tmp['lk']['u'];
		$cm_c = intval($tmp['lk']['c']);
		
		if(in_array(_::$my['_id'],$cm_u))
		{
			$cm_c--;
			$db->update('line',array('_id'=>$line),array('$pull'=>array('lk.u'=>_::$my['_id']),'$set'=>array('lk.c'=>$cm_c)));
		}
		_::$content[] = array('method'=>'lk','data'=>array('l'=>$line,'c'=>$cm_c,'s'=>'unlike'));
	}
}

function like_like_cm($line,$cid)
{
	$db = _::db();
	if($tmp = $db->findOne('line',array('_id'=>$line),array('cm.d'=>1)))
	{
		$cm = false;
		for($i=0;$i<count($tmp['cm']['d']);$i++)
		{
			if($tmp['cm']['d'][$i]['i'] == $cid)
			{
				$cm = $tmp['cm']['d'][$i];
				break;
			}
		}
		if($cm)
		{
			if(!is_array($cm['l']))$cm['l']=(array)$cm['l'];
			if(!in_array(_::$my['_id'],$cm['l']))
			{
				array_push($cm['l'],_::$my['_id']);
				$db->update('line',array('_id'=>$line,'cm.d'=>array('$elemMatch'=>array('i'=>$cid))),array('$set'=>array('cm.d.$.l'=>$cm['l'])));
				if($cm['u']!=_::$my['_id'])
				{
					if($c=$db->findOne('notify',array('u'=>_::$my['_id'],'p'=>$cm['u'],'rl'=>$line,'ty'=>'lk-cm'),array('_id'=>1,'dr'=>1)))
					{
						$db->update('notify',array('_id'=>$c['_id']),array('$set'=>array('tt'=>mb_substr($cm['m'],0,20),'dr'=>NULL,'da'=>new MongoDate())));
						if($c['dr'])
						{
							$user = _::user();
							if($uid=$user->get($cm['u'],true))
							{
								if(!is_array($uid['nf']))$uid['nf']=array('ot'=>0,'fr'=>0);
								$uid['nf']['ot']=(intval($uid['nf']['ot'])+1);
								$user->update($uid['_id'],array('$set'=>array('nf'=>$uid['nf'])));
							}
						}
					}
					else
					{
						_::notify()->insert($cm['u'],'lk-cm',$line,mb_substr($cm['m'],0,20));
					}
				}
			}
			_::$content[] = array('method'=>'lk','data'=>array('l'=>$line,'i'=>$cid,'c'=>count($cm['l']),'s'=>'like'));
		}
	}
}


function like_unlike_cm($line,$cid)
{
	$db = _::db();
	if($tmp = $db->findOne('line',array('_id'=>$line),array('cm.d'=>1)))
	{
		$cm = false;
		for($i=0;$i<count($tmp['cm']['d']);$i++)
		{
			if($tmp['cm']['d'][$i]['i'] == $cid)
			{
				$cm = $tmp['cm']['d'][$i];
				break;
			}
		}
		if($cm)
		{
			if(!is_array($cm['l']))$cm['l']=(array)$cm['l'];
			if(in_array(_::$my['_id'],$cm['l']))
			{
				$k = array_flip($cm['l']);
				unset($k[_::$my['_id']]);
				$cm['l'] = array_keys($k);
				$db->update('line',array('_id'=>$line,'cm.d'=>array('$elemMatch'=>array('i'=>$cid))),array('$set'=>array('cm.d.$.l'=>$cm['l'])));
			}
			_::$content[] = array('method'=>'lk','data'=>array('l'=>$line,'i'=>$cid,'c'=>count($cm['l']),'s'=>'unlike'));
		}
	}
}







function like_list($line,$start=0)
{
	$db = _::db();
	$limit=50;
	if($tmp = $db->findOne('line',array('_id'=>$line),array('lk.u'=>array('$slice'=>array($start,$limit)))))
	{
		$l = array_slice((array)$tmp['lk']['u'],$start,50);
		$u = _::user();
		$d = array();
		for($i=0;$i<count($l);$i++)
		{
			$d[]=$u->profile($l[$i]);
		}
		_::$content[] = array('method'=>'lk','data'=>array('l'=>$line,'u'=>$d,'n'=>$start+$limit,'s'=>'list'));
	}
}

function like_list_cm($line,$cid,$start=0)
{
	$db = _::db();
	$limit=50;
	if($tmp = $db->findOne('line',array('_id'=>$line),array('cm.d'=>1)))
	{
		$cm = false;
		for($i=0;$i<count($tmp['cm']['d']);$i++)
		{
			if($tmp['cm']['d'][$i]['i'] == $cid)
			{
				$cm = $tmp['cm']['d'][$i];
				break;
			}
		}
		if($cm)
		{
			if(is_array($cm['l']))
			{
				$l = array_slice($cm['l'],$start,50);
				$user = _::user();
				$d = array();
				for($i=0;$i<count($l);$i++)
				{
					$d[]=$user->profile($l[$i]);
				}
				_::$content[] = array('method'=>'lk','data'=>array('l'=>$line,'i'=>$cid,'u'=>$d,'n'=>$start+$limit,'s'=>'list'));
			}
		}
	}
}
?>