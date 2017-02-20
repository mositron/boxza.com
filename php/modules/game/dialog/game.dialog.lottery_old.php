<?php
//_::session()->logged();

define('MATCH3_RATE',700);
define('MATCH2_RATE',70);
define('MATCH1_RATE',7);

//_::time();

_::ajax()->register('doit');



$db=_::db();

if ($lot=$db->findone('chat_lottery',array('fn'=>array('$exists'=>false))))
{
	if($lot['ex']->sec<time())
	{
		$db->update('chat_lottery',array('_id'=>$lot['_id']),array('$set'=>array('fn'=>1)));
		$id=$lot['_id'];
		$number=$lot['nb'];
		$time=$lot['ex']->sec;
		$user=_::user();
		###############################  3 ตัว #############################
		if($found=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'n3'=>$lot['n3'],'w'=>array('$exists'=>false))))
		{
			foreach($found as $v)
			{
				$mon = $v['m']*MATCH3_RATE;
				$user->update($v['u'],array('$inc'=>array('if.ch.sc'=>$mon)));
				
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval($v['u']),'log'=>'game.dialog.lottery_old.php','inc'=>$mon));
				}
				$db->update('chat_lottery_answer',array('_id'=>$v['_id']),array('$set'=>array('lg'=>'ถูกรางวัลเลข 3 ตัว ได้รับ '.$mon.' บั๊ก','w'=>3)));
			}
		}
		###############################  2 ตัว #############################
		if($found=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'n2'=>$lot['n2'],'w'=>array('$exists'=>false))))
		{
			foreach($found as $v)
			{
				$mon = $v['m']*MATCH2_RATE;
				$user->update($v['u'],array('$inc'=>array('if.ch.sc'=>$mon)));
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval($v['u']),'log'=>'game.dialog.lottery_old.php','inc'=>$mon));
				}
				$db->update('chat_lottery_answer',array('_id'=>$v['_id']),array('$set'=>array('lg'=>'ถูกรางวัลเลขท้าย 2 ตัว ได้รับ '.$mon.' บั๊ก','w'=>2)));
			}
		}
		###############################  1 ตัว #############################
		if($found=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'n1'=>$lot['n1'],'w'=>array('$exists'=>false))))
		{
			foreach($found as $v)
			{
				$mon = $v['m']*MATCH1_RATE;
				$user->update($v['u'],array('$inc'=>array('if.ch.sc'=>$mon)));
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval($v['u']),'log'=>'game.dialog.lottery_old.php','inc'=>$mon));
				}
				$db->update('chat_lottery_answer',array('_id'=>$v['_id']),array('$set'=>array('lg'=>'ถูกรางวัลเลขท้าย 1 ตัว ได้รับ '.$mon.' บั๊ก','w'=>1)));
			}
		}
		lottery_creat();
	}
}
else
{
	lottery_creat();
}

if($lastlot=$db->find('chat_lottery',array('fn'=>1),array(),array('sort'=>array('_id'=>-1),'limit'=>1)))
{
	$lastlot=$lastlot[0];
	define('LOT_ID',$lastlot['_id']);
}
$template=_::template();
$template->assign('lastlot',$lastlot);

echo $template->fetch('game.lottery');
exit;


function doit($_n,$_m)
{
	$db=_::db();
	$ajax=_::ajax();
	$_m=intval($_m);
	$_n=trim(strval($_n));
	$len=mb_strlen($_n,'utf-8');
	if(_::$my)
	{
		$fmoney=intval(_::$my['if']['ch']['sc']);
		if(!is_numeric($_m)||$_m<1) 
		{
			$ajax->alert('กรุณากรอกจำนวนบั๊กให้ถูกต้อง');
		}
		elseif($_m>$fmoney) 
		{
			$ajax->alert('คุณมีบั๊กไม่เพียงพอต่อการแทง');
		}
		elseif($_m<10) 
		{
			$ajax->alert('คุณสามารถเล่นได้ครังละอย่างน้อย 10 บั๊ก');
		}
		elseif($_m>1000) 
		{
			$ajax->alert('คุณสามารถเล่นได้ไม่เกินครังละ 1,000 บั๊ก');
		}
		elseif(!is_numeric($_n))
		{
			$ajax->alert('คุณกรอกตัวเลขในการเล่นไม่ถูกต้อง');
		}
		elseif(!in_array($len,array(1,2,3)))
		{
			$ajax->alert('กรุณากรอกตัวเองที่ต้องการเล่น 1 - 3 ตัว');
		}
		else
		{
			if($lot=$db->findone('chat_lottery',array('fn'=>array('$exists'=>false))))
			{
				_::user()->update(_::$my['_id'],array('$inc'=>array('if.ch.sc'=>$_m*-1)));
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval(_::$my['_id']),'log'=>'game.dialog.lottery_old.php - doit','inc'=>($_m*-1)));
				}
				$db->insert('chat_lottery_answer',array('u'=>_::$my['_id'],'n'=>_::$my['cname'],'l'=>$lot['_id'],'m'=>$_m,'n'.$len=>$_n));
				$ajax->jquery('#money','html',number_format($fmoney-$_m));
				$ajax->jquery('#frmbuy','html',lottery_buy());
				
				
				$key='chatroom_data_'._::$path[1];
				$cache=_::cache();
				if($data=$cache->get('ca2',$key))
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
													'm'=>'[ลอตเตอรี่] - ซื้อเลข '.$_n.' จำนวน '.$_m.' บั๊ก - งวดที่ '.$lot['_id'].' - วันที่ '.time::show($lot['ex'],'date').' - เวลา '.time::show($lot['ex'],'time'),
													'mb'=>1,
													'c'=>1,
													'n'=>_::$my['cname'],
													'l'=>_::$my['link'],
													'i'=>_::$my['img'],
													'am'=>9,
													'ip'=>$_SERVER['REMOTE_ADDR'],
													'rk'=>intval(_::$my['pet']['ty']),
													'vid'=>'',
												);
						
						array_push($data['text'],$al);
						$cache->set('ca2',$key,$data,false,3600*24*7);
					}
				}
			}
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}


