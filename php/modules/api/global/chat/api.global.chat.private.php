<?php
$par=explode(' ',$chat->cmd,3);

$is_myroom=false;


$dispoint=false;
$color=intval($par[0]);
$uid=trim($par[1]);
$ms=mb_substr(htmlspecialchars($par[2], ENT_QUOTES,'utf-8'),0,500,'utf-8');

if(in_array($chat->room,$chat->superroom))
{
	$is_myroom=true;
	
	if(!_::$my)
	{
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'กรุณาล็อคอิน เพื่อทำการกระซิบ');
		$ms='';
	}
}

$bt=0;
$ms2=' '.str_replace(array(' ','&nbsp;','-','	'),'',$ms).' ';
/*if($chat->mybux<-1000)
{
	_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'คุณมีคะแนนน้อยเกินไป ไม่สามารถกระซิบได้');
	$ms='';
}
else*/if(preg_match('/'.$chat->adsword.'/i',$ms2,$c))
{
	if($chat->myadmin||in_array($chat->myid,$chat->super))
	{
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้');
	}
	else
	{
		if($is_myroom)
		{
			if(_::$my)
			{
				$bt=900;
				$dispoint=1000;
				$chat->mybux-=$dispoint;
				_setmybux($chat->mybux);
			}
			else
			{
				$bt=3600*3;
			}
		}
		else
		{
			if(_::$my)
			{
				_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้');
			}
			else
			{
				$bt=1800;
			}
		}
		if($bt)
		{
			$chat->data['ban']['_id'][$chat->myid]=time()+$bt;
			$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+$bt;
			
			$chat->inserttext(array(
			'u'=>-1,
			'mb'=>1,
			'n'=>'ระบบ',
			'l'=>'',
			'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
			'am'=>3,
			'rk'=>rand(1,5),
			'vid'=>'',
			'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] [IP: '.$_SERVER['REMOTE_ADDR'].'] - แบน '.floor($bt/60).' นาที'.($dispoint?', ปรับ '.number_format($dispoint).' บั๊ก':'').' ด้วยข้อหาโฆษณา (กระซิบ)','par'=>array('uid'=>$chat->myid),'c'=>21
			));
		}
	}
	$ms='';
}		
elseif(stripos($ms,'chat.boxza.com/')>-1)
{
	_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถโฆษณาภายในห้องแชทด้วยกันได้');
	$ms='';
}


if($ms && isset($chat->data['shutup'][$chat->myid]))
{
	if($chat->data['shutup'][$chat->myid]['t']<time())
	{
		unset($chat->data['shutup'][$chat->myid]);
		$chat->save=true;
	}
	else
	{
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'คุณถูกปิดการใช้งานการสนทนา');
		$ms='';
	}
}

if($ms&&$uid)
{
	$to=array('ty'=>'ms','p'=>$uid,'m'=>$ms,'c'=>$color);
	if($uid=='admin'&&($chat->myadmin||in_array($chat->myid,$chat->super)))
	{
		/*
		if($is_myroom && preg_match('/(.)\1{7,}/iu',$ms2) && !in_array($chat->myid,$chat->super))
		{
			$chat->inserttext(array(
				'u'=>-1,
				'mb'=>1,
				'n'=>'ระบบ',
				'l'=>'',
				'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
				'am'=>3,
				'rk'=>rand(1,5),
				'vid'=>'',
				'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] - ด้วยข้อหาฟลัดตัวอักษร (ผู้ดูแล)','par'=>array('uid'=>$chat->myid),'c'=>21
				));
			$ms='';
		}
		else
		{
		*/
			$to['pl']='';
			$to['pn']='';
			$chat->inserttext($to);	
		/*
		}
		*/
		
		if(in_array($chat->myid,$chat->superkick)&&$is_myroom)
		{
			$ms2=' '.str_replace(array(' ','&nbsp;','-','	','.'),'',$ms).' ';
			if(preg_match('/(.+)(ลุง|รุง|ชรา|แก่|เฒ่า)(.+)/i',$ms2))
			{
				$chat->inserttext(array(
					'u'=>-1,
					'mb'=>1,
					'n'=>'ระบบ',
					'l'=>'',
					'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
					'am'=>9,
					'rk'=>101,
					'vid'=>'',
					'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.']  - แบน 2 นาที - เนื่องจาก "ได้รับ ของขวัญ 1 ea"','par'=>array('uid'=>$chat->myid),'c'=>21
					));
				
				$chat->data['ban']['_id'][$uid]=time()+120;
				$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+120;
			}
		}
	}
	elseif($_to=getuser($chat->cache,$chat->room,$uid))
	{
		$to['pl']=$_to['pl'];
		$to['pn']=$_to['pn'];
		
		if(_::$my && isset($chat->data['bot'][$uid]))
		{
			$ctrl=$chat->data['bot'][$uid]['ctrl'];
			if($chat->myadmin||in_array($chat->myid,$chat->super))
			{
				
				if($is_myroom && preg_match('/(.)\1{7,}/iu',$ms2) && !in_array($chat->myid,$chat->super))
				{
					_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'กรุณาอย่า.. ฟลัดตัวอักษร');
					$ms='';
				}

				$tb=false;
				if(!is_array($ctrl)&&$ctrl=='all')
				{
					$tb=true;
				}
				elseif(is_array($ctrl)&&in_array($chat->myid,$ctrl))
				{
					$tb=true;
				}
				/*
				if($is_myroom && preg_match('/(.)\1{7,}/iu',$ms2) && !in_array($chat->myid,$chat->super))
				{
					$chat->inserttext(array(
						'u'=>-1,
						'mb'=>1,
						'n'=>'ระบบ',
						'l'=>'',
						'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
						'am'=>3,
						'rk'=>rand(1,5),
						'vid'=>'',
						'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] - ด้วยข้อหาฟลัดตัวอักษร (สั่งบอท)','par'=>array('uid'=>$chat->myid),'c'=>21
						));
					$ms='';
				}
				else if($tb)
				{
					*/
					unset($to['p'],$to['pl'],$to['pn']);
					$to['u']=$uid;
					$to['am']=intval($chat->data['bot'][$uid]['admin']);
					$to['mb']=1;
					$to['my']=($chat->myid==1?0:$chat->myid);
					$to['n']=$chat->data['bot'][$uid]['n'];
					$to['i']=$chat->data['bot'][$uid]['i'];
					$to['rk']=0;
					$to['vid']='';
				/*
				}
				*/
			}
		}
		if($ms)
		{
			$chat->inserttext($to);
		}
		/*
		if(in_array($chat->myid,array(67548,102194)))
		{
			$ms2=' '.str_replace(array(' ','&nbsp;','-','	'),'',$ms).' ';
			if(preg_match('/(.+)(ลุง|รุง|ล(.*)ง)(.+)/i',$ms2))
			{
				$chat->inserttext(array(
					'u'=>-1,
					'mb'=>1,
					'n'=>'ระบบ',
					'l'=>'',
					'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
					'am'=>3,
					'rk'=>rand(1,5),
					'vid'=>'',
					'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] ออกจากห้องแชทนี้ ด้วยข้อหา "เตือนแล้วก็ไม่ฟัง"','par'=>array('uid'=>$chat->myid),'c'=>21
					));
			}
		}
		*/
	}
	else
	{
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถกระซิบถึงบุคคลดังกล่าวได้');
	}
}
elseif($ms)
{
	_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถกระซิบถึงบุคคลดังกล่าวได้');
}
?>