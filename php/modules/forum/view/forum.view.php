<?php

$_pp=(defined('FORUM_PERPAGE')?FORUM_PERPAGE:20);
$db=_::db();
$_page=_::$path[defined('FORUM_IN')?2:1];
if($_page=='last')
{
	$page='last';
	$start=array(-$_pp,$_pp);
}
else
{
	$page=(substr($_page,0,5)=='page-')?substr($_page,5):1;
	$start=array(((max(1,$page)-1)*$_pp),$_pp);
}
$sarg=array('_id'=>1,'t'=>1,'c'=>1,'d'=>1,'da'=>1,'fd'=>1,'f'=>1,'o'=>1,'ip'=>1,'s'=>1,'dd'=>1,'e'=>1,'u'=>1,'ic'=>1,'lk'=>1,'tags'=>1,'do'=>1,'cm.c'=>1,'ads'=>1,'cm.d'=>array('$slice'=>$start));
if($option && isset($option['view']) && is_array($option['view']['select']))
{
	$sarg=array_merge($sarg,$option['view']['select']);
}
if($topic = $db->findone('forum',array('_id'=>FORUM_ID),$sarg))
{
	if($topic['dd'])
	{
		_::move(FORUM_URL.'c-'.$topic['c']);
	}
	$_c=$cate[$topic['c']];
	if($_c['s']=='car')
	{
		if(_::$type!='www')
		{
			_::move('http://www.autocar.in.th/forum/topic/'.$topic['_id'],true);
		}
	}
	elseif($_c['s']=='football')
	{
		if(_::$type!='www')
		{
			//_::move('http://www.teededball.com/forum/topic/'.$topic['_id'],true);
		}
	}
	elseif($_c['s'] && _::$type!=$_c['s'])
	{
		_::move('http://'.$_c['s'].'.boxza.com/forum/topic/'.$topic['_id'],true);
	}
	elseif(defined('FORUM_IN')&&!$_c['s'])
	{
		_::move('http://forum.boxza.com/topic/'.$topic['_id'],true);	
	}
	elseif(!defined('FORUM_IN') && !$_c)
	{
		if($_cate=$db->findone('forum_cate',array('_id'=>$topic['c']),array('s'=>1)))
		{
			_::move('http://'.$_cate['s'].'.boxza.com/forum/topic/'.$topic['_id'],true);
		}
	}
	if($page=='last')
	{
		$page=max(ceil($topic['cm']['c'] /$_pp),1);
	}
	_::ajax()->register(array('deltopic','delreply','newreply','loveit','thank','showads'));
	//_::time();
	
	
	_::$meta['title'] = $topic['t'].' - '.$cate[$topic['c']]['t'].' - '._::$meta['title'];
	_::$meta['description'] = $topic['t'].' - '.$cate[$topic['c']]['t'].' - '._::$meta['description'];
	_::$meta['type']='article';
	if($topic['s'])
	{
		_::$meta['image']='http://s3.boxza.com/forum/'.$topic['fd'].'/'.$topic['s'];
	}
	
	if($relate=$db->find('forum',array('c'=>$topic['c'],'_id'=>array('$ne'=>FORUM_ID),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'u'=>1,'s'=>1,'do'=>1,'f'=>1,'c'=>1,'fd'=>1,'lk.c'=>1,'s'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>1),'limit'=>30)))
	{
		shuffle($relate);
		$relate=array_slice($relate,0,12);
	}
	
	$user=_::user();
	$poster=$user->profile($topic['u']);
	if($poster['google'])
	{
		_::$meta['google']=$poster['google'];
	}
	
	
	$db->update('forum',array('_id'=>$topic['_id']),array('$inc'=>array('do'=>1)));
	$db->update('forum_cate',array('_id'=>$topic['c']),array('$inc'=>array('do'=>1)));
	
	$template->assign('page',$page);
	$template->assign('topic',$topic);
	$template->assign('relate',$relate);
	$template->assign('u',$poster);
	$template->assign('user',$user);
	
	list($pg,$lt)=_::pager()->bootstrap($_pp,$topic['cm']['c'] ,array(FORUM_URL.'topic/'.$topic['_id'],'/page-'),$page);
	$template->assign('pager',$pg);
	_::$content=$template->fetch2(FORUM_TPL.'view');
}
else
{
	_::move(FORUM_URL);
}





