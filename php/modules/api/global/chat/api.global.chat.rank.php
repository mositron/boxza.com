<?php


$par=explode(' ',$chat->cmd,3);
$uid=strtolower(trim($par[0]));
$bt=intval($par[1]);


if(_::$my && in_array(_::$my['_id'],array(1)) && $uid && is_numeric($uid))
{
	if($bt)
	{
		//if($chat->myadmin>=9)
		if(_::$my['_id']==1)
		{
			if($u=_::user()->get(intval($uid),true))
			{	
				$mybux = intval($u['if']['ch']['sc'])+$bt;
				_::user()->update(intval($uid),array('$set'=>array('if.ch.sc'=>$mybux)));
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval($u['_id']),'log'=>'api.global.chat.rank.php','from'=>intval($u['if']['ch']['sc']),'to'=>intval($mybux)));
				}
				$nick=getnicks($chat->cache,$chat->room);
				$ms='<strong>'.($bt>0?'เพิ่ม':'ลด').'</strong>คะแนนของ <span>'.($nick[$uid]['n']?$nick[$uid]['n']:$u['cname']).'</span> [ID: '.$uid.']'.' จำนวน '.number_format(abs($bt)).' เป็น '.number_format($mybux).' คะแนน '.($par[2]?' เนื่องจาก "'.trim($par[2]).'"':'');
				$chat->inserttext(array('ty'=>'rank','m'=>$ms,'c'=>21));
			}
			else
			{
				_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าว');
			}
		}
		else
		{
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'คุณไม่มีสิทธิ์ใช้งานส่วนนี้');
		}
	}
	else
	{

		if($u=_::user()->get(intval($uid),true))
		{
			$chat->mysystem=-1;
			$mybux = intval($u['if']['ch']['sc'])+$bt;
			$ms='คะแนนของ '.$chat->nick($u['cname']).' [ID: '.$uid.']'.' มี '.number_format($mybux).' คะแนน';
			$chat->inserttext(array('ty'=>'rank','m'=>$ms,'c'=>21));
		}
		else
		{
			_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าว');
		}
	}
}
else
{
	$data=array();
	_::$content[] = array('method'=>'chatbox','type'=>'rank','data'=>array('val'=>number_format($chat->mybux),'data'=>$data));
}

?>
