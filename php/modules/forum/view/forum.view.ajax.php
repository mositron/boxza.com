<?php
function deltopic()
{
	_::session()->logged();
	$db=_::db();
	$ajax=_::ajax();
	if($topic=$db->findone('forum',array('_id'=>FORUM_ID,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'u'=>1,'c'=>1,'o'=>1,'fd'=>1,'s'=>1)))
	{
		if(_::$my['_id']==$topic['u'] || _::$my['am'])
		{
			if(is_array($topic['o']))
			{
				_::upload()->send('s3','delete','forum/'.$topic['fd'].'/s.jpg');
				_::upload()->send('s3','delete','forum/'.$topic['fd'].'/t.jpg');
				foreach($topic['o'] as $o)
				{
					_::upload()->send('s3','delete','forum/'.$topic['fd'].'/'.$o);
				}
			}
				
			$db->update('forum',array('_id'=>$topic['_id']),array('$set'=>array('dd'=>new MongoDate())));
			$db->update('forum_cate',array('_id'=>intval($topic['c'])),array('$inc'=>array('tp'=>-1)));
			_::user()->update($topic['u'],array('$inc'=>array('fr.tp'=>-1)));
			
			if(defined('FORUM_CACHE'))
			{
				_::cache()->delete('ca1',FORUM_CACHE.'_home',0);
				_::cache()->delete('ca1',FORUM_CACHE.'_global',0);
			}
												
			_::move(FORUM_URL.'c-'.$topic['c']);
		}
		else
		{
			$ajax->alert('คุณไม่มีสิทธิ์ลบกระทู้นี้');
		}
	}
	else
	{
		$ajax->alert('กระทู้นี้ไม่มีอยู่ หรืออาจจะถุกลบไปแล้ว');
	}
}

function delreply($cid)
{
	_::session()->logged();
	$db=_::db();
	$ajax=_::ajax();
	if(!$cid)
	{
		$ajax->alert('กระทู้ไม่ถูกต้อง');
	}
	elseif($topic=$db->findone('forum',array('_id'=>FORUM_ID,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'u'=>1,'cm.d'=>1,'cm.c'=>1)))
	{	
		$cm = false;
		for($i=0;$i<count($topic['cm']['d']);$i++)
		{
			if($topic['cm']['d'][$i]['i'] == $cid)
			{
				$cm = $topic['cm']['d'][$i];
				break;
			}
		}
		if($cm)
		{
			if($cm['u']==_::$my['_id'] || intval(_::$my['am'])>=5)
			{
				$c = max(0,count($topic['cm']['d'])-1);
				$db->update('forum',array('_id'=>$topic['_id']),array('$set'=>array('cm.c'=>$c),'$pull'=>array('cm.d'=>array('i'=>intval($cid))),'$push'=>array('cm.e'=>$cm)));			
				_::user()->update($cm['u'],array('$inc'=>array('fr.rp'=>-1)));
				_::move(URL);
			}
			else
			{
				$ajax->alert('คุณไม่มีสิทธิ์ลบข้อความนี้');
			}
		}
		else
		{
			$ajax->alert('ไม่มีข้อความดังกล่าว');
		}
	}
	else
	{
		$ajax->alert('กระทู้นี้ไม่มีอยู่ หรืออาจจะถุกลบไปแล้ว');
	}
}

function newreply($arg2)
{
	$ajax=_::ajax();
	$arg=array();
	$arg['d']=trim($arg2['detail']);
	if(!_::$my)
	{
		$ajax->alert('กรุณาล็อคอินเข้าระบบก่อนทำการโพส');
	}
	elseif(!_::$my['st'] || _::$my['st']<1)
	{
		_::move('http://boxza.com/verify');
	}
	elseif(!$arg['d'])
	{
		$ajax->alert('กรุณากรอกรายละเอียดของกระทู้');
	}
	elseif(mb_strlen($arg['d'],'utf-8')>3000)
	{
		$ajax->alert('เนื้อหาของกระทู้มีความยาวมากเกินไป (สุงสุด 3,000ตัวอักษร)');
	}
	else
	{
		$db=_::db();
		if($tmp=$db->findone('forum',array('_id'=>FORUM_ID),array('_id'=>1,'t'=>1,'lo'=>1,'c'=>1,'cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'cm.d'=>1)))
		{
			if(!$tmp['lo'])
			{
				$forum=$db->findone('forum_cate',array('_id'=>$tmp['c']));
				if($forum['am']&&!_::$my['am'])
				{
					
				}
				elseif($forum)
				{
					$arg['d'] = nl2br(htmlspecialchars($arg['d'], ENT_QUOTES,'utf-8'));
					$push=true;
					if(!is_array($tmp['cm']))
					{
						$tmp['cm']=array('c'=>0,'i'=>0,'u'=>array(),'l'=>array());
						$push = false;
					}
					$cm_u= (array)$tmp['cm']['u'];
					$cm_i = intval($tmp['cm']['i'])+1;
					$cm_c = count($tmp['cm']['d'])+1;
					if(!in_array(_::$my['_id'],$cm_u) && _::$my['_id']!=$tmp['u'] && _::$my['_id']!=$tmp['p'])
					{
						array_push($cm_u,_::$my['_id']);
					}
					if($push)
					{
						$arg2 = array('$set'=>array('cm.c'=>$cm_c,'cm.i'=>$cm_i,'cm.u'=>$cm_u),'$push'=>array('cm.d'=>array('i'=>$cm_i,'m'=>$arg['d'],'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])));
					}
					else
					{
						$arg2 = array('$set'=>array('cm'=>array('c'=>$cm_c,'i'=>$cm_i,'u'=>$cm_u,'d'=>array(array('i'=>$cm_i,'m'=>$arg['d'],'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])))));
					}
					$arg2['$set']['ds']=new MongoDate();
					$db->update('forum',array('_id'=>$tmp['_id']),$arg2);
					
					$db->update('forum_cate',array('_id'=>$tmp['c']),array('$inc'=>array('rp'=>1),'$set'=>array('ls'=>array('u'=>_::$my['_id'],'t'=>new MongoDate(),'f'=>$tmp['t'],'i'=>$tmp['_id'],'r'=>$cm_i))));
					_::user()->update(_::$my['_id'],array('$inc'=>array('fr.rp'=>1)));
					_::move(FORUM_URL.'topic/'.$tmp['_id'].'/last#'.$cm_i);
				}
			}
		}
	}
}



?>