function deltopic()
{
	_::session()->logged();
	$db=_::db();
	$ajax=_::ajax();
	if($topic=$db->findone('forum',array('_id'=>FORUM_ID,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'u'=>1,'c'=>1,'o'=>1,'fd'=>1,'s'=>1)))
	{
		if(_::$my['_id']==$topic['u'] || intval(_::$my['am'])>=6)
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
			
			$_rc=intval($topic['c']);
			$_ca=$db->findone('forum_cate',array('_id'=>$_rc),array('_id'=>1,'p'=>1));
			while($_rc && $_ca)
			{
				$db->update('forum_cate',array('_id'=>$_rc),array('$inc'=>array('tp'=>-1)));
				$_ca=$db->findone('forum_cate',array('_id'=>$_rc),array('_id'=>1,'p'=>1));
				if($_ca['p'])
				{
					$_rc=$_ca['p'];
				}
				else
				{
					$_rc=0;
				}
			}
			
			//$db->update('forum_cate',array('_id'=>intval($topic['c'])),array('$inc'=>array('tp'=>-1)));
			_::user()->update($topic['u'],array('$inc'=>array('fr.tp'=>-1)));
			
			_::tags()->remove('forum', $topic['_id']);
			
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
	elseif($topic=$db->findone('forum',array('_id'=>FORUM_ID,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'u'=>1,'c'=>1,'cm.d'=>1,'cm.c'=>1)))
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
			if($cm['u']==_::$my['_id'] || intval(_::$my['am'])>=6)
			{
				$c = max(0,count($topic['cm']['d'])-1);
				$db->update('forum',array('_id'=>$topic['_id']),array('$set'=>array('cm.c'=>$c),'$pull'=>array('cm.d'=>array('i'=>intval($cid))),'$push'=>array('cm.e'=>$cm)));
				
				
				$_rc=intval($topic['c']);
				$_ca=$db->findone('forum_cate',array('_id'=>$_rc),array('_id'=>1,'p'=>1));
				while($_rc && $_ca)
				{
					$db->update('forum_cate',array('_id'=>$_rc),array('$inc'=>array('rp'=>-1)));
					$_ca=$db->findone('forum_cate',array('_id'=>$_rc),array('_id'=>1,'p'=>1));
					if($_ca['p'])
					{
						$_rc=$_ca['p'];
					}
					else
					{
						$_rc=0;
					}
				}
				
				
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


function checkout_nofollow($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(boxza|boxzacar|boxzaracing|doodroid|google|teededball|boxzafootball|autocar)\.(.*)$/',$arg[1]))
	{
		return 	'<a href="'.$arg[1].'" target="_blank">';
	}
	else
	{
		return 	'<a href="http://out.boxza.com/#'.base64_encode($arg[1]).'" target="_blank">';
	}
}


function checkout_iframe($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(youtube)\.com(.*)$/',$arg[2]))
	{
		return 	'<iframe'.$arg[1].'src="'.$arg[2].'"'.$arg[3].'>';
	}
	else
	{
		return 	'<iframe width="0" height="0">';
	}
}

function newreply($arg2)
{
	$ajax=_::ajax();
	$arg=array();
	$arg['d']=trim($arg2['detail']);
	$arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['d']);
	$arg['d']=preg_replace_callback('/\<iframe([^\>]+)src\="([^"]+)"([^\>]+)?"\>/i','checkout_iframe',$arg['d']);
	
	$badword = '('.implode('|',require(HANDLERS.'boxza/badword.php')).')';
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
	elseif(preg_match('/'.$badword.'/i',$arg['d'],$bw))
	{
		$ajax->alert('ไม่สามารถใช้คำว่า "'.$bw[1].'" ในรายละเอียดกระทู้ได้');
	}
	elseif(mb_strlen($arg['d'],'utf-8')>5000)
	{
		$ajax->alert('เนื้อหาของกระทู้มีความยาวมากเกินไป (สุงสุด 5,000ตัวอักษร)');
	}
	elseif(preg_match('/\[([url|img|b|color]+)([^\]]*)\]/i',$arg['d']))
	{
		$error['detail']='ไม่สามารถใช้งาน BBCode ได้';
	}
	elseif(preg_match('/\<(script|style)([^\>]*)\>/i',$arg['d']))
	{
		$error['detail']='ไม่สามารถใช้งาน &lt;script&gt;, &lt;style&gt;, ได้';
	}
	else
	{
		_::session()->logged();
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
					//$arg['d'] = htmlspecialchars($arg['d'], ENT_QUOTES,'utf-8');
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
					
					$_rc=intval($tmp['c']);
					$_ca=$db->findone('forum_cate',array('_id'=>$_rc),array('_id'=>1,'p'=>1));
					while($_rc && $_ca)
					{
						$db->update('forum_cate',array('_id'=>$_rc),array('$inc'=>array('rp'=>1),'$set'=>array('ls'=>array('u'=>_::$my['_id'],'t'=>new MongoDate(),'f'=>$tmp['t'],'i'=>$tmp['_id'],'r'=>$cm_i))));
						$_ca=$db->findone('forum_cate',array('_id'=>$_rc),array('_id'=>1,'p'=>1));
						if($_ca['p'])
						{
							$_rc=$_ca['p'];
						}
						else
						{
							$_rc=0;
						}
					}
					
					//$db->update('forum_cate',array('_id'=>$tmp['c']),array('$inc'=>array('rp'=>1),'$set'=>array('ls'=>array('u'=>_::$my['_id'],'t'=>new MongoDate(),'f'=>$tmp['t'],'i'=>$tmp['_id'],'r'=>$cm_i))));
					_::user()->update(_::$my['_id'],array('$inc'=>array('fr.rp'=>1)));
					
					_::move(FORUM_URL.'topic/'.$tmp['_id'].'/last');
				}
			}
		}
	}
}


