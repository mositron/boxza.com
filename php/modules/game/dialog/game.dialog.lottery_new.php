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
		$time=$lot['ex']->sec;
		$user=_::user();
		
		## BUG 140
		$db->update('chat_lottery_answer',array('l'=>$lot['_id'],'tu'=>array('$exists'=>false)),array('$set'=>array('tu'=>0,'tb'=>'BoxZa')));
		
		
		foreach($lot['tb'] as $u=>$d)
		{
			###############################  3 ตัว #############################
			$tranfer=0;
			if($d['n3']&&$d['n3']['rt'])
			{
				if($found=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'tu'=>$d['u'],'n3'=>$lot['n3'],'w'=>array('$exists'=>false))))
				{
					foreach($found as $v)
					{
						$mon = $v['m']*$d['n3']['rt'];
						$tranfer += $mon;
						$user->update($v['u'],array('$inc'=>array('if.ch.sc'=>$mon)));
						
						if(_::$config['bux_logs'])
						{
							_::db()->insert('bux_logs',array('u'=>intval($v['u']),'log'=>'game.dialog.lottery_new.php','inc'=>$mon));
						}
						
						$db->update('chat_lottery_answer',array('_id'=>$v['_id']),array('$set'=>array('lg'=>'ถูกรางวัลเลข 3 ตัว ได้รับ '.$mon.' บั๊ก','w'=>3)));
					}
				}
			}
			###############################  2 ตัว #############################
			if($d['n2']&&$d['n2']['rt'])
			{
				if($found=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'tu'=>$d['u'],'n2'=>$lot['n2'],'w'=>array('$exists'=>false))))
				{
					foreach($found as $v)
					{
						$mon = $v['m']*$d['n2']['rt'];
						$tranfer += $mon;
						$user->update($v['u'],array('$inc'=>array('if.ch.sc'=>$mon)));
						
						if(_::$config['bux_logs'])
						{
							_::db()->insert('bux_logs',array('u'=>intval($v['u']),'log'=>'game.dialog.lottery_new.php','inc'=>$mon));
						}
						$db->update('chat_lottery_answer',array('_id'=>$v['_id']),array('$set'=>array('lg'=>'ถูกรางวัลเลขท้าย 2 ตัว ได้รับ '.$mon.' บั๊ก','w'=>2)));
					}
				}
			}
			###############################  1 ตัว #############################
			if($d['n1']&&$d['n1']['rt'])
			{
				if($found=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'tu'=>$d['u'],'n1'=>$lot['n1'],'w'=>array('$exists'=>false))))
				{
					foreach($found as $v)
					{
						$mon = $v['m']*$d['n1']['rt'];
						$tranfer += $mon;
						$user->update($v['u'],array('$inc'=>array('if.ch.sc'=>$mon)));
						
						if(_::$config['bux_logs'])
						{
							_::db()->insert('bux_logs',array('u'=>intval($v['u']),'log'=>'game.dialog.lottery_new.php','inc'=>$mon));
						}
						$db->update('chat_lottery_answer',array('_id'=>$v['_id']),array('$set'=>array('lg'=>'ถูกรางวัลเลขท้าย 1 ตัว ได้รับ '.$mon.' บั๊ก','w'=>1)));
					}
				}
			}
			
			$result=($d['mn']+$d['cs'])-$tranfer;
			$db->update('chat_lottery',array('_id'=>$lot['_id']),array('$set'=>array('tb.'.$u.'.rs'=>$result)));
			if($d['u'])
			{
				$user->update($d['u'],array('$inc'=>array('if.ch.sc'=>$result)));
				
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval($d['u']),'log'=>'game.dialog.lottery_new.php','inc'=>$result));
				}
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


