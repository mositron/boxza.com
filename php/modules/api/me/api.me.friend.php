<?php
if(_::$my['_id'])
{
	$arg = explode('-',_::$path[2]);
	if(!$arg[0]||$arg[0]=='list')
	{
		$list=(array)_::$my['ct']['fr'];
		list($n,$next) = explode('-',_::$path[3]);
		if(!$next||$next<0)
		{
			$next=0;
		}
		$p=0;
		$per = 50;
		$count = count($list);
		if($start>$count)return'';
		$arg=array('_id'=>array('$in'=>$list),'$or'=>array(array('st'=>array('$gte'=>0)),array('st'=>array('$exists'=>false))));
		if(!$res=_::db()->find('user',$arg,array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1),array('skip'=>$next,'limit'=>$per)))
		{
			$res=array();
		}
		_::$content[]=array('method'=>'friend','type'=>'list','next'=>$next,'data'=>$res);
	}
	else
	{
		$pid = intval($arg[1]);
		if($pid && _::$my['_id']!=$pid)
		{
			$db = _::db();
			$user = _::user();
			$friend = 0;
			if($arg[0]=='accept'||$arg[0]=='request')
			{
				/*
				if($f=$db->findOne('friend',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>$pid),array('p'=>_::$my['_id'],'u'=>$pid))),array('_id'=>1,'u'=>1,'p'=>1,'ac'=>1)))
				{
					if(!$f['ac'])
					{
						if($f['p']==_::$my['_id'])
						{
							if($u=$user->get($f['u'],true))
							{
								if(count(_::$my['ct']['fr'])>=1500)
								{
									_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'คุณมีเพื่อนครบ 1,500 คนแล้ว'));
								}
								elseif(count($u['ct']['fr'])>=1500)
								{
									_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'เพื่อนของคุณ มีเพื่อนครบ 1,500 คนแล้ว'));
								}
								else
								{
									$db->update('friend',array('_id'=>$f['_id']),array('$set'=>array('du-'._::$my['_id']=>new MongoDate(),'du-'.$pid=>new MongoDate(),'ac'=>new MongoDate())));			
									_::notify()->insert($f['u'],'friend-accept');
									_::$content[]=array('method'=>'friend','type'=>'accept','data'=>array('type'=>'accept','uid'=>$pid,'class'=>'friend','label'=>'เพื่อน'));
									insert_uid_to_friends(_::$my['_id'],$pid);
									$db->remove('notify',array('ty'=>'friend','u'=>$pid,'p'=>_::$my['_id']));
									//$u=$user->get($f['u'],true);
									if(!$u['op']['em']['ac'])
									{
										if(!$db->findOne('cron_notifications',array('u'=>_::$my['_id'],'p'=>$f['u'],'ty'=>'ac')))
										{
											$db->insert('cron_notifications',array('u'=>_::$my['_id'],'p'=>$f['u'],'ty'=>'ac'));
										}
									}
								}
							}
							else
							{
								
							}
						}
						else
						{
							
							if(count(_::$my['ct']['fr'])>=1500)
							{
								_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'คุณมีเพื่อนครบ 1,500 คนแล้ว'));
							}
							elseif(count(_::$my['ct']['fq'])>=500)
							{
								_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'คุณมีคำขอเป็นเพื่อนครบ 500 ครั้งแล้ว'));
							}
							else
							{
								_::$content[]=array('method'=>'friend','type'=>'request','data'=>array('type'=>'request','uid'=>$pid,'class'=>'frequest','label'=>'รอตอบกลับ'));
								if(!in_array($pid,(array)_::$my['ct']['fq']))
								{
									$user->update(_::$my['_id'],array('$push'=>array('ct.fq'=>new MongoInt32($pid))));
								}
								else
								{
									$user->reset(_::$my['_id']);
								}
							}
						}
					}
					else
					{
						insert_uid_to_friends(_::$my['_id'],$pid);
						_::$content[]=array('method'=>'friend','type'=>'accept','data'=>array('type'=>'accept','uid'=>$pid,'class'=>'friend','label'=>'เพื่อน'));
					}
				}
				elseif($arg[0]=='request')
				{
					if(!_::$my['st']||_::$my['st']<1)
					{
							_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'คุณไม่สามารถเพิ่มเพื่อนได้ เนื่องจากยังไม่ยืนยันการสมัครสมาชิก'));
					}
					elseif($u = $user->get($pid,true))
					{
						if($u['if']['ac']!=1)
						{
							_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>$u['name'].' ไม่เปิดรับเพื่อนใหม่ในขณะนี้'));
						}
						elseif(!$u['st']||$u['st']<1)
						{
							_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>$u['name'].' ไม่สามารถรับเพื่อนได้ เนื่องจากเขา/เธอยังไม่ยืนยันการสมัครสมาชิก'));
						}
						elseif(!in_array(_::$my['_id'],(array)$u['ct']['fr']))
						{
							$user->update(_::$my['_id'],array('$push'=>array('ct.fq'=>new MongoInt32($pid))));
							$db->insert('friend',array('u'=>_::$my['_id'],'p'=>$pid));
							_::notify()->insert($pid,'friend');
							_::$content[]=array('method'=>'friend','type'=>'request','data'=>array('type'=>'request','uid'=>$pid,'class'=>'frequest','label'=>'รอตอบกลับ'));
							
							if(!$u['op']['em']['rq'])
							{
								if(!$db->findOne('cron_notifications',array('u'=>_::$my['_id'],'p'=>$pid,'ty'=>'rq')))
								{
									$db->insert('cron_notifications',array('u'=>_::$my['_id'],'p'=>$pid,'ty'=>'rq'));
								}
							}
						}
						else
						{
							$user->update(_::$my['_id'],array('$pull'=>array('ct.fq'=>$u['_id'])));
							$user->update($u['_id'],array('$pull'=>array('ct.fq'=>_::$my['_id'])));
						}
					}
				}
				else
				{
					$db->remove('notify',array('ty'=>'friend','u'=>$pid,'p'=>_::$my['_id']));
				}
			*/
			}
			elseif($arg[0]=='cancel')
			{
				$db->remove('notify',array('ty'=>'friend','u'=>$pid,'p'=>_::$my['_id']));
				$db->remove('notify',array('ty'=>'friend','p'=>$pid,'u'=>_::$my['_id']));
				$user->update(_::$my['_id'],array('$pull'=>array('ct.fq'=>$pid)));
				$user->update($pid,array('$pull'=>array('ct.fq'=>_::$my['_id'])));
				if($f=$db->findOne('friend',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>$pid),array('p'=>_::$my['_id'],'u'=>$pid))),array('_id'=>1,'u'=>1,'p'=>1,'ac'=>1)))
				{
					if($f['p']==_::$my['_id'])
					{
						$db->update('friend',array('_id'=>$f['_id']),array('$set'=>array('dd'=>new MongoDate())));
					}
				}
			}
			elseif($arg[0]=='delete')
			{
				if(in_array($pid,(array)_::$my['ct']['fr']) || in_array($pid,(array)_::$my['ct']['fq']))
				{
					$db->remove('friend',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>$pid),array('p'=>_::$my['_id'],'u'=>$pid))));
					$user->update(_::$my['_id'],array('$pull'=>array('ct.fr'=>$pid,'ct.fq'=>$pid)));
					$user->update($pid,array('$pull'=>array('ct.fr'=>_::$my['_id'],'ct.fq'=>_::$my['_id'])));
					_::$content[]=array('method'=>'friend','type'=>'delete','data'=>array('type'=>'delete','uid'=>$pid,'class'=>'frequest','label'=>'ลบเพื่อนแล้ว'));
					
					
					for($i=0;$i<count(_::$my['ct']['gp']);$i++)
					{
						if(in_array($pid,(array)_::$my['ct']['gp'][$i]['u']))
						{
							$user->update(_::$my['_id'],array('$pull'=>array('ct.gp.'.$i.'.u'=>$pid)));
						}
					}
					
					if($u=$user->get($pid,true))
					{
						for($i=0;$i<count($u['ct']['gp']);$i++)
						{
							if(in_array($pid,(array)$u['ct']['gp'][$i]['u']))
							{
								$user->update($u['_id'],array('$pull'=>array('ct.gp.'.$i.'.u'=>_::$my['_id'])));
							}
						}
					}
				}
			}
			elseif($arg[0]=='follow')
			{			
				if(!_::$my['st']||_::$my['st']<1)
				{
						_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'คุณไม่สามารถติดตามผู้อื่นได้ เนื่องจากยังไม่ยืนยันการสมัครสมาชิก'));
				}
				elseif($u = $user->get($pid,true))
				{
					if(in_array($pid,(array)_::$my['ct']['fr']))
					{
						_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'คุณเป็นเพื่อนกับ '.$n['name'].' อยู่แล้ว'));
					}
					elseif(!$u['st']||$u['st']<1)
					{
						_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>$u['name'].' ไม่สามารถรับการติดตามได้ เนื่องจากเขา/เธอยังไม่ยืนยันการสมัครสมาชิก'));
					}
					elseif(count((array)_::$my['ct']['fl'])>=500)
					{
						_::$content[]=array('method'=>'friend','type'=>'error','data'=>array('type'=>'error','uid'=>$pid,'msg'=>'คุณสามารถติดตามได้สูงสุด 500 คนเท่านั้น'));
					}
					else
					{
						if(in_array($pid,(array)_::$my['ct']['fq']))
						{
							$db->remove('friend',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>$pid),array('p'=>_::$my['_id'],'u'=>$pid))));
							$user->update(_::$my['_id'],array('$pull'=>array('ct.fr'=>$pid,'ct.fq'=>$pid)));
							$user->update($pid,array('$pull'=>array('ct.fr'=>_::$my['_id'],'ct.fq'=>_::$my['_id'])));
						}
						if(!in_array($pid,(array)_::$my['ct']['fl']))
						{
							$user->update(_::$my['_id'],array('$push'=>array('ct.fl'=>new MongoInt32($pid))));
							$user->update($pid,array('$inc'=>array('if.fl'=>1)));
							if(!$db->findone('notify',array('ty'=>'follow','u'=>_::$my['_id'],'p'=>$pid)))
							{
								_::notify()->insert($pid,'follow');
							}
						}
						_::$content[]=array('method'=>'friend','type'=>'follow','data'=>array('type'=>'follow','uid'=>$pid,'class'=>'button','label'=>'ติดตามแล้ว'));
					}
				}
			}
			elseif($arg[0]=='unfollow')
			{
				if(in_array($pid,(array)_::$my['ct']['fl']))
				{
					$user->update(_::$my['_id'],array('$pull'=>array('ct.fl'=>$pid)));
					for($i=0;$i<count(_::$my['ct']['gp']);$i++)
					{
						if(in_array($pid,(array)_::$my['ct']['gp'][$i]['u']))
						{
							$user->update(_::$my['_id'],array('$pull'=>array('ct.gp.'.$i.'.u'=>$pid)));
						}
					}
					$user->update($pid,array('$inc'=>array('if.fl'=>-1)));
				}
				_::$content[]=array('method'=>'friend','type'=>'unfollow','data'=>array('type'=>'unfollow','uid'=>$pid,'class'=>'button','label'=>'ยกเลิกการติดตามแล้ว'));
			}
		}
		if(_::$path[3]=='reload')
		{
			_::$content[]=array('method'=>'reload');
		}
	}
}
else
{
	_::$content[] = array('method'=>'login');
}