function loveit()
{
	_::session()->logged();
	$db=_::db();
	$ajax=_::ajax();
	$user=_::user();
	
	if(_::$my)
	{
		if(_::$my['st']<1)
		{
			$ajax->alert('กรุณายืนยันการสมัครสมาชิกก่อน ใช้งานในส่วนนี้');
		}
		else
		{
			if($tmp=$db->findone('forum',array('_id'=>FORUM_ID,'dd'=>array('$exists'=>false)),array('_id'=>1,'lk'=>1,'c'=>1,'u'=>1)))
			{	
				if($u=$user->profile($tmp['u']))
				{
					if($u['st']<1)
					{
						$ajax->alert('เจ้าของกระทู้นี้ยังไม่ได้ทำการยืนยันการสมัครสมาชิก');
					}
					else
					{
						$push = true;
						if(!is_array($tmp['lk']))
						{
							$tmp['lk']=array('c'=>0,'u'=>array());
							$push = false;
						}		
						$cm_u= (array)$tmp['lk']['u'];
						$cm_c = intval($tmp['lk']['c']);
						if($tmp['u']==_::$my['_id'])
						{
							$ajax->alert('คุณไม่สามารถโหวตกระทู้ของตัวเองได้');
						}
						elseif(!in_array(_::$my['_id'],(array)$tmp['lk']['u']))
						{
							$cm_c++;
							array_push($cm_u,_::$my['_id']);
							if($push)
							{
								$arg = array('$set'=>array('lk.c'=>$cm_c),'$push'=>array('lk.u'=>_::$my['_id']));
							}
							else
							{
								$arg = array('$set'=>array('lk'=>array('c'=>$cm_c,'u'=>array(_::$my['_id']))));
							}
							$db->update('forum',array('_id'=>FORUM_ID),$arg);
							$db->update('forum_cate',array('_id'=>$tmp['c']),array('$inc'=>array('lk'=>1)));
							_::point()->action($tmp['u'],1,'loveit','รับ 1 บ๊อกจาก LOVE IT โดย <a href="http://boxza.com/'._::$my['link'].'" target="_blank">'._::$my['name'].'</a> ที่ <a href="http://forum.boxza.com/topic/'.FORUM_ID.'" target="_blank">กระทู้นี้</a>');
									
							$ajax->jquery('.love-'.FORUM_ID,'html',$cm_c);
							$ajax->alert('ทำการโหวตเรียบร้อยแล้ว');
						}
						else
						{
							$ajax->alert('คุณเคยทำการโหวตกระทู้นี้แล้ว');
						}
					}
				}
			}
		}
	}
}

