<?php

function vote($t)
{
	if(in_array($t,array('+','-')))
	{
		$ajax=_::ajax();
		if(_::$my)
		{
			$inc = ($t=='+'?1:-1);
			if(_::$my['_id']==_::$profile['_id'])
			{
				$ajax->alert('ไม่สามารถโหวตโปรไฟล์ตัวเองได้');
			}
			elseif(intval(_::$my['st'])<1)
			{
				$ajax->alert('ไม่สามารถโหวตได้!. เนื่องจากคุณยังไม่ยืนยันการสมัครสมาชิกผ่านอีเมล์');
			}
			elseif(intval(_::$profile['st'])<1)
			{
				$ajax->alert('โปรไฟล์นี้ ยังไม่ยืนยันการสมัครสมาชิกผ่านอีเมล์');
			}
			else
			{
				$db=_::db();
				$user=_::user();
				if($profile=$db->findone('user',array('_id'=>_::$profile['_id']),array('_id'=>1,'pf.vt'=>1)))
				{
					$tm = date('Y-m-d');
					if($tm!=$profile['pf']['vt']['t'])
					{
						$user->update(_::$profile['_id'],array('$set'=>array('pf.vt.t'=>$tm,'pf.vt.m'=>intval($profile['pf']['vt']['m'])+$inc,'pf.vt.a'=>intval($profile['pf']['vt']['a'])+$inc,'pf.vt.u'=>array(_::$my['_id']))));
						$ajax->jquery('#vresult','html',number_format(intval($profile['pf']['vt']['m'])+$inc));
						$ajax->alert('โหวตเรียบร้อยแล้ว');
						_::notify()->insert(_::$profile['_id'],'vt');
					}
					else
					{
						if(in_array(_::$my['_id'],(array)$profile['pf']['vt']['u']))
						{
							$ajax->alert('คุณทำการโหวตโปรไฟล์นี้แล้ว, คุณสามารถโหวตได้ใหม่อีกครั้ง ในวันพรุ่งนี้');
						}
						else
						{
							$user->update(_::$profile['_id'],array('$set'=>array('pf.vt.m'=>intval($profile['pf']['vt']['m'])+$inc,'pf.vt.a'=>intval($profile['pf']['vt']['a'])+$inc),'$push'=>array('pf.vt.u'=>_::$my['_id'])));
							$ajax->jquery('#vresult','html',number_format(intval($profile['pf']['vt']['m'])+$inc));
							$ajax->alert('โหวตเรียบร้อยแล้ว');
							_::notify()->insert(_::$profile['_id'],'vt');
						}
					}
				}
			}
		}
		else
		{
			$ajax->alert('กรุณาล็อคอินก่อนทำการโหวต');
		}
	}
}

function setrec()
{
	if(_::$my['am'])
	{
		_::user()->update(_::$profile['_id'],array('$set'=>array('pf.vt.rc'=>new MongoDate())));
		_::cache()->delete('ca1','line-rec',0);
		_::ajax()->alert('ตั้งเป็นเพื่อนแนะนำเรียบร้อยแล้ว');
		_::ajax()->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
	}
}