function insert_uid_to_friends($uid,$pid)
{
	if($uid!=$pid)
	{
		$db = _::db();
		$user = _::user();
		if($u = $user->get($uid,true))
		{
			if($ud = $user->get($pid,true))
			{			
				require_once(HANDLERS.'facebook/facebook.php');	
				$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']));
				#1 - user -> uid : friend list 
				if(!is_array($u['ct']['fr']))$u['ct']['fr']=array();
				if(!in_array($pid,$u['ct']['fr']))
				{
					$u['ct']['fr'][]=$pid;
					//array_values(array_filter(array_unique($u['ct']['fr'])))
					$user->update($uid,array('$push'=>array('ct.fr'=>new MongoInt32($pid)),'$pull'=>array('ct.fq'=>$pid)));
				}
				if(in_array($pid,(array)$u['ct']['fl']))
				{
					$user->update($u['_id'],array('$pull'=>array('ct.fl'=>$pid)));
					for($i=0;$i<count($u['ct']['gp']);$i++)
					{
						if(in_array($pid,(array)$u['ct']['gp'][$i]['u']))
						{
							$user->update($u['_id'],array('$pull'=>array('ct.gp.'.$i.'.u'=>$pid)));
						}
					}
					$user->update($pid,array('$inc'=>array('if.fl'=>-1)));
				}
				
				#2 - uid -> user : friend list 
				if(!is_array($ud['ct']['fr']))$ud['ct']['fr']=array();
				if(!in_array($uid,$ud['ct']['fr']))
				{
					$ud['ct']['fr'][]=$uid;
					//$ct_fr=array_values(array_filter(array_unique($ud['ct']['fr'])));
					
					$user->update($pid,array('$push'=>array('ct.fr'=>new MongoInt32($uid)),'$pull'=>array('ct.fq'=>$uid)));
				}
				if(in_array($uid,(array)$ud['ct']['fl']))
				{
					$user->update($ud['_id'],array('$pull'=>array('ct.fl'=>$uid)));
					for($i=0;$i<count($ud['ct']['gp']);$i++)
					{
						if(in_array($uid,(array)$ud['ct']['gp'][$i]['u']))
						{
							$user->update($ud['_id'],array('$pull'=>array('ct.gp.'.$i.'.u'=>$uid)));
						}
					}
					$user->update($uid,array('$inc'=>array('if.fl'=>-1)));
				}
			}
		}
	}
}
?>