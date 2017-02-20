<?php
if(_::$my['_id'])
{
	if(_::$path[2])
	{
		list($line,$ch)=explode('-',_::$path[2]);
		if($ch!='')
		{
			$id=intval($line);
			$ans=intval($ch);
			$db = _::db();
			if($tmp = $db->findOne('line',array('_id'=>$id,'ty'=>'poll','dd'=>array('$exists'=>false)),array('po'=>1,'ds'=>1,'u'=>1)))
			{
				if(isset($tmp['po']['d'][$ans]))
				{
					if(in_array(_::$my['_id'],$tmp['po']['u']))
					{
						$pull=array();
						$set=array();
						for($i=0;$i<count($tmp['po']['d']);$i++)
						{
							if(in_array(_::$my['_id'],$tmp['po']['d'][$i]['u']))
							{
								$pull['po.d.'.$i.'.u']=_::$my['_id'];	
								$set['po.d.'.$i.'.c'] = $tmp['po']['d'][$i]['c'] = max(0,intval($tmp['po']['d'][$i]['c'])-1);
							}
						}
						if(count($pull))
						{
							$db->update('line',array('_id'=>$id),array('$set'=>$set,'$pull'=>$pull));
						}
					}
					else
					{
						_::notify()->insert($tmp['u'],'po',$id,mb_substr($tmp['po']['d'][$ans]['m'],0,20,'utf-8'));
						$tmp['po']['c']=intval($tmp['po']['c'])+1;
						$db->update('line',array('_id'=>$id),array(
																															'$set'=>array(
																																							'po.c'=>$tmp['po']['c'],
																																			//				'ds'=>new MongoDate((($tmp['ds']->sec + (3600*24)) > time())?$tmp['ds']->sec:time())
																																				),
																															'$push'=>array(
																																								'po.u'=>_::$my['_id']
																																				),
																												)
														);
					}
					$tmp['po']['d'][$ans]['c']=intval($tmp['po']['d'][$ans]['c'])+1;
					$db->update('line',array('_id'=>$id),array('$set'=>array('po.d.'.$ans.'.c'=>$tmp['po']['d'][$ans]['c']),'$push'=>array('po.d.'.$ans.'.u'=>_::$my['_id'])));
					$ct=array();
					for($i=0;$i<count($tmp['po']['d']);$i++)
					{
						$ct[]=$tmp['po']['d'][$i]['c'];
					}
					_::$content[] = array('method'=>'poll','data'=>array('line'=>$id,'count'=>$tmp['po']['c'],'data'=>$ct));
				}
			}
		}
	}
}
else
{
	_::$content[] = array('method'=>'login');
}

function cm_insert($line,$message)
{
	if(_::$my['_id'])
	{
		$msg = htmlspecialchars(trim($message), ENT_QUOTES,'utf-8');
		//$msg = trim(str_replace(array('<','>'),array('&lt;','&gt;'),$message));
		if(($id=intval(trim($line))) && $msg)
		{
			$db = _::db();
			if($tmp = $db->findOne('line',array('_id'=>$id,'dd'=>array('$exists'=>false)),array('cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'u'=>1,'p'=>1,'s'=>1)))
			{
				$push = true;
				if(!is_array($tmp['cm']))
				{
					$tmp['cm']=array('c'=>0,'i'=>0,'u'=>array(),'l'=>array());
					$push = false;
				}
				$cm_u= (array)$tmp['cm']['u'];
				$cm_i = intval($tmp['cm']['i'])+1;
				$cm_c = intval($tmp['cm']['c'])+1;
				if(!in_array(_::$my['_id'],$cm_u) && _::$my['_id']!=$tmp['u'] && _::$my['_id']!=$tmp['p'])
				{
					array_push($cm_u,_::$my['_id']);
				}
				if($push)
				{
					$arg = array('$set'=>array('cm.c'=>$cm_c,'cm.i'=>$cm_i,'cm.u'=>$cm_u),'$push'=>array('cm.d'=>array('i'=>$cm_i,'m'=>$msg,'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])));
				}
				else
				{
					$arg = array('$set'=>array('cm'=>array('c'=>$cm_c,'i'=>$cm_i,'u'=>$cm_u,'d'=>array(array('i'=>$cm_i,'m'=>$msg,'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])))));
				}
				$db->update('line',array('_id'=>$id),$arg);
				
				cm_list($id,-3);
				
				$notify = _::notify();
				$user = _::user();
				array_push($cm_u,$tmp['u'],$tmp['p']);
				for($i=0;$i<count($cm_u);$i++)
				{
					if((_::$my['_id']!=$cm_u[$i]) && $cm_u[$i])
					{
						if($c=$db->findOne('notify',array('u'=>_::$my['_id'],'p'=>$cm_u[$i],'rl'=>$id,'ty'=>'cm'),array('_id'=>1,'dr'=>1)))
						{
							$db->update('notify',array('_id'=>$c['_id']),array('$set'=>array('dr'=>NULL,'tt'=>mb_substr($msg,0,20,'utf-8'),'da'=>new MongoDate())));
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
							$notify->insert($cm_u[$i],'cm',$id,mb_substr($msg,0,20,'utf-8'));
						}
					}
				}
			}
			else
			{
				
			}
		}
	}
}


function cm_delete($line,$cid)
{
	if(_::$my['_id'] && $cid)
	{
		$db = _::db();
		if($tmp = $db->findOne('line',array('_id'=>$line,'dd'=>array('$exists'=>false)),array('cm.d'=>1,'cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'u'=>1,'p'=>1,'s'=>1)))
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
				if($tmp['u']==_::$my['_id'] || $tmp['p']==_::$my['_id'] || $cm['u']==_::$my['_id'])
				{
					//db.line.update({_id:185},{$pull:{'cm.d':{'i':17}}})
					$c = max(0,intval($tmp['cm']['c'])-1);
					$db->update('line',array('_id'=>$line),array('$set'=>array('cm.c'=>$c),'$pull'=>array('cm.d'=>array('i'=>$cid)),'$push'=>array('cm.e'=>$cm)));
					_::$content[] = array('method'=>'cm','data'=>array('type'=>'delete','_id'=>$line,'i'=>$cid,'c'=>$c));
				}
			}
		}
	}
}

function cm_list($line,$start=-5)
{
	if(($id=intval(trim($line))))
	{
		if($tmp = _::db()->findOne('line',array('_id'=>$id),array('_id'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>$start))))
		{
			$u = _::user();
			for($i=0;$i<count($tmp['cm']['d']);$i++)
			{
				$tmp['cm']['d'][$i]['u'] = $u->profile($tmp['cm']['d'][$i]['u']);
				$tmp['cm']['d'][$i]['t'] = $tmp['cm']['d'][$i]['t']->sec;
				$tmp['cm']['d'][$i]['lc'] = count($tmp['cm']['d'][$i]['l']);
				$tmp['cm']['d'][$i]['lm'] = (in_array(_::$my['_id'],(array)$tmp['cm']['d'][$i]['l']));
				unset($tmp['cm']['d'][$i]['p']);
			}
			$tmp['t']=strval(_::$path[4]);
			$tmp['type']='list';
			_::$content[] = array('method'=>'cm','data'=>$tmp);
		}
	}
}


?>