function lottery_buy()
{
	if(_::$my)
	{
		$db=_::db();
		if($lot=$db->findone('chat_lottery',array('fn'=>array('$exists'=>false))))
		{
			$tmp = '<div style="text-align:center"><b>ซื้อ Lottery งวดที่ '.$lot['_id'].' - วันที่ '.time::show($lot['ex'],'date').' - เวลา '.time::show($lot['ex'],'time').'</b><br>
		<br>
		ประเภทรางวัล <select class="tbox" style="width:100px" id="ltype"><option value="3">เลข 3 ตัว</option><option value="2">เลขท้าย 2 ตัว</option><option value="1">เลขท้าย 1 ตัว</option></select>
	เลข <input id="lnumber" class="tbox" size="10" style="text-align:center; width:70px" maxlength="3"> 
	จำนวน <input id="lmoney" class="tbox" size="10" style="text-align:center; width:70px"> บั๊ก
	&nbsp; &nbsp; <input type="button" value=" ซื้อ " class="button" onClick="buylot()"></div><br>';
			$tmp.='<div style="text-align:center"><b>ล็อตเตอรี่ที่เคยชื่อ ประจำงวดนี้</b><br><table width="500" class="table tbservice"><tr><th>เลข</th><th>จำนวนเงิน</th><th>เวลา</th></tr>';
			$i=0;
			if($lots=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'u'=>_::$my['_id']),array(),array('sort'=>array('_id'=>-1))))
			{
				foreach($lots as $rs)
				{
					$tmp.="<tr><td width='100'>".($rs['n3']!=''?$rs['n3']:($rs['n2']!=''?$rs['n2']:$rs['n1']))."</td><td width='100'>".$rs['m']."</td><td>".time::show($rs['da'],'datetime')."</td></tr>";	
					$i++;
				}
			}
			if(!$i)$tmp.="<tr><td colspan='3' height='50'>ยังไม่มีการซื้อ lottery</td></tr>";	
			$tmp.="</table></div>";
			return $tmp;
		}
	}
	else
	{
		return '';
	}
}

function lottery_creat()
{
	$db=_::db();
	if(!$lot=$db->findone('chat_lottery',array('fn'=>array('$exists'=>false))))
	{
		$rand=mb_substr('000'.rand(0,999),-3,3,'utf-8');
		if(date('G')>=0&&date('G')<9)
		{
			$db->insert('chat_lottery',array('n3'=>$rand,'n2'=>mb_substr($rand,1,2,'utf-8'),'n1'=>mb_substr($rand,2,1,'utf-8'),'ex'=>new MongoDate(strtotime(date('Y').'-'.date('m').'-'.date('d').' 09:00:00'))));
		}
		elseif(date('G')>8&&date('G')<21)
		{
			$db->insert('chat_lottery',array('n3'=>$rand,'n2'=>mb_substr($rand,1,2,'utf-8'),'n1'=>mb_substr($rand,2,1,'utf-8'),'ex'=>new MongoDate(strtotime(date('Y').'-'.date('m').'-'.date('d').' 21:00:00'))));
		}
		else
		{
			$db->insert('chat_lottery',array('n3'=>$rand,'n2'=>mb_substr($rand,1,2,'utf-8'),'n1'=>mb_substr($rand,2,1,'utf-8'),'ex'=>new MongoDate(strtotime(date("Y-m-d", (time()+(3600*12))).' 09:00:00'))));
		}
	}
}

function lottery_win($number)
{
	$tmp="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='1' class='fl_table'><tr><th>งวดที่</th><th>ผู้ซื้อ</th><th>เลขที่ซื้อ</th><th>จำนวนเงิน</th><th>เวลาซื้อ</th></tr>";
	if(defined('LOT_ID')&&$win=_::db()->find('chat_lottery_answer',array('l'=>LOT_ID,'w'=>$number)))
	{
		for($i=0;$i<count($win);$i++)	
		{
			$tmp.="<tr><td>".$win[$i]['l']."</td><td>"._get_nick($win[$i]['n'])."</td><td>".($win[$i]['n3']!=''?$win[$i]['n3']:($win[$i]['n2']!=''?$win[$i]['n2']:$win[$i]['n1']))."</td><td>".$win[$i]['m']."</td><td>".time::show($win[$i]['da'],'datetime')."</td></tr>";
		}
	}
	else 
	{
		$tmp.="<tr><td colspan='5' height='50'>ยังไม่มีผู้ทายถูก</td></tr>";	
	}
	$tmp.="</table>";
	return $tmp;
}



?>