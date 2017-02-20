<?php

if($chat->myadmin||in_array($chat->myid,$chat->super))
{
	
	$par=explode(' ',$chat->cmd,3);
	$uid=strtolower(trim($par[0]));
	$bt=intval($par[1]);

	if($uid=='list')
	{
		$t='';
		if(is_array($chat->data['shutup']))
		{
			$user=_::user();
			foreach($chat->data['shutup'] as $k=>$v)
			{
				$u=$user->profile($k);
				$t .= ' &nbsp;  &nbsp; - ID: '.$k.($u?' ( <a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['cname'].'</a> ) ':'').' - แบนถึง '.date('Y-m-d H:i',$v['t']).' โดย ID: '.$v['u'].'<br>';
			}
		}
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'<strong class="f4">รายละเอียดข้อมูลปิดการสนทนา</strong><br>'.($t?$t:' - ยังไม่มีรายละเอียด -'));	
	}
	elseif($uid && $bt)
	{
		$bt=min($bt,60*24*7);
		$nick=getnicks($chat->cache,$chat->room);
		if($nick[$uid]&&!in_array($uid,$chat->super))
		{
			$chat->data['shutup'][$uid]=array('t'=>time()+($bt*60),'u'=>$chat->myid);
			$bth=intval($bt / 60);
			$btm=($bt % 60);
			$chat->inserttext(array('ty'=>'shutup','m'=>'ทำการปิดการสนทนาของ '.($nick[$uid]['n']?$nick[$uid]['n']:'').' [ID: '.$uid.'] เป็นเวลา '.($bth?$bth.' ชั่วโมง ':'').($btm?$btm.' นาที ':''),'c'=>21));
		}
		else
		{
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าวในระบบ');
		}
	}
	elseif($uid)
	{
		$nick=getnicks($chat->cache,$chat->room);
		if($rs=$chat->data['shutup'][$uid])
		{
			if((!$rs['u'])||(!in_array($rs['u'],$chat->super))||in_array($chat->myid,$chat->super))
			{
				$u=false;
				if($_uid=intval($uid))
				{
					$u=_::user()->profile($_uid);
				}
				unset($chat->data['shutup'][$uid]);
				$chat->inserttext(array('ty'=>'shutup','m'=>'ยกเลิกปิดการสนทนาของ  '.($u?' ( <a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['cname'].'</a> ) ':'').' [ID: '.$uid.']','c'=>21));
			}
			else
			{
				_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถปลดบุคคลนี้ได้');
			}
		}
		else
		{
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าวในระบบ');
		}
	}
}
else
{
	//$chat->data['ban']['_id']
}
?>