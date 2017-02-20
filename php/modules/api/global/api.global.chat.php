<?php

//define('EXP_RATE',5);


$room=intval(trim(_::$path[2]));
if($room==7)
{
	$room=1;
}

$mynick=array();
$foundpoem=false;
$chat = new chat($room);
if(!$chat->ban&&$chat->valid)
{
	if($chat->room<=3)
	{
		define('EXP_RATE',5);
	}
	else
	{
		define('EXP_RATE',1);
	}

	$act=_::$path[3];
	if(in_array($chat->myid,$chat->super) || (isset($chat->super2[$chat->myid])&&in_array($chat->room,(array)$chat->super2[$chat->myid])))
	{
		list($func,$cm)=explode('-',$act,2);
		if($cm)
		{	
			$act=$cm;
			 if($func=='0')
			 {
				$chat->mysystem=1;
			 }
			 elseif($func)
			 {
				$chat->isbot=intval($func);
				$nick=getnicks($chat->cache,$chat->room);
				if($_to=$nick[$chat->isbot])
				{
					$chat->syntex['u']=$chat->isbot;
					$chat->syntex['n']=$_to['n'];
					$chat->syntex['l']=$_to['l'];
					$chat->syntex['i']=$_to['i'];
					$chat->syntex['rk']=$_to['rk'];
					$chat->syntex['am']=$_to['am'];
					$chat->syntex['ip']=$_to['ip'];
				}
				else
				{
					$chat->isbot=0;
				}
			 }
			 else
			 {
				$chat->mysystem=-1;
			 }	
		}
		else
		{
			$act=$func;
		}
	}
	switch($act)
	{
		case 'list':
		case 'nick':
		case 'restore':
		case 'ban':
		case 'unban':
		case 'msg':
		case 'private':
		case 'send':
		case 'admin':
		case 'html':
		case 'shutup':
		case 'kick':
		case 'rank':
		case 'move':
		case 'clear':
		case 'talk':
		case 'world':
		case 'marquee':
		case 'spin':
			require_once(__DIR__.'/chat/api.global.chat.'.$act.'.php');
			break;
		case 'idle':
			break;
		default:
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'คำสั่งไม่ถูกต้อง กรุณาพิมพ์ /help เพื่อดูคำสั่งเบื้องต้น ('.$act.' - '.$chat->myadmin.')');
			break;
	}
	
	if(count($_ms=$chat->getms()))
	{
		_::$content[] = array('method'=>'chatbox','type'=>'chat','data'=>$_ms);
	}
	
		
	$chat->save();
}
if($chat->valid)
{
	$cook='bz_sroom_'.$chat->room;
	if(!$chat->last)
	{
		$chat->hash=rand(1,999999);
		_::$content[] = array('method'=>'chatbox','type'=>'first','data'=>array('_id'=>$chat->room,'hash'=>$chat->hash,'radio'=>$chat->data['room']['r'],'name'=>$chat->data['room']['n'],'welcome'=>$chat->data['room']['w'],'bg'=>$chat->data['room']['bg'],'rank'=>$chat->mybux));
		$_COOKIE[$cook] = $chat->hash;
		setcookie($cook,$chat->hash,time()+2592000,'/','boxza.com',false,true);
	}
	else
	{
		if($_COOKIE[$cook]&&$chat->hash)
		{
			if($_COOKIE[$cook]!=$chat->hash)
			{
				_::$content[] = array('method'=>'chatbox','type'=>'duplicate');
			}
		}
		
		if($chat->room<8)
		{
			if(in_array($chat->myid,$chat->block))
			{
				if(!$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']])
				{
					$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+(3600*2400);
					$chat->save=true;
					$chat->save();
				}
				exit;
			}
		}
	}
	_::$content[] = array('method'=>'chatbox','type'=>'info','data'=>array('ip'=>$_SERVER['REMOTE_ADDR'],'myid'=>$chat->myid,'logged'=>_::$my?1:0));
}


class chat
{
	public $data;
	public $admin;
	public $myid;
	public $syntex;
	public $config;
	public $key='';
	public $hash='';
	public $ban=false;
	public $isbot=false;
	public $valid=false;
	public $save=false;
	public $inner=false;
	public $mysystem=0;
	public $myadmin=0;
	public $mybux=0;
	public $mybox=0;
	public $myname='';
	public $myimg='';
	public $mylink='';
	public $myitem=0;
	public $flood=false;
	public $super=array(1); //
	public $super2=array(49501=>array(1,3),28710=>array(3));
	public $super_dj=array(99999=>array(1));
	public $super_love=array(163745=>array(1,2,3,4,5,6));
	public $superkick=array(); //28710
	//public $super2=array(49501=>array(3));
	public $superroom=array(1,3);
	public $block=array(28461,149595,113739); //,141826,117317
	public $badword='(ควย|ฆวย|ควัย|เย็ด|พ่อง|อีดอก|kukamusic|แม่ง|เเม่ง|เเมร่ง|เเม่ม|แม้ม|แมร่ง|แม่ม|เหี้ย|เชี่ย|เหรี้ย|เงี่ยน|มึง|สถุน|qpidradio\.com|xat\.com|เสือก|สัส|สัด|สาส|คูก้า|happy2pays|slim\-sure)';
	public $adsword='(qpidradio\.com|xat\.com|happy2pays|slim\-sure)';
	public function __construct($room)
	{
		if(empty($_SERVER['REMOTE_ADDR']))
		{
			return;
		}
		$this->room=$room;
		$this->key='chatroom_data_'.$this->room;
		
		$this->cache=_::cache();
		if(!$this->data=$this->cache->get('ca2',$this->key))
		{
			if(!$chroom=_::db()->findone('chatroom',array('_id'=>$this->room,'dd'=>array('$exists'=>false))))
			{
				_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่มีห้องดังกล่าว');
				return;
			}
			$this->data=array('text'=>array(),'wait'=>array(),'ban'=>array('_id'=>array(),'ip'=>array()),'bot'=>array(),'shutup'=>array(),'last'=>time());
			
			$this->data['room']=array(
																			'n'=>$chroom['n'],
																			'u'=>$chroom['u'],
																			'w'=>$chroom['w'],
																			'r'=>$chroom['r'],
																			'bg'=>$chroom['bg']
			);
			
			if(is_array($chroom['bt'])&&count($chroom['bt']))
			{
				$bit=1000001;
				for($i=0;$i<count($chroom['bt']);$i++)
				{
					$b=$chroom['bt'][$i];
					if($b['n'])
					{
						$this->data['bot'][$bit]=array (
																						'n' => $b['n'],
																						'i' => 'http://s0.boxza.com/static/chat/avatar/'.rand(1,61).'.png',
																						'l' => '',
																						'ty' => $b['ty'],
																						'ctrl' => 'all',
																						'rk'=>0,
																					 );
						$bit++;
					}
				}
			}
			
			if($chroom['ban'])
			{
				if(is_array($chroom['ban']['_id'])&&count($chroom['ban']['_id']))
				{
					$this->data['ban']['_id']=$chroom['ban']['_id'];
				}
				if(is_array($chroom['ban']['ip'])&&count($chroom['ban']['ip']))
				{
					$this->data['ban']['ip']=$chroom['ban']['ip'];
				}
			}
			$this->data['admin']=$chroom['am'];
			$this->save=true;
		}
		
		$this->valid=true;
		$this->last=floatval($_GET['last']);
		$this->vid=(_::$my?strval($_GET['vid']):'');
		$this->cmd=trim($_GET['cmd']);
		$this->hash=trim($_GET['hash']);
		$this->time=microtime(true);
		$this->time2=time();
		if(_::$my)
		{
			$this->myid=_::$my['_id'];
			
			if($this->room<8)
			{
				if(in_array($this->myid,$this->block))
				{
					if(!$this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']])
					{
						$this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+(3600*24000);
						$this->save=true;
						$this->save();
					}
					exit;
				}
			}
			
			$g=date('G');
			if($g>=9&&strval($_GET['ver'])&&intval(_::$my['st'])>0)
			{
				$this->inner=true;
			}
			
			$this->myadmin=(isset($this->data['admin'][$this->myid])?$this->data['admin'][$this->myid]['lv']:0);
			if(in_array($this->myid,$this->super))
			{
				$this->myadmin=9;
			}
			elseif(isset($this->super2[$this->myid]))
			{
				if(in_array($this->room,$this->super2[$this->myid]))
				{
					$this->myadmin=8;
				}
			}
			elseif(isset($this->super_love[$this->myid]))
			{
				if(in_array($this->room,$this->super_love[$this->myid]))
				{
					$this->myadmin=7;
				}
			}
			elseif(isset($this->super_dj[$this->myid]))
			{
				if(in_array($this->room,$this->super_dj[$this->myid]))
				{
					$this->myadmin=6;
				}
			}
			
			$this->myname=str_replace(array(''),array(' '),_::$my['cname']);
			$this->myimg=_::$my['img'];
			$this->mybux=intval(_::$my['if']['ch']['sc']);
			$this->mybox=intval(_::$my['cd']['p']);
			$this->mylink=_::$my['link'];
			$this->myitem=intval(_::$my['if']['ch']['ci']);
		}
		/*elseif(in_array($this->room,$this->superroom))
		{
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'กรุณาล็อคอินก่อนใช้งานห้องนี้');
			_::$content[] = array('method'=>'chatbox','type'=>'banned');
			$this->ban=true;
			return;
		}
		*/
		/*
		elseif($_COOKIE['bz_ses']&&mb_substr($_COOKIE['bz_ses'],0,2,'utf-8')=='bz')
		{
			$this->myid=$_COOKIE['bz_ses'];
		}*/
		else //if(_::$ses)
		{
			$this->myid=_::$ses;
		}/*
		else
		{
			//$this->myid = 'bz'.time().rand(10000,99999);
			$this->myid = 'bz'.date('YmdHis').rand(10000,99999);
			$_COOKIE['bz_ses'] = $this->myid;
			setcookie('bz_ses',$this->myid,time()+31104000,'/','boxza.com',false,true);
			$this->flood=true;
		}
		*/
		if(!_::$my)
		{
			$setcookie=false;
			if((!$_COOKIE['bz_name'])||($_COOKIE['bz_name']=='null'))
			{
				$this->myname=$this->randnick();
				$setcookie=true;
			}
			else
			{
				$this->myname=$_COOKIE['bz_name'];
			}
			if((!$_COOKIE['bz_img'])||($_COOKIE['bz_img']=='null'))
			{
				$this->myimg='http://s0.boxza.com/static/chat/avatar/'.rand(1,61).'.png';
				$setcookie=true;
			}
			else
			{
				$this->myimg=$_COOKIE['bz_img'];
			}
			if($setcookie)
			{
				setcookie('bz_name',$this->myname,time()+86400,'/','boxza.com',false,true);
				setcookie('bz_img',$this->myimg,time()+86400,'/','boxza.com',false,true);
			}
		}
		
		$this->syntex0=array(
														'ty'=>'ms',
														'u'=>-1,
														'_id'=>$this->time,
														'_sn'=>str_replace('.','_',strval($this->time)),
														't'=>date('H:i',$this->time),
														'p'=>'',
														'm'=>'',
														'mb'=>1,
														'c'=>1,
														'n'=>'ระบบ',
														'l'=>'',
														'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
														'am'=>3,
														'rk'=>rand(1,5),
														'inn'=>0,
											);
		$this->syntex=array(
														'ty'=>'ms',
														'u'=>$this->myid,
														'_id'=>$this->time,
														'_sn'=>str_replace('.','_',strval($this->time)),
														't'=>date('H:i',$this->time),
														'p'=>'',
														'm'=>'',
														'mb'=>(_::$my?1:0),
														'c'=>1,
														'n'=>$this->myname,
														'l'=>$this->mylink,
														'i'=>$this->myimg,
														'rk'=>$this->myitem,
														'am'=>$this->myadmin,
														'ip'=>$_SERVER['REMOTE_ADDR'],
														'vid'=>$this->vid,
														'inn'=>($this->inner?1:0),
											);
		if(in_array($this->myid,$this->super))
		{
			
		}
		elseif(!$this->myadmin)
		{
			if($this->myid&&isset($this->data['ban']['_id'][$this->myid]))
			{
				if(intval($this->data['ban']['_id'][$this->myid])<$this->time2)
				{
					unset($this->data['ban']['_id'][$this->myid]);
					$this->save=true;
				}
				else
				{
					_::$content[] = array('method'=>'chatbox','type'=>'banned');
					$this->ban=true;
				}
			}
			if($this->mybux < -1000000)
			{
				_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'คุณถูกแบนจากแชท เนื่องจากมีคะแนนน้อยเกินไป');
				_::$content[] = array('method'=>'chatbox','type'=>'banned');
				$this->ban=true;
			}

			if($_SERVER['REMOTE_ADDR']&&isset($this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]))
			{
				if(intval($this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']])<$this->time2)
				{
					unset($this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]);
					$this->save=true;
				}
				elseif(!$this->ban)
				{
					_::$content[] = array('method'=>'chatbox','type'=>'banned');
					$this->ban=true;
				}
			}
		}
	}
	public function getms()
	{
		$_ms=array();
		$super=in_array($this->myid,$this->super);
		for($i=0;$i<count($this->data['text']);$i++)
		{
			if($this->data['text'][$i]['_id']>$this->last)
			{
				$m=$this->data['text'][$i];
				if(!_::$my || !_::$my['am'])
				{
					$m['ip']='- hidden -';
				}
				if(!$this->data['text'][$i]['p'])
				{
					$_ms[]=$m;
				}
				elseif($this->data['text'][$i]['p']==$this->myid || $this->data['text'][$i]['u']==$this->myid || ($this->data['text'][$i]['p']=='admin'&&$this->myadmin) || $super)
				{
					$_ms[]=$m;
				}
			}
		}
		return $_ms;
	}
	
	public function inserttext($arg)
	{
		if($this->flood)
		{
			
		}
		elseif($this->mysystem==1)
		{
			array_push($this->data['text'],array_merge($this->syntex0,$arg));
			$this->time=microtime(true);
			$this->syntex0['_id']=$this->time;
			$this->syntex0['_sn']=str_replace('.','_',strval($this->time));
			$this->syntex0['t']=date('H:i',$this->time);
		}
		elseif($this->mysystem==0)
		{
			array_push($this->data['text'],array_merge($this->syntex,$arg));
			$this->time=microtime(true);
			$this->syntex['_id']=$this->time;
			$this->syntex['_sn']=str_replace('.','_',strval($this->time));
			$this->syntex['t']=date('H:i',$this->time);
		}
		else
		{
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>$arg['m']);
		}
		$this->save=true;
	}
	
	public function save()
	{
		if($this->save)
		{
			if(count($this->data['text'])>30)
			{
				$this->data['text']=array_slice($this->data['text'],10);
			}
			$this->cache->set('ca2',$this->key,$this->data,false,3600*24*7);
		}
	}
	
	public function randnick()
	{
		require_once(__DIR__.'/chat/api.global.chat.func.randnick.php');
		return func_randnick().' '.func_randnick();
	}
	
	public	function saveadmin()
	{
		if(is_array($this->data['admin']))
		{
			_::db()->update('chatroom',array('_id'=>$this->room),array('$set'=>array('am'=>$this->data['admin'])));
			$this->save=true;
		}
	}
	
	public function nick($n)
	{
		return '<span>'.preg_replace('/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/i','</span><span class="f$1 s$3 b$5">',$n).'</span>';	
	}
}

function getuser($cache,$room,$uid)
{
	$nick=getnicks($cache,$room);
	if($nick[$uid])
	{
		return array('pl'=>'','pn'=>$nick[$uid]['n']);
	}
	elseif(is_numeric($uid) && $uid>0)
	{
		$u=_::user()->profile(intval($uid));
		return array('pl'=>$u['link'],'pn'=>$u['name']);
	}
	else
	{
		return false;
	}
}

function getnicks($cache,$room)
{
	$nick=$cache->get('ca2','chatbox_user_'.$room);
	if(!is_array($nick))$nick=array();
	return $nick;
}

function _setmybux($rank)
{
	if(_::$my)
	{
		if(_::$config['bux_logs'])
		{
			_::db()->insert('bux_logs',array('u'=>_::$my['_id'],'log'=>'_setmybux','from'=>intval(_::$my['if']['ch']['sc']),'to'=>intval($rank)));
		}
		_::user()->update(_::$my['_id'],array('$set'=>array('if.ch.sc'=>intval($rank))));
	}
}
?>