function doit($_n,$_m,$_t)
{
	$db=_::db();
	$ajax=_::ajax();
	$_m=intval($_m);
	$_t=intval($_t);
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
		elseif($_m<1) 
		{
			$ajax->alert('คุณสามารถเล่นได้ครังละอย่างน้อย 1 บั๊ก');
		}
		elseif(!is_numeric($_n))
		{
			$ajax->alert('คุณกรอกตัวเลขในการเล่นไม่ถูกต้อง');
		}
		elseif(!in_array($len,array(1,2,3)))
		{
			$ajax->alert('กรุณากรอกตัวเองที่ต้องการเล่น 1 - 3 ตัว');
		}
		elseif(!$lot=$db->findone('chat_lottery',array('fn'=>array('$exists'=>false))))
		{
			$ajax->alert('กรุณาเข้ามาเล่นใหม่ในภายหลัง');
		}
		elseif(!isset($lot['tb']['u'.$_t]))
		{
			$ajax->alert('กรุณาเลือกโต๊ะให้ถูกต้อง');
		}
		else
		{
			$max=intval($lot['tb']['u'.$_t]['n'.$len]['mx']);
			$cur=0;
			if($cursum=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'tu'=>$_t,'n'.$len=>$_n),array('m'=>1)))
			{
				for($i=0;$i<count($cursum);$i++)
				{
					$cur+=$cursum[$i]['m'];
				}
			}
			if($_m+$cur>$max)
			{
				$ajax->alert('ไม่สามารถซื้อได้ เนื่องจากเลขนี้ยังว่างอยู่ '.($max-$cur).' บั๊กเท่านั้น');
			}
			else
			{
				$db->update('chat_lottery',array('_id'=>$lot['_id']),array('$inc'=>array('tb.u'.$_t.'.cs'=>$_m,'tb.u'.$_t.'.n'.$len.'.cs'=>$_m)));
				_::user()->update(_::$my['_id'],array('$inc'=>array('if.ch.sc'=>$_m*-1)));
				
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval(_::$my['_id']),'log'=>'game.dialog.lottery_new.php - doit','inc'=>($_m*-1)));
				}
				
				$db->insert('chat_lottery_answer',array('u'=>_::$my['_id'],'n'=>_::$my['cname'],'tu'=>$_t,'tb'=>$lot['tb']['u'.$_t]['n'],'l'=>$lot['_id'],'m'=>$_m,'n'.$len=>$_n));
				$ajax->jquery('#money','html',number_format($fmoney-$_m));
				$ajax->jquery('#frmbuy','html',lottery_buy());
				
				$ajax->alert('ซื้อเลข '.$_n.' จำนวน '.$_m.' บั๊ก เรียบร้อยแล้ว');
				
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
													'm'=>'[ลอตเตอรี่] - ซื้อเลข '.$_n.' จำนวน '.$_m.' บั๊ก จากโต๊ะ '.$lot['tb']['u'.$_t]['n'].'- งวดที่ '.$lot['_id'].' - วันที่ '.time::show($lot['ex'],'date').' - เวลา '.time::show($lot['ex'],'time'),
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
		$tmp='';
		if($lot=$db->findone('chat_lottery',array('fn'=>array('$exists'=>false))))
		{
			$tmp .= '<div style="text-align:center"><b>ซื้อ Lottery งวดที่ '.$lot['_id'].' - วันที่ '.time::show($lot['ex'],'date').' - เวลา '.time::show($lot['ex'],'time').'</b><br>
			<table width="100%" class="table tblotto"><thead><tr><th rowspan="2">เจ้ามือ</th><th colspan="2">3 ตัว</th><th colspan="2">2 ตัว</th><th colspan="2">1 ตัว</th></tr>
			<tr><th class="nb">เปิดรับสูงสุด</th><th class="nb">ผลตอบแทน</th><th class="nb">เปิดรับสูงสุด</th><th class="nb">ผลตอบแทน</th><th class="nb">เปิดรับสูงสุด</th><th class="nb">ผลตอบแทน</th></tr>
			</thead>
			<tbody>
			';
			foreach($lot['tb'] as $u=>$v)
			{
				$tmp.='<tr><td rowspan="2">'._get_nick($v['n']).'</td><td class="nb">'.($v['n3']?number_format($v['n3']['mx']):'').'</td><td class="nb">'.($v['n3']?'1:'.$v['n3']['rt']:'').'</td><td class="nb">'.($v['n2']?number_format($v['n2']['mx']):'').'</td><td class="nb">'.($v['n2']?'1:'.$v['n2']['rt']:'').'</td><td class="nb">'.($v['n1']?number_format($v['n1']['mx']):'').'</td><td class="nb">'.($v['n1']?'1:'.$v['n1']['rt']:'').'</td></tr>';
				$tmp.='<tr><td colspan="2">'.($v['n3']?'<a href="javascript:;" onclick="_buylotto(this,3,'.$lot['_id'].','.$v['u'].')" class="btn">ซื้อเลข 3 ตัวกับเจ้ามือนี้</a>':'').'</td>
				<td colspan="2">'.($v['n2']?'<a href="javascript:;" onclick="_buylotto(this,2,'.$lot['_id'].','.$v['u'].')" class="btn">ซื้อเลข 2 ตัวกับเจ้ามือนี้</a>':'').'</td>
				<td colspan="2">'.($v['n1']?'<a href="javascript:;" onclick="_buylotto(this,1,'.$lot['_id'].','.$v['u'].')" class="btn">ซื้อเลข 1 ตัวกับเจ้ามือนี้</a>':'').'</td></tr>';
			}
			$tmp.='</tbody></table><br></div><br>';
			$tmp.='<div style="text-align:center"><b>ล็อตเตอรี่ที่เคยชื่อ ประจำงวดนี้</b><br><table width="500" class="table tbservice"><tr><th>โต๊ะ</th><th>เลข</th><th>จำนวนเงิน</th><th>เวลา</th></tr>';
			$i=0;
			if($lots=$db->find('chat_lottery_answer',array('l'=>$lot['_id'],'u'=>_::$my['_id']),array(),array('sort'=>array('_id'=>-1))))
			{
				foreach($lots as $rs)
				{
					$tmp.="<tr><td>".$rs['tb']."</td><td width='100'>".($rs['n3']!=''?$rs['n3']:($rs['n2']!=''?$rs['n2']:$rs['n1']))."</td><td width='100'>".$rs['m']."</td><td>".time::show($rs['da'],'datetime')."</td></tr>";	
					$i++;
				}
			}
			if(!$i)$tmp.="<tr><td colspan='4' height='50'>ยังไม่มีการซื้อ lottery</td></tr>";	
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
			$time=strtotime(date('Y').'-'.date('m').'-'.date('d').' 09:00:00');
		}
		elseif(date('G')>8&&date('G')<21)
		{
			$time=strtotime(date('Y').'-'.date('m').'-'.date('d').' 21:00:00');
		}
		else
		{
			$time=strtotime(date("Y-m-d", (time()+(3600*12))).' 09:00:00');
		}
		$u1=_::user()->get(1,true);
		$u2=_::user()->get(7,true);
		$db->insert('chat_lottery',array('n3'=>$rand,'n2'=>mb_substr($rand,1,2,'utf-8'),'n1'=>mb_substr($rand,2,1,'utf-8'),
																					'tb'=>array(
																													'u0'=>array(
																																					'u'=>0,
																																					'n'=>'BoxZa',
																																					'n3'=>array('rt'=>700,'mx'=>1000,'cs'=>0,'mn'=>700000),
																																					'n2'=>array('rt'=>65,'mx'=>10000,'cs'=>0,'mn'=>650000),
																																					'n1'=>array('rt'=>6,'mx'=>100000,'cs'=>0,'mn'=>600000),
																																					'cs'=>0,
																																					'mn'=>1950000
																													),
																													'u1'=>array(
																																					'u'=>$u1['_id'],
																																					'n'=>$u1['cname'],
																																					'n3'=>array('rt'=>700,'mx'=>1000,'cs'=>0,'mn'=>700000),
																																					'n2'=>array('rt'=>70,'mx'=>10000,'cs'=>0,'mn'=>700000),
																																					'n1'=>array('rt'=>7,'mx'=>100000,'cs'=>0,'mn'=>700000),
																																					'cs'=>0,
																																					'mn'=>2100000
																													),
																													'u7'=>array(
																																					'u'=>$u2['_id'],
																																					'n'=>$u2['cname'],
																																					'n3'=>array('rt'=>800,'mx'=>100,'cs'=>0,'mn'=>80000),
																																					'n2'=>array('rt'=>80,'mx'=>1000,'cs'=>0,'mn'=>80000),
																																					'n1'=>array('rt'=>8,'mx'=>10000,'cs'=>0,'mn'=>80000),
																																					'cs'=>0,
																																					'mn'=>240000
																													)
																				),
																				'ex'=>new MongoDate($time)
																)
		);
	}
}