function showads($ok)
{
	$db=_::db();
	$ajax=_::ajax();
	if(_::$my['am'])
	{
		$db->update('forum',array('_id'=>FORUM_ID),array('$set'=>array('ads'=>($ok?1:0))));	
		_::move(URL);
	}
}
function thank($uid)
{
	_::session()->logged();
	$uid=intval($uid);
	$db=_::db();
	$ajax=_::ajax();
	$user=_::user();
	if(_::$my)
	{
		if(_::$my['st']<1)
		{
			$ajax->alert('กรุณายืนยันการสมัครสมาชิกก่อน ใช้งานในส่วนนี้');
		}
		elseif(_::$my['_id']==$uid)
		{
			$ajax->alert('ไม่สามารถขอบคุณตัวเองได้');
		}
		else
		{
			$dt = date('Y-m-d');
			if($db->findone('user_thank',array('u'=>_::$my['_id'],'p'=>$uid,'dk'=>$dt)))
			{
				$ajax->alert('คุณทำการขอบคุณสมาชิกท่านนี้แล้ว สามารถขอบคุณได้อีกครั้งในวันถัดไป');
			}
			elseif($u=$user->profile($uid))
			{
				if($u['st']<1)
				{
					$ajax->alert('สมาชิกท่านนี้ยังไม่ได้ทำการยืนยันการสมัครสมาชิก');
				}
				else
				{
					$user->update($uid,array('$inc'=>array('fr.tk'=>1)));
					$db->insert('user_thank',array('u'=>_::$my['_id'],'p'=>$uid,'dk'=>$dt));
					$ajax->jquery('.thank-'.$uid,'html',intval($u['fr']['tk'])+1);
					$ajax->alert('ขอบคุณเรียบร้อยแล้ว');
					_::point()->action($uid,1,'thank','รับ 1 บ๊อกจากการขอบคุณโดย <a href="http://boxza.com/'._::$my['link'].'" target="_blank">'._::$my['name'].'</a> ที่ <a href="http://forum.boxza.com/topic/'.FORUM_ID.'" target="_blank">กระทู้นี้</a>');
				}
			}
			else
			{
				$ajax->alert('ไม่มีสมาชิกนี้อยู่ในระบบ');
			}
		}
	}
}


class rpg_exp
{
	public static $uid=array();
}

function rpg_exp_bar($pet)
{
	if(isset(rpg_exp::$uid[$pet['_id']]))
	{
		return rpg_exp::$uid[$pet['_id']];
	}
	else
	{
		$width=180;
		$pet['mhp']=max(1,$pet['hp'],$pet['mhp']);
		$pet['mmp']=max(1,$pet['mp'],$pet['mmp']);
		$pet['mxp']=max(1,$pet['xp'],$pet['mxp']);
		$arr=array('hp'=>array('HP','green'),'mp'=>array('MP','grey'),'xp'=>array('EXP','orange'));
		$return='<div class="sdc_rpgbar">';
		foreach($arr as $k=>$v)
		{
			$per=floor(($pet[$k]/$pet['m'.$k])*100);
			$return.='<table cellspacing="0" cellpadding="0" border="0">
	  <tr>
			  <td align="left"><span class="postdetails">'.$v[0].':</span> <b>'.$pet[$k].' / '.$pet['m'.$k].'</b> ('.$per.'%)</td>
	  </tr>
	  <tr>
			  <td>
					  <table cellspacing="0" cellpadding="0" border="0">
					  <tr>
					  <td><img src="http://s0.boxza.com/static/images/forum/exp/'.$v[1].'_left.gif" style="width:5px; height:11px;" /></td>
					  <td><img src="http://s0.boxza.com/static/images/forum/exp/'.$v[1].'.gif" style="width:'.($w=floor(($per/100)*$width)).'px; height:11px;" /></td>
					  <td><img src="http://s0.boxza.com/static/images/forum/exp/'.$v[1].'_fil.gif" style="width:5px; height:11px;" /></td>
					  <td><img src="http://s0.boxza.com/static/images/forum/exp/'.$v[1].'_faded.gif" style="width:'.($width - $w).'px; height:11px;" /></td>
					  <td><img src="http://s0.boxza.com/static/images/forum/exp/'.$v[1].'_faded_right.gif" style="width:1px; height:11px;" /></td>
					  </tr>
					  </table>
			  </td>
	  </tr>
	  </table>';
		}
		$return.='</div>';
		return rpg_exp::$uid[$u]=$return;	
	}
}

?>