function sethideall()
{
	if(_::$my['am']>=9)
	{
		$db=_::db();
		_::user()->update(_::$profile['_id'],array('$set'=>array('if.ha'=>1)));
		$db->update('line',array('u'=>_::$profile['_id']),array('$set'=>array('ha'=>1)),array('multiple'=>true));
		_::ajax()->alert('ซ่อนโพสต่อทั้งหมดเรียบร้อยแล้ว');
		_::ajax()->script('_.line.go("/'._::$profile['link'].'");');
	}
}
function setban()
{
	if(_::$my['am']>=9)
	{
		$db=_::db();
		_::user()->update(_::$profile['_id'],array('$set'=>array('st'=>-1)));
		$db->update('line',array('u'=>_::$profile['_id']),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
		$db->update('line',array('p'=>_::$profile['_id']),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
		
		
		$db->update('chat',array('u'=>_::$profile['_id']),array('$set'=>array('c-p'=>new MongoDate(),'c-u'=>new MongoDate())),array('multiple'=>true));
		$db->update('chat',array('p'=>_::$profile['_id']),array('$set'=>array('c-p'=>new MongoDate(),'c-u'=>new MongoDate())),array('multiple'=>true));
		
		$db->update('deal',array('u'=>_::$profile['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
		$db->update('video',array('u'=>_::$profile['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
		$db->update('forum',array('u'=>_::$profile['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
		
		
		$db->update('racing_forum',array('u'=>_::$profile['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
		$db->update('racing_market',array('u'=>_::$profile['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
		
				
		$db->remove('notify',array('u'=>_::$profile['_id']));
		$db->remove('notify',array('p'=>_::$profile['_id']));
						
		$db->update('chatroom',array('u'=>_::$profile['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));

		$db->remove('friend',array('$or'=>array(array('u'=>_::$profile['_id']),array('p'=>_::$profile['_id']))));

		$db->update('user',array(),array('$pull'=>array('ct.ig'=>_::$profile['_id'],'ct.bl'=>_::$profile['_id'],'ct.bl2'=>_::$profile['_id'],'ct.fr'=>_::$profile['_id'],'ct.fq'=>_::$profile['_id'])),array('multiple'=>true));
		$ip=_::$profile['ip'];
		if(!is_array($ip))
		{
			$ip=array($ip);	
		}
		foreach($ip as $p)
		{
			if($idp=$db->findone('block_ip',array('ip'=>$p)))
			{
				$db->update('block_ip',array('_id'=>$idp['_id']),array('$set'=>array('du'=>new mongodate())));
			}
			else
			{
				$db->insert('block_ip',array('du'=>new mongodate(),'ip'=>$p));
			}
		}
		_::ajax()->alert('แบนสมาชิกนี้แล้ว');
		_::ajax()->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
	}
}

function setverify()
{
	if(_::$my['am']>=9)
	{
		$db=_::db();
		_::user()->update(_::$profile['_id'],array('$set'=>array('st'=>1)));
		_::ajax()->alert('ยืนยันการสมัครของสมาชิกนี้แล้ว');
		_::ajax()->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
	}
}


function sendgift($arg)
{
	$ajax=_::ajax();
	if(_::$my['_id']!=_::$profile['_id'])
	{
		if(_::$profile['_id']==$arg['profile'])
		{
			$gift=array();
			$_g=_::db()->find('lionica_item_shop',array('ty'=>'gift','pl'=>1),array(),array('sort'=>array('da'=>-1)));
			foreach($_g as $g)
			{
				$gift[$g['_id']]=$g;	
			}
			
			if(!trim($arg['ms']))
			{
				$ajax->alert('กรุณากรอกข้อความของคุณ');
			}
			elseif(!trim($arg['gift']))
			{
				$ajax->alert('กรุณาเลือกของหวัญที่ต้องการส่ง');
			}
			elseif(!isset($gift[trim($arg['gift'])]))
			{
				$ajax->alert('ของขวัญดังกล่าวหมดเวลาขายแล้ว');
			}
			else
			{
				$db=_::db();
				$gf=$gift[trim($arg['gift'])];
				$co=intval($gf['pr']);	
				if($co>intval(_::$my['cd']['p']))
				{
					$ajax->alert('คุณมีบ๊อกไม่เพียงพอ');
				}
				elseif(is_array($gf['u']) && !in_array(_::$my['_id'],$gf['u']))
				{
					$ajax->alert('ไม่มีสิทธิ์ซื้อของขวัญชิ้นนี้ได้');
				}
				else
				{
					if(_::point()->action(_::$my['_id'],-$co,'gift','ซื้อของขวัญ '.$gf['n'].' มอบให้ <a href="http://boxza.com/'._::$profile['link'].'" target="_blank">'._::$profile['name'].'</a>'))
					{
						$db->insert('gift',array(
																					'u'=>_::$profile['_id'],
																					'p'=>_::$my['_id'],
																					'gf'=>trim($arg['gift']),
																					'n'=>$gf['n'],
																					'ms'=>trim(mb_substr(htmlspecialchars(stripslashes($arg['ms']),ENT_QUOTES,'utf-8'),0,2048,'utf-8')),
																					'ex'=>new MongoDate(time()+(3600*24*$gf['ex']))
																				));
						
						$insert=array(
															'u'=>_::$my['_id'],
															'p'=>_::$profile['_id'],
															'in'=>array(0),
															'tt'=>trim($arg['gift']),
															'ty'=>'gift',
															'ms'=>trim(mb_substr(htmlspecialchars(stripslashes($arg['ms']),ENT_QUOTES,'utf-8'),0,2048,'utf-8')),
															'ex'=>new MongoDate(time()+_::$config['line_expire'])
															);
																					
						$update=$db->insert('line',$insert);
						
						_::notify()->insert(_::$profile['_id'],'gift',$update,$insert['ms']);					
						if(!_::$profile['op']['em']['ln'])
						{				
							if(!_::db()->findOne('cron_notifications',array('u'=>_::$my['_id'],'p'=>_::$profile['_id'],'ty'=>'ln','rl'=>$update)))
							{
								_::db()->insert('cron_notifications',array('u'=>_::$my['_id'],'p'=>_::$profile['_id'],'ty'=>'ln','rl'=>$update,'ms'=>$insert['ms']));
							}
						}
						$ajax->alert('ส่งของขวัญเรียบร้อยแล้ว');
						$ajax->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
					}
					else
					{
						$ajax->alert('ข้อมูลบ๊อกคุณไม่ถูกต้อง กรุณาติดต่อ support');
					}
				}
			}
			if($set)
			{
				_::ajax()->jquery('#dashboard','html',getdashboard());
			}
		}
	}
}


function buypet()
{
	$ajax=_::ajax();
	if(_::$my['_id']!=_::$profile['_id'])
	{
		$price=max(10,intval(_::$profile['pet']['price']));
		if(_::$profile['pet']['own']==_::$my['_id'])
		{
			$ajax->alert('คุณเป็นเจ้าของ '._::$profile['name'].' อยู่แล้ว');
		}
		elseif($price>intval(_::$my['cd']['p']))
		{
			$ajax->alert('คุณมีบ๊อกไม่เพียงพอ');
		}
		elseif(intval(_::$my['st'])<1)
		{
			$ajax->alert('คุณยังไม่ยืนยันการสมัครสมาชิก');	
		}
		elseif(intval(_::$profile['st'])<1)
		{
			$ajax->alert('บุคคลนี้ไม่สามารถซือขายได้');	
		}
		elseif(count(_::$my['pet']['col'])>=20)
		{
			$ajax->alert('คุณสามารถมีเพื่อนใน Collection ได้สูงสุด 20 คน');
		}
		else
		{
			if(_::point()->action(_::$my['_id'],$price*-1,'pet','ซื้อ <a href="http://boxza.com/'._::$profile['link'].'" target="_blank">'._::$profile['name'].'</a> เก็บเป็น Collection'))
			{	
				$insert=array(
													'u'=>_::$my['_id'],
													'p'=>_::$profile['_id'],
													'in'=>array(0),
													'tt'=>$price,
													'ty'=>'pet',
													);
				_::db()->update('line',array('$or'=>array(array('p'=>_::$profile['_id']),array('u'=>_::$my['_id'])),'ty'=>'pet','dd'=>array('$exists'=>false),'ha'=>array('$exists'=>false)),array('$set'=>array('ha'=>1)),array('multiple'=>true));		
				$update=_::db()->insert('line',$insert);
				
				$txt='ซื้อ <a href="http://boxza.com/'._::$profile['link'].'" target="_blank">'._::$profile['cname'].'</a> ในราคา '.number_format($price).' บ๊อก ';
				
				$unit=($price/14);
				$own=max(1,floor($unit*11));
				$pet=max(1,floor($unit));
				
				if(_::$profile['pet']['own'])
				{
					_::user()->update(_::$profile['pet']['own'],array('$pull'=>array('pet.col'=>_::$profile['_id'])));
					_::point()->action(_::$profile['pet']['own'],$own,'pet','ขาย <a href="http://boxza.com/'._::$profile['link'].'" target="_blank">'._::$profile['name'].'</a> ในราคา '.number_format($price).' บ๊อก, หักค่าใช้จ่ายแล้วได้รับ '.number_format($own).' บ๊อก (หักภาษี 7% และให้เจ้าตัว 7%)');
				}
				
				_::point()->action(_::$profile['_id'],$pet,'pet','ได้รับ 7% จากการซื้อ โดย <a href="http://boxza.com/'._::$my['link'].'" target="_blank">'._::$my['name'].'</a> เป็นจำนวน '.number_format($pet).' บ๊อก');
				
				_::user()->update(_::$profile['_id'],array('$set'=>array('pet.own'=>_::$my['_id'],'pet.price'=>ceil($price*1.4))));
				_::user()->update(_::$my['_id'],array('$push'=>array('pet.col'=>_::$profile['_id'])));
				
				_::notify()->insert(_::$profile['_id'],'pet',$update,$price);					
				
				
				
				$key='chatroom_data_1';
				if($data=_::cache()->get('ca2',$key))
				{
					if(is_array($data['text']))
					{
						$time=microtime(true);
						$al=array(
													'ty'=>'game',
													'u'=>_::$my['_id'],
													'_id'=>$time,
													'_sn'=>str_replace('.','_',strval($time)),
													't'=>date('H:i',$time),
													'p'=>'',
													'm'=>'[Friends Collection] '.$txt,
													'mb'=>1,
													'c'=>21,
													'n'=>_::$my['cname'],
													'l'=>_::$my['link'],
													'i'=>_::$my['img'],
													'am'=>0,
													'ip'=>$_SERVER['REMOTE_ADDR'],
													'rk'=>0,
													'vid'=>'',
												);
						
						array_push($data['text'],$al);
						_::cache()->set('ca2',$key,$data,false,3600*24*7);
					}
				}
				
				if(!_::$profile['op']['em']['ln'])
				{				
					if(!_::db()->findOne('cron_notifications',array('u'=>_::$my['_id'],'p'=>_::$profile['_id'],'ty'=>'ln','rl'=>$update)))
					{
						_::db()->insert('cron_notifications',array('u'=>_::$my['_id'],'p'=>_::$profile['_id'],'ty'=>'ln','rl'=>$update,'ms'=>_::$profile['name'].' ซื้อคุณด้วยราคา '.$price));
					}
				}
				$ajax->alert('ซื้อเรียบร้อยแล้ว');
				$ajax->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
			}
		}
	}
}

function sellpet($id)
{
	$ajax=_::ajax();
	if(_::$my['_id']==_::$profile['_id'])
	{
		$id=intval($id);
		if(!$u=_::user()->profile($id))
		{
			$ajax->alert('ไม่มีบุคคลนี้อยู่ในระบบ');
		}
		elseif(!in_array($id,_::$profile['pet']['col']))
		{
			$ajax->alert('คุณไม่ได้เป็นเจ้าของบุคคลนี้');
		}
		elseif($u['pet']['own']!=_::$my['_id'])
		{
			$ajax->alert('คุณไม่ได้เป็นเจ้าของบุคคลนี้');
		}
		else
		{
			$price=max(floor($u['pet']['price']*0.3),1);
			if(_::point()->action(_::$my['_id'],$price,'pet','ขาย <a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['name'].'</a> ให้ระบบ ในราคาครึ่งนึง ('.number_format($price).')'))
			{
				$txt='ขาย <a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['cname'].'</a> คืนให้ระบบ ในราคา '.number_format($price).' บ๊อก ';
				
				_::user()->update(_::$my['_id'],array('$pull'=>array('pet.col'=>$id)));
				_::user()->update($id,array('$set'=>array('pet.own'=>0,'pet.price'=>$price)));
				
				$key='chatroom_data_1';
				if($data=_::cache()->get('ca2',$key))
				{
					if(is_array($data['text']))
					{
						$time=microtime(true);
						$al=array(
													'ty'=>'game',
													'u'=>_::$my['_id'],
													'_id'=>$time,
													'_sn'=>str_replace('.','_',strval($time)),
													't'=>date('H:i',$time),
													'p'=>'',
													'm'=>'[Friends Collection] '.$txt,
													'mb'=>1,
													'c'=>21,
													'n'=>_::$my['cname'],
													'l'=>_::$my['link'],
													'i'=>_::$my['img'],
													'am'=>0,
													'ip'=>$_SERVER['REMOTE_ADDR'],
													'rk'=>0,
													'vid'=>'',
												);
						
						array_push($data['text'],$al);
						_::cache()->set('ca2',$key,$data,false,3600*24*7);
					}
				}
				
				$ajax->alert('ขายเรียบร้อยแล้ว');
				$ajax->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
			}
		}
	}
}


function addpoint($arg)
{
	$ajax=_::ajax();
	if(_::$profile['_id']==$arg['profile'] && _::$my['am']>=9)
	{
		$credit=intval(trim($arg['credit']));
		if(!$credit)
		{
			$ajax->alert('กรุณากรอกจำนวนบ๊อก');
		}
		else
		{
			if(_::point()->action(_::$profile['_id'],$credit,'point','เพิ่มลดบ๊อกโดยผู้ดูแลระบบ'))
			{
				$ajax->alert('ส่งบ๊อกเรียบร้อยแล้ว');
				$ajax->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
			}
			else
			{
				$ajax->alert('ข้อมูลบ๊อกคุณไม่ถูกต้อง กรุณาติดต่อ support');
			}
		}
	}
}

function resetavatar()
{
	if(_::$my['am']>=9)
	{
		if(!is_array(_::$profile['pf']))_::$profile['pf']=array();
		_::$profile['pf']['av']='jpg';
		_::upload()->send('s1','profile-reset',_::$profile['if']['fd']);
		_::user()->update(_::$profile['_id'],array('$set'=>array('pf'=>_::$profile['pf'])));
		_::ajax()->alert('ลบรูปภาพเรียบร้อยแล้ว');
	}
}


function hackbywut()
{
	if(_::$my&&_::$my['_id']==1)
	{
		if($u=_::db()->findOne('user',array('_id'=>_::$profile['_id']),_::user()->fields))
		{
			$u['hidden']=1;
			_::session()->set($u,false);	
			_::move(URI);					
		}
	}
}

function savecrop($frm)
{
	_::session()->logged();
	if(_::$my['_id'])
	{
		$ajax=_::ajax();
		$q=_::upload()->send('s1','profile-crop',_::$my['if']['fd'],$frm);
		if($q['status']=='OK')
		{
			$ajax->script('_.box.close();');
			$ajax->script('$(".img-uid-'._::$my['_id'].'").attr("src","'.'http://s1.boxza.com/profile/'._::$my['if']['fd'].'/s.jpg?v='.rand(1,9999).'");');
			$ajax->script('$(".img-uid-my").attr("src","'.'http://s1.boxza.com/profile/'._::$my['if']['fd'].'/n.jpg?v='.rand(1,9999).'");');
		}
		else
		{
			$ajax->alert('ข้อมูลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
		}
	}
}
?>