function lottery_new($r3,$m3,$r2,$m2,$r1,$m1)
{
	$db=_::db();
	$r3=intval($r3);
	$m3=intval($m3);
	$r2=intval($r2);
	$m2=intval($m2);
	$r1=intval($r1);
	$m1=intval($m1);
	if($lot=$db->findone('chat_lottery',array('fn'=>array('$exists'=>false))))
	{
		if($lot['tb.u'._::$my['_id']])
		{
			$ajax->alert('คุณเป็นเจ้ามือในวงไพ่นี้แล้ว');
		}
		else
		{
			$mn=0;
			$new=array(
											'u'=>_::$my['_id'],
											'n'=>_::$my['cname'],
											'cs'=>0,
										);
			if($r3&&$m3)
			{
				$mn+=($r3*$m3);
				$new['n3']=array('rt'=>$r3,'mx'=>$m3,'cs'=>0,'mn'=>($r3*$m3));
			}
			if($r2&&$m2)
			{
				$mn+=($r2*$m2);
				$new['n2']=array('rt'=>$r2,'mx'=>$m2,'cs'=>0,'mn'=>($r2*$m2));
			}
			if($r1&&$m1)
			{
				$mn+=($r1*$m1);
				$new['n1']=array('rt'=>$r1,'mx'=>$m1,'cs'=>0,'mn'=>($r1*$m1));
			}
			if($mn>0)
			{
				$new['mn']=$mn;
				$db->update('chat_lottery',array('_id'=>$lot['_id']),array('$set'=>array('tb.u'._::$my['_id']=>$new)));
			}
			else
			{
				$ajax->alert('กรุณากรอกจำนวนให้ถูกต้อง');
			}
		}
	}
}

function lottery_win($number)
{
	$tmp="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='1' class='fl_table'><tr><th>โต๊ะ</th><th>ผู้ซื้อ</th><th>เลขที่ซื้อ</th><th>จำนวนเงิน</th><th>เวลาซื้อ</th><th></th></tr>";
	if(defined('LOT_ID')&&$win=_::db()->find('chat_lottery_answer',array('l'=>LOT_ID,'w'=>$number)))
	{
		for($i=0;$i<count($win);$i++)	
		{
			$tmp.='<tr><td>'._get_nick($win[$i]['tb']).'</td><td>'._get_nick($win[$i]['n']).'</td><td>'.($win[$i]['n3']!=''?$win[$i]['n3']:($win[$i]['n2']!=''?$win[$i]['n2']:$win[$i]['n1'])).'</td><td>'.$win[$i]['m'].'</td><td>'.time::show($win[$i]['da'],'datetime').'</td><td>'.$win[$i]['lg'].'</td></tr>';
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