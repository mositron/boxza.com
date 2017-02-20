<?php

$db=_::db();

$arg=array('u'=>_::$my['_id'],'_id'=>intval(_::$path[0]));

if(_::$my['_id']==1)
{
	unset($arg['u']);
}

if((!$chat=$db->findOne('chatroom',$arg)))
{
	_::move('/manage/',false);
}

define('MAX_BOT',10);
define('CHAT_LINK',!empty($chat['l'])?$chat['l']:'');

_::ajax()->register(array('savechat','resetadmin'));


$template=_::template();
$template->assign('chat',$chat);
_::$content=$template->fetch('manage.view');



function savechat($arg)
{
	$ajax=_::ajax();
	if($name=trim($arg['name']))
	{
		$db=_::db();
		$bot=array();
		for($i=0;$i<MAX_BOT;$i++)
		{
			if($bn=trim($arg['bot_'.$i.'_n']))
			{
				$ty=$arg['bot_'.$i.'_ty'];
				$bot[]=array('n'=>mb_substr($bn,0,60,'utf-8'),'ty'=>(in_array($ty,array('','chat','poem1','poem2','poem3'))?$ty:''));
			}
		}
		$bg=array(
									'al'=>array(
																'cl'=>mb_substr($arg['al_cl'],0,7,'utf-8'),
																'bg'=>mb_substr($arg['al_bg'],0,150,'utf-8'),
									),
									'pc'=>max(min(intval($arg['bg_pc']),100),0),
									'pn'=>max(min(intval($arg['bg_pn']),100),0),
									'lc'=>mb_substr($arg['lc'],0,7,'utf-8'),
									'tc'=>mb_substr($arg['tc'],0,7,'utf-8'),
									'one'=>$arg['one']?1:0,
									'snd'=>$arg['snd']?1:0,
									'col'=>$arg['col']?1:0,
		);
		$db->update('chatroom',array('_id'=>intval(_::$path[0])),array('$set'=>array(
																																																'n'=>mb_substr($name,0,50,'utf-8'),
																																																'w'=>mb_substr(trim($arg['welcome']),0,100,'utf-8'),
																																																'r'=>mb_substr(trim($arg['radio']),0,150,'utf-8'),
																																																'pl'=>($arg['published']?1:0),
																																																'bt'=>$bot,
																																																'bg'=>$bg,
																																																'mt'=>array(
																																																								'tt'=>mb_substr(trim(strval($arg['mtt'])),0,200,'utf-8'),
																																																								'dc'=>mb_substr(trim(strval($arg['mdc'])),0,200,'utf-8'),
																																																								'kw'=>mb_substr(trim(strval($arg['mkw'])),0,200,'utf-8')
																																																),
																																																'ds'=>new MongoDate(),
		
		)));
		
		
		if($chroom=$db->findone('chatroom',array('_id'=>intval(_::$path[0]))))
		{
			$key='chatroom_data_'.intval(_::$path[0]);
			
			$cache=_::cache();
			if($data=$cache->get('ca2',$key))
			{
				$data['room']=array(
																				'n'=>$chroom['n'],
																				'u'=>$chroom['u'],
																				'w'=>$chroom['w'],
																				'r'=>$chroom['r'],
																				'bg'=>$chroom['bg']
				);
				
				$data['bot']=array();
				$bit=1000001;
				for($i=0;$i<count($chroom['bt']);$i++)
				{
					$b=$chroom['bt'][$i];
					if($b['n'])
					{
						$data['bot'][$bit]=array (
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
				
				$cache->set('ca2',$key,$data,false,3600*24*7);
			}
		}
		
		
		if(!CHAT_LINK)
		{
			if($link=strtolower(trim($arg['link'])))
			{			
				$invalid = require(HANDLERS.'boxza/invalid-sub.php');
				$invalid[]='room';
				$invalid[]='chan';
				$invalid[]='channel';
				$invalid[]='rooms';
				if(preg_match('/^([a-z0-9]{1})([a-z0-9\.\-]{1,28})([a-z0-9]{1})$/',$link,$c))
				{
					if(strpos($link,'..')>-1 || strpos($link,'--')>-1 || strpos($link,'.-')>-1 || strpos($link,'-.')>-1)
					{
						$ajax->alert('ไม่สามารถใช้ . หรือ - ติดกัน สำหรับลิ้งค์ได้');
						return;
					}
					elseif(preg_match('/^([0-9]+)$/',$link))
					{
						$ajax->alert('ไม่สามารถใช้เฉพาะตัวเลข  สำหรับลิ้งค์ได้');
						return;
					}
					elseif(is_numeric($link))
					{
						$ajax->alert('ไม่สามารถใช้เฉพาะตัวเลข  สำหรับลิ้งค์ได้');
						return;
					}
					elseif(preg_match('/(.+)\.(php|js|css|htm|html|jpg|jpeg|png|gif)$/',$link))
					{
						$ajax->alert('ไม่สามารถใช้งานลิ้งค์นี้ได้');
						return;
					}
					elseif(strpos($link,'boxza')>-1 || strpos($link,'google')>-1 || strpos($link,'facebook')>-1 || strpos($link,'twitter')>-1 || strpos($link,'sanook')>-1 || strpos($link,'kapook')>-1 || strpos($link,'mthai')>-1)
					{
						$ajax->alert('ไม่สามารถใช้งานลิ้งค์นี้ได้');
						return;
					}
					elseif(in_array($link,$invalid))
					{
						$ajax->alert('ไม่สามารถใช้งานลิ้งค์นี้ได้');
						return;
					}
					elseif($db->findOne('chatroom',array('l'=>$link),array('_id'=>1)))
					{
						$ajax->alert('ลิ้งค์นี้มีผู้ใช้งานแล้ว กรุณาใช้ลิ้งค์อื่น');
						return;
					}
					else
					{
						$db->update('chatroom',array('_id'=>intval(_::$path[0])),array('$set'=>array('l'=>$link)));
						//$ajax->alert('แก้ไขลิ้งค์ห้องแชทของคุณเรียบร้อยแล้ว');
					}
				}
				else
				{
					$ajax->alert('ไม่สามารถใช้งานลิ้งค์นี้ได้');
					return;
				}
			}
		}
		_::move(URL.'?completed');
	}
}

function resetadmin()
{
	$db=_::db();
	$ajax=_::ajax();

	if($chroom=$db->findone('chatroom',array('_id'=>intval(_::$path[0]))))
	{
		$chroom['am']=array($chroom['u']=>array('lv'=>3,'ds'=>time()));
		$db->update('chatroom',array('_id'=>intval(_::$path[0])),array('$set'=>array('am'=>$chroom['am'])));
	
		$key='chatroom_data_'.intval(_::$path[0]);
		
		$cache=_::cache();
		if($data=$cache->get('ca2',$key))
		{
			$data['room']=array(
																			'n'=>$chroom['n'],
																			'u'=>$chroom['u'],
																			'w'=>$chroom['w'],
																			'r'=>$chroom['r'],
																			'bg'=>$chroom['bg']
			);
			$data['admin']=$chroom['am'];
			
			$data['bot']=array();
			$bit=1000001;
			for($i=0;$i<count($chroom['bt']);$i++)
			{
				$b=$chroom['bt'][$i];
				if($b['n'])
				{
					$data['bot'][$bit]=array (
																					'n' => $b['n'],
																					'i' => 'http://s0.boxza.com/static/chat/avatar/'.rand(1,61).'.png',
																					'l' => '',
																					'ty' => $b['ty'],
																					'ctrl' => 'all',
																					'rk'=>rand(1,28),
																				 );
					$bit++;
				}
			}
			
			$cache->set('ca2',$key,$data,false,3600*24*7);
		}
		$ajax->alert('รีเซ็ทผู้ดูแลห้องแชทนี้เรียบร้อยแล้ว');
	}
}
?>