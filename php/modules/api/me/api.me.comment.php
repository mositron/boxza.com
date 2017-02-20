<?php
if(_::$my['_id'])
{
	if(_::$path[2]&&_::$path[3])
	{
		$line = intval(_::$path[2]);
		$type=_::$path[3];
		
		if(in_array($type,array('list','insert','delete')))
		{
			$db = _::db();
			
			switch($type)
			{
				case 'insert':
					cm_insert($line,stripslashes($_GET['message']));
					break;
				case 'list':
					cm_list($line,-50);
					break;
				case 'delete':
					cm_delete($line,intval(_::$path[4]));
					break;
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
			if($tmp = $db->findOne('line',array('_id'=>$id,'dd'=>array('$exists'=>false)),array('cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'ty'=>1,'tt'=>1,'u'=>1,'p'=>1,'s'=>1)))
			{
				
			
				$bad=array('qpidradio.com','chat.boxza.com','satangame.com','dj-fluke.zz.mu');
				foreach($bad as $v)
				{
					if(stripos($msg,$v)===true)
					{
						_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>_::$my['_id'],'msg'=>'คุณไม่สามารถโพสข้อความนี้ได้'));
						return;
					}
				}
				
				if(in_array($tmp['u'],(array)_::$my['ct']['bl']))
				{
					return;
				}
				elseif(in_array($tmp['u'],(array)_::$my['ct']['bl2']))
				{
					return;
				}
				if($tmp['p'])
				{
					if(in_array($tmp['p'],(array)_::$my['ct']['bl2']))
					{
						return;
					}
					elseif(in_array($tmp['p'],(array)_::$my['ct']['bl2']))
					{
						return;
					}
				}
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
					$arg = array('$set'=>array('ex'=>new MongoDate(time()+_::$config['line_expire']),'cm.c'=>$cm_c,'cm.i'=>$cm_i,'cm.u'=>$cm_u),'$push'=>array('cm.d'=>array('i'=>$cm_i,'m'=>$msg,'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])));
				}
				else
				{
					$arg = array('$set'=>array('ex'=>new MongoDate(time()+_::$config['line_expire']),'cm'=>array('c'=>$cm_c,'i'=>$cm_i,'u'=>$cm_u,'d'=>array(array('i'=>$cm_i,'m'=>$msg,'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])))));
				}
				if(!$tmp['p']&&$tmp['ty']=='quiz'&&is_array($tmp['tt'])&&_::$my['st'])
				{
					if($tmp['tt']['a'])
					{
						$arg['$set']['ds']=new MongoDate();
						if(strtolower($msg)==strtolower($tmp['tt']['a']))
						{
							$arg['$set']['p']=_::$my['_id'];
							
							if(_::point()->action(_::$my['_id'],intval($tmp['tt']['p']),'quiz','ตอบ Quiz ถูกต้อง'))
							{
								
							}
						}
					}
				}
				if($tmp['u']!=_::$my['_id']&&$tmp['p']!=_::$my['_id'])
				{
					$arg['$set']['dc']=new MongoDate();
				}
				$db->update('line',array('_id'=>$id),$arg);
				
				cm_list($id,($_GET['full']?-50:-3));
				
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
			$cm=array();
			for($i=0;$i<count($tmp['cm']['d']);$i++)
			{
				if($tmp['cm']['d'][$i]['u'] = $u->profile($tmp['cm']['d'][$i]['u']))
				{
					if(_::$my['_id'])
					{
						if(in_array($tmp['cm']['d'][$i]['u']['_id'],(array)_::$my['ct']['bl']))
						{
							
						}
						elseif(in_array($tmp['cm']['d'][$i]['u']['_id'],(array)_::$my['ct']['bl2']))
						{
							
						}
						else
						{
							$tmp['cm']['d'][$i]['t'] = $tmp['cm']['d'][$i]['t']->sec;
							$tmp['cm']['d'][$i]['lc'] = count($tmp['cm']['d'][$i]['l']);
							$tmp['cm']['d'][$i]['lm'] = (in_array(_::$my['_id'],(array)$tmp['cm']['d'][$i]['l']));
							$cm[]=$tmp['cm']['d'][$i];
						}
					}
				}
			}
			$tmp['cm']['d']=$cm;
			$tmp['t']=strval(_::$path[4]);
			$tmp['type']='list';
			_::$content[] = array('method'=>'cm','data'=>$tmp);
		}
	}
}


?>