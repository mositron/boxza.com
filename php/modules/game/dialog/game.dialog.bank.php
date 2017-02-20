<?php

//_::session()->logged();

define('BANK_RATE',900);
define('BANK_RATE2',1000);

_::ajax()->register(array('doit','doit2'));


$template=_::template();
echo $template->fetch2('game.dialog.bank');
exit;

function doit($_m)
{
	$db=_::db();
	$user=_::user();
	$ajax=_::ajax();
	$_m=intval($_m);
	if(_::$my)
	{
		if(!is_numeric($_m)||$_m<1) 
		{
			$ajax->alert('กรุณากรอกจำนวนบ๊อกให้ถูกต้อง');
		}
		elseif($_m>intval(_::$my['cd']['p'])) 
		{
			$ajax->alert('คุณมีบ๊อกไม่เพียงพอต่อการแลก');
		}
		else
		{
			$up=$_m*BANK_RATE;
			if(_::point()->action(_::$my['_id'],($_m * -1),'chat','แลก '.$_m.' บ๊อกเป็น '.$up.' บั๊กภายในห้องแชท'))
			{
				$ajax->alert('ได้รับ '.number_format($up).' บั๊กเรียบร้อยแล้ว (กรุณารอระบบอัพเดทซักครู่...)');
				_::user()->update(_::$my['_id'],array('$inc'=>array('if.ch.sc'=>$up)));
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval(_::$my['_id']),'log'=>'game.dialog.bank.php - doit','from'=>intval(_::$my['if']['ch']['sc']),'to'=>intval(_::$my['if']['ch']['sc'])+$up));
				}
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
																	'm'=>'[ธนาคาร] - นำบ๊อกมาแลกเป็นบั๊ก จำนวน '.$_m.' บ๊อก คิดเป็น '.number_format($up).' บั๊ก ( 1 บ๊อก = '.BANK_RATE.' บั๊ก )',
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
			else
			{
				$ajax->alert('คุณไม่สามารถแลกบั๊กได้ในขณะนี้ กรุณาลองใหม่ภายหลัง');
			}
		}	
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function doit2($_m)
{
	$db=_::db();
	$user=_::user();
	$ajax=_::ajax();
	$_m=intval($_m);
	if(_::$my)
	{
		if(!is_numeric($_m)||$_m<1) 
		{
			$ajax->alert('กรุณากรอกจำนวนบ๊อกให้ถูกต้อง');
		}
		elseif($_m>intval(_::$my['if']['ch']['sc'])) 
		{
			$ajax->alert('คุณมีบั๊กไม่เพียงพอต่อการแลก');
		}
		else
		{
			$_r=floor($_m/BANK_RATE2);
			if($_r<1)
			{
				$ajax->alert('บั๊กน้อยเกินไปต่อการแลก');
			}
			elseif(_::point()->action(_::$my['_id'],$_r,'chat','แลก '.$_m.' บั๊กเป็น '.$_r.' บ๊อก ภายในห้องแชท'))
			{
				$up=$_m*-1;
				$ajax->alert('ได้รับ '.number_format($_r).' บ๊อกเรียบร้อยแล้ว (กรุณารอระบบอัพเดทซักครู่...)');
				_::user()->update(_::$my['_id'],array('$inc'=>array('if.ch.sc'=>$up)));
	
				if(_::$config['bux_logs'])
				{
					_::db()->insert('bux_logs',array('u'=>intval(_::$my['_id']),'log'=>'game.dialog.bank.php - doit','from'=>intval(_::$my['if']['ch']['sc']),'to'=>intval(_::$my['if']['ch']['sc'])+$up));
				}
			
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
																	'm'=>'[ธนาคาร] - นำบั๊กมาแลกเป็นบ๊อก จำนวน '.$_m.' บั๊ก คิดเป็น '.$_r.' บ๊อก ( 1 บ๊อก = '.BANK_RATE2.' บั๊ก )',
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
			else
			{
				$ajax->alert('คุณไม่สามารถแลกบั๊กได้ในขณะนี้ กรุณาลองใหม่ภายหลัง');
			}
		}	
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

?>