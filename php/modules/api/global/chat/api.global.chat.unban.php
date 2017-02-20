<?php

//_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>$type.' - '.$uid);

if($chat->myadmin||in_array($chat->myid,$chat->super))
{
	$par=explode(' ',$chat->cmd,3);
	$type=trim($par[0]);
	$uid=trim($par[1]);
	if(in_array($chat->room,$chat->superroom)&&!in_array($chat->myid,$chat->super))
	{
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'<strong class="f21">ห้องนี้ถูกล็อคการปลดแบนทั้งหมดไว้</strong>');	
	}
	elseif($type=='all')
	{
		if($chat->room==1)
		{
			$chat->mysystem=1;
		}
		$chat->data['ban']['_id']=array();
		$chat->data['ban']['ip']=array();
		$chat->inserttext(array('ty'=>'unban','m'=>'เคลียร์รายการแบนทั้งหมดออกจากห้องแชท','c'=>21));
	}
	elseif($type=='id')
	{
		if(is_array($chat->data['ban']['_id']) && isset($chat->data['ban']['_id'][$uid]))
		{
			$u=false;
			if($_uid=intval($uid))
			{
				$u=_::user()->profile($_uid);
			}
			unset($chat->data['ban']['_id'][$uid]);
			if($chat->room==1)
			{
				$chat->mysystem=1;
			}
			$chat->inserttext(array('ty'=>'unban','m'=>'ปลดแบน ID: '.$uid.($u?' ( <a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['cname'].'</a> ) ':''),'c'=>21));
		}
	}
	elseif($type=='ip')
	{
		if(is_array($chat->data['ban']['ip']) && isset($chat->data['ban']['ip'][$uid]))
		{
			unset($chat->data['ban']['ip'][$uid]);		
			if($chat->room==1)
			{
				$chat->mysystem=1;
			}
			$chat->inserttext(array('ty'=>'unban','m'=>'ปลดแบน IP: '.$uid,'c'=>21));
		}
	}
}
else
{
	//$chat->data['ban']['_id']
}
?>