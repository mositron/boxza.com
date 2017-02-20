<?php

//_::session()->logged();

define('BANK_RATE',50);


$template=_::template();
$template->assign('item',require_once(__DIR__.'/game.dialog.item.config.php'));

_::ajax()->register(array('buyit','useit','sellit'));


echo $template->fetch2('game.dialog.item');
exit;

function buyit($_i)
{
	$db=_::db();
	$user=_::user();
	$ajax=_::ajax();
	
	$template=_::template();
	$_i=intval($_i);
	if(!is_array(_::$my['if']['ch']))
	{
		_::$my['if']['ch']=array('inv'=>array());
	}
	if(!is_array(_::$my['if']['ch']['inv']))
	{
		_::$my['if']['ch']['inv']=array();
	}
	if(_::$my)
	{
		$item=$template->item[$_i];
		$money=intval(_::$my['if']['ch']['sc']);
		if(!is_array($item))
		{
			$ajax->alert('ไม่มีไอเท็มที่คุณต้องการ');
		}
		elseif($item['p']<100) 
		{
			$ajax->alert('ไอเท็มนี้ไม่สามารถซื้อได้');
		}
		elseif($item['p']>$money) 
		{
			$ajax->alert('คุณมีบั๊กไม่เพียงพอ');
		}
		elseif(in_array($_i,_::$my['if']['ch']['inv']))
		{
			$ajax->alert('คุณมีไอเท็มชิ้นนี้อยู่แล้ว');
		}
		else
		{
			if(_::$config['bux_logs'])
			{
				_::db()->insert('bux_logs',array('u'=>intval(_::$my['_id']),'log'=>'game.dialog.item.php - buyit','from'=>intval(_::$my['if']['ch']['sc']),'to'=>intval(_::$my['if']['ch']['sc'])+($item['p']*-1)));
			}
			
			_::user()->update(_::$my['_id'],array('$inc'=>array('if.ch.sc'=>($item['p']*-1)),'$push'=>array('if.ch.inv'=>$_i)));
			_::$my['if']['ch']['inv'][]=$_i;
			$ajax->jquery('#frmbuy','html',item_buy());
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
																'm'=>'[ร้านค้า] - ซื้อ <img src="http://s0.boxza.com/static/chat/rank/'.$_i.'.gif"> '.$item['t'].' ราคา '.number_format($item['p']).' บั๊ก',
																'mb'=>1,
																'c'=>1,
																'n'=>_::$my['cname'],
																'l'=>_::$my['link'],
																'i'=>_::$my['img'],
																'am'=>9,
																'ip'=>$_SERVER['REMOTE_ADDR'],
																'rk'=>intval(_::$my['if']['ch']['ci']),
																'vid'=>'',
													);
					
					array_push($data['text'],$al);
					$cache->set('ca2',$key,$data,false,3600*24*7);
				}
			}
		}	
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function sellit($_i)
{
	$db=_::db();
	$user=_::user();
	$ajax=_::ajax();
	$template=_::template();
	$_i=intval($_i);
	if(!is_array(_::$my['if']['ch']))
	{
		_::$my['if']['ch']=array('inv'=>array());
	}
	if(!is_array(_::$my['if']['ch']['inv']))
	{
		_::$my['if']['ch']['inv']=array();
	}
	if(_::$my)
	{
		$item=$template->item[$_i];
		$money=intval(_::$my['if']['ch']['sc']);
		if(!is_array($item))
		{
			$ajax->alert('ไม่มีไอเท็มที่คุณต้องการ');
		}
		elseif(!in_array($_i,_::$my['if']['ch']['inv']))
		{
			$ajax->alert('คุณไม่มีไอเท็มชิ้นนี้');
		}
		else
		{
			$curitem=_::$my['if']['ch']['ci'];
			_::user()->update(_::$my['_id'],array('$inc'=>array('if.ch.sc'=>floor($item['p']/2)),'$pull'=>array('if.ch.inv'=>$_i)));
			
			if(_::$config['bux_logs'])
			{
				_::db()->insert('bux_logs',array('u'=>intval(_::$my['_id']),'log'=>'game.dialog.item.php - sellit','from'=>intval(_::$my['if']['ch']['sc']),'to'=>intval(_::$my['if']['ch']['sc'])+floor($item['p']/2)));
			}
			
			if($_i==_::$my['if']['ch']['ci'])
			{
				_::user()->update(_::$my['_id'],array('$set'=>array('if.ch.ci'=>0)));
				_::$my['if']['ch']['ci']=0;
			}
			$cur=array();
			for($i=0;$i<count(_::$my['if']['ch']['inv']);$i++)
			{
				if(_::$my['if']['ch']['inv'][$i]!=$_i)
				{
					$cur[]=_::$my['if']['ch']['inv'][$i];
				}
			}
			_::$my['if']['ch']['inv']=$cur;
			
			$ajax->jquery('#frmbuy','html',item_buy());
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
																'm'=>'[ร้านค้า] - ขาย <img src="http://s0.boxza.com/static/chat/rank/'.$_i.'.gif"> '.$item['t'].' ในราคา '.number_format(floor($item['p']/2)).' บั๊ก',
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
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function useit($_i,$use)
{
	$db=_::db();
	$user=_::user();
	$ajax=_::ajax();
	$template=_::template();
	$_i=intval($_i);
	if(!is_array(_::$my['if']['ch']))
	{
		_::$my['if']['ch']=array('inv'=>array());
	}
	if(!is_array(_::$my['if']['ch']['inv']))
	{
		_::$my['if']['ch']['inv']=array();
	}
	if(_::$my)
	{
		$item=$template->item[$_i];
		$money=intval(_::$my['if']['ch']['sc']);
		if(!is_array($item))
		{
			$ajax->alert('ไม่มีไอเท็มที่คุณต้องการ');
		}
		elseif(!in_array($_i,_::$my['if']['ch']['inv']))
		{
			$ajax->alert('คุณยังไม่มีไอเท็มชิ้นนี้');
		}
		else
		{
			$curitem=_::$my['if']['ch']['ci'];
			if($use)
			{
				_::user()->update(_::$my['_id'],array('$set'=>array('if.ch.ci'=>$_i)));
				_::$my['if']['ch']['ci']=$_i;
			}
			else
			{
				_::user()->update(_::$my['_id'],array('$set'=>array('if.ch.ci'=>0)));
				_::$my['if']['ch']['ci']=0;
			}
			$ajax->jquery('#frmbuy','html',item_buy());
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
																'm'=>'[ร้านค้า] - '.($use?'สวม':'ถอด').'ไอเท็ม <img src="http://s0.boxza.com/static/chat/rank/'.$_i.'.gif">',
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
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function item_buy()
{
	if(_::$my)
	{
		if(!is_array(_::$my['if']['ch']['inv']))
		{
			_::$my['if']['ch']['inv']=array();
		}
		$template=_::template();
		$tmp='<table width="100%" class="table tbservice tbitem"><tr><th align="center">ไอเท็ม</th><th align="center">ราคาซื้อ</th><th align="center">ราคาขาย</th><th align="center">หมดอายุ</th><th align="center" style="width:50px">บั๊ก</th><th align="center">ป้องกัน</th><th align="center">โจมตี</th><th align="center">ขโมย</th><th align="center"></th><th align="center"></th></tr>';
		$i=0;
		foreach($template->item as $k=>$v)
		{
			$tmp.='<tr><td class="i"><img src="http://s0.boxza.com/static/chat/rank/'.$k.'.gif"></td>
			<td class="f">'.number_format($v['p']).'</td>
			<td class="f">'.number_format(floor($v['p']/2)).'</td>
			<td class="c">'.($v['e']?$v['e']:'- ถาวร -').'</td>
			<td class="f">'.($v['s']?''.$v['s'].'%':'-').'</td>
			<td class="f">'.($v['d']?''.$v['d'].'%':'-').'</td>
			<td class="f">'.($v['a']?''.$v['a'].'%':'-').'</td>
			<td class="f">'.($v['ax']?''.$v['ax'].'%':'-').'</td>
			';
			if(in_array($k,_::$my['if']['ch']['inv']))
			{
				if($k==_::$my['if']['ch']['ci'])
				{
					$tmp.='<td class="b"><a href="javascript:;" class="btn btn-mini btn-inverse" onclick="_.game.bet._useit(\''.$k.'\',0)">ถอด</a></td>';
				}
				else
				{
					$tmp.='<td class="b"><a href="javascript:;" class="btn btn-mini" onclick="_.game.bet._useit(\''.$k.'\',1)">ใส่</a></td>';
				}
				$tmp.='<td class="b"><a href="javascript:;" class="btn btn-mini btn-warning" onclick="_.game.bet._sellit(\''.$k.'\',\''.number_format(floor($v['p']/2)).'\')"><i class="icon-minus icon-white"></i> ขาย</a></td>';
			}
			else
			{
				$tmp.='<td class="b"></td>';
				if($v['p']<100)
				{
					$tmp.='<td class="b">ไม่มีขาย</td>';
				}
				else
				{
					$tmp.='<td class="b"><a href="javascript:;" class="btn btn-mini" onclick="_.game.bet._buyit(\''.$k.'\',\''.number_format($v['p']).'\')"><i class="icon-plus"></i> ซื้อ</a></td>';
				}
			}
			$tmp.='</tr>';
			$i++;
		}
		return $tmp.'</table><div style="padding:10px; margin:5px 0px 0px 0p;border:1px solid #f0f0f0f">บั๊ก คือ บั๊กที่จะได้รับเพิ่มจากการออนไลน์<br>ป้องกัน คือ ค่าป้องกันการขโมย ทำการโอกาสโดนขโมยไม่สำเร็จมากขึ้น<br> โจมตี คือ ค่าโจมตี ที่ทำให้โอกาสในการสำเร็จมากขึ้น<br> ขโมย คือ บั๊กที่จะได้รับเพิ่มเมื่อขโมยสำเร็จ</div>';
	}
}
?>