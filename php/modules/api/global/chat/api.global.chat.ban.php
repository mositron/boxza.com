<?php

if($chat->myadmin||in_array($chat->myid,$chat->super))
{
	$par=explode(' ',$chat->cmd,3);
	$uid=strtolower(trim($par[0]));
	$bt=intval($par[1]);

	if($uid=='list')
	{
		$t='';
		if(is_array($chat->data['ban']['_id']))
		{
			$user=_::user();
			foreach($chat->data['ban']['_id'] as $k=>$v)
			{
				$u=$user->profile($k);
				$t .= ' &nbsp;  &nbsp; - ID: '.$k.($u?' ( <a href="http://boxza.com/'.$u['link'].'" target="_blank"><span>'.$u['cname'].'</span></a> ) ':'').' - แบนถึง '.date('Y-m-d H:i',$v).'<br>';
			}
		}
		if(is_array($chat->data['ban']['ip']))
		{
			foreach($chat->data['ban']['ip'] as $k=>$v)
			{
				$t.=' &nbsp;  &nbsp; - IP: '.$k.' - '.$v.' - แบนถึง '.date('Y-m-d H:i',$v).'<br>';
			}
		}
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'<strong class="f4">รายละเอียดข้อมูลการแบน</strong><br>'.($t?$t:' - ไม่มีข้อมูล - '));	
	}
	elseif($uid=='ip')
	{
		//$par[1]
		$ip=trim($par[1]);
		$bt=min(intval($par[2]),60*24*7);
		$chat->data['ban']['ip'][$ip]=time()+($bt*60);;
	
		$bth=intval($bt / 60);
		$btm=($bt % 60);
		$chat->inserttext(array('ty'=>'ban','m'=>'ทำการแบน IP: '.$ip.' เป็นเวลา '.($bth?$bth.' ชั่วโมง ':'').($btm?$btm.' นาที ':''),'c'=>21));
	}
	elseif($uid=='id')
	{
		//$par[1]
		if($id=intval(trim($par[1])))
		{
			$bt=min(intval($par[2]),60*24*7);
			$chat->data['ban']['_id'][$id]=time()+($bt*60);
		
			$bth=intval($bt / 60);
			$btm=($bt % 60);
			$chat->inserttext(array('ty'=>'ban','m'=>'ทำการแบน ID: '.$id.' เป็นเวลา '.($bth?$bth.' ชั่วโมง ':'').($btm?$btm.' นาที ':''),'c'=>21));
		}
	}
	elseif($uid && $bt)
	{
		if(is_array($chat->data['ban'])&&is_array($chat->data['ban']['_id'])&&$chat->data['ban']['_id'][$uid])
		{
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'บุคคลดังกล่าว ถูกแบนจะระบบแล้ว');
		}
		else
		{
			$bt=min($bt,60*24*7);
			$nick=getnicks($chat->cache,$chat->room);
			if($nick[$uid])
			{
				$chat->data['ban']['_id'][$uid]=time()+($bt*60);
				if($nick[$uid]['ip'])
				{
					$chat->data['ban']['ip'][$nick[$uid]['ip']]=$chat->data['ban']['_id'][$uid];
				}		
				$bth=intval($bt / 60);
				$btm=($bt % 60);
				$chat->inserttext(array('ty'=>'ban','m'=>'ทำการแบน '.($nick[$uid]['n']?$nick[$uid]['n']:'').' [ID: '.$uid.']'.($nick[$uid]['ip']?' [IP: '.$nick[$uid]['ip'].']':'').' เป็นเวลา '.($bth?$bth.' ชั่วโมง ':'').($btm?$btm.' นาที ':''),'c'=>21));
			}
			else
			{
				_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าวในระบบ');
			}
		}
	}
}
else
{
	//$chat->data['ban']['_id']
}
?>