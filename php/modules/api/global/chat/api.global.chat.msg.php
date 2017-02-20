<?php
$par=explode(' ',$chat->cmd,2);
$color=intval($par[0]);
$ms=trim(mb_substr(htmlspecialchars($par[1], ENT_QUOTES, 'utf-8'),0,500,'utf-8'));

$is_myroom=false;
if(in_array($chat->room,$chat->superroom))
{
	$is_myroom=true;
	
	
	if(!_::$my)
	{
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'กรุณาล็อคอิน เพื่อทำการพิมหน้าห้องนี้');
		$ms='';
	}
}

$bt=0;
$ms2=' '.str_replace(array(' ','&nbsp;','-','	'),'',$ms).' ';

if($chat->mybux<-1000)
{
	_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'คุณมีคะแนนน้อยเกินไป ไม่สามารถคุยหน้าห้องได้');
	$ms='';
}
elseif(preg_match('/'.$chat->badword.'/i',$ms2,$c)||preg_match('/0([8|9]{1})([0-9]{5,10})/',$ms2,$c))
{
	if($chat->myadmin||in_array($chat->myid,$chat->super))
	{
		_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้ กรุณาใช้คำสุภาพนะคะ');
	}
	else
	{
		$dispoint=false;
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
				_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้ กรุณาใช้คำสุภาพนะคะ');
			}
			else
			{
				$bt=1800;
			}
		}
		if($bt)
		{
			$chat->data['ban']['_id'][$uid]=time()+$bt;
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
			'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] [IP: '.$_SERVER['REMOTE_ADDR'].'] - แบน '.floor($bt/60).' นาที'.($dispoint?', ปรับ '.number_format($dispoint).' บั๊ก':'').' ด้วยข้อหา คำหยาบ/คำต้องห้าม (หน้าห้อง)','par'=>array('uid'=>$chat->myid),'c'=>21
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
elseif($is_myroom && preg_match('/(.)\1{7,}/iu',$ms2) && !in_array($chat->myid,$chat->super))
{
	/*
	$chat->inserttext(array(
		'u'=>-1,
		'mb'=>1,
		'n'=>'ระบบ',
		'l'=>'',
		'i'=>'http://s1.boxza.com/profile/00/00/00/s.jpg',
		'am'=>3,
		'rk'=>rand(1,5),
		'vid'=>'',
		'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] - ด้วยข้อหาฟลัดตัวอักษร (หน้าห้อง)','par'=>array('uid'=>$chat->myid),'c'=>21
		));
	*/
	_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'กรุณาอย่า.. ฟลัดตัวอักษร');
	$ms='';
}

if($ms && isset($chat->data['shutup'][$chat->myid]) && $chat->myid!=1)
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


if($ms)
{
	$ms=trim(preg_replace('/([^"|^\'|^>])http:\/\/([a-z0-9\.]+)?boxza([a-z0-9\.]+)?\.com([^\s,]*)/i','$1<a href="http://$2boxza$3.com$4" target="_blank" rel="nofollow">http://$2boxza$3.com$4</a>',' '.$ms.' '));
	
	$chat->inserttext(array('ty'=>'ms','m'=>$ms,'c'=>$color));
	
	
	if(in_array($chat->myid,$chat->superkick)&&$is_myroom)
	{
		$ms2=' '.str_replace(array(' ','&nbsp;','-','	','.'),'',$ms).' ';
		if(preg_match('/(.+)(ลุง|รุง|ชรา|แก่|เฒ่า|สูงวัย|สูงอายุ)(.+)/i',$ms2))
		{
			$chat->inserttext(array(
				'u'=>1,
				'mb'=>1,
				'n'=>'^C18,18ກ ^C7,7າ ^C9,9ຮ ^C18,18ໂ ^C7,7ຮ ^C9,9ງ',
				'l'=>'',
				'i'=>'http://s1.boxza.com/profile/00/00/01/s.jpg',
				'am'=>9,
				'rk'=>101,
				'vid'=>'',
				'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.']  - แบน 3 นาที - เนื่องจาก "ได้รับ ของขวัญ 1 ea"','par'=>array('uid'=>$chat->myid),'c'=>21
				));
				
				$chat->data['ban']['_id'][$uid]=time()+180;
				$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+180;
		}
	}

	$bchat = array(
										array(
													'(ดี|onion\=4\])',
													array(
																'ดีจ้า',
																'ดี',
																'ดีๆ',
																'ทักคนมาใหม่',
																'หวัดดี',
																'[emoticon=o4]',
													),
										),
										array(
													'ทัก',
													array(
																'ทักๆ',
																'ทักด้วย',
																'ทักจ้า',
																'ดีๆ',
																'[emoticon=o4]',
													),
										),
										array(
													'แกล้ง(.*)บอท',
													array(
																'<span>'.$chat->myname.'</span>  &lt;-- จะมาแกล้งทำไม หาาาาาาา.',
																'แกล้ง?',
																'เหอๆ',
																'แกล้งไร',
													),
									),
									array(
													'มัค(.*)ไง',
													array(
																'<span>'.$chat->myname.'</span> --&gt; คลิกที่ <a href="javascript:;" onclick="_.signup()">สมัครสมาชิก</a> หรือ <a href="javascript:;" onclick="_.login()">ล็อคอิน</a> '
													),
									),
									array(
													'เปลี่ยน(.*)รูป',
													array(
																'<span>'.$chat->myname.'</span> ต้องสมัครสมาชิกก่อนนะ หรือคลิกที่ <a href="javascript:;" onclick="_.signup()">สมัครสมาชิก</a> หรือ <a href="javascript:;" onclick="_.login()">ล็อคอิน</a>'
													),
									),
									array(
													'เปลี่ยน(.*)ชื่อ',
													array(
																'คลิกที่ชื่อตัวเอง เพื่อเปลี่ยนได้เลย',
																'คลิกที่ชื่อตังเอง',
																'คลิกที่ชื่อ <span>'.$chat->myname.'</span>',
													),
									),
									array(
												'(ไป(.*)(ก่อน|แล้ว|แระ)|emoticon\=o116)',
													array(
																'บะบายจ้า',
																'บาย',
																'บายๆ',
																'ให้ไวเลยๆ',
																'แล้วอย่ามาอีกนะ....[o15]',
																'[emoticon=o116]',
													),
									),
	);
	
	$valid=false;
	for($i=0;$i<count($bchat);$i++)
	{				
		if($bchat[$i][0] && preg_match('/'.$bchat[$i][0].'/i',$ms,$c))
		{
			$b=$bchat[$i][1];
			shuffle($b);
			$valid=$b[0];
			//_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'1----'.$valid);
			break;
		}
	}
	if($valid)
	{
		$nick=getnicks($chat->cache,$chat->room);
		$rnd=rand(300,600);
		foreach($chat->data['bot'] as $a=>$b)
		{
			if($chat->data['bot'][$a]['ty']=='chat' && $nick[$a] && ((!$nick[$a]['ls'])||($nick[$a]['ls']+$rnd<$chat->time2)))
			{
				$cbot=$chat->data['bot'][$a];
				$clbot=1;
				$ambot=0;
				if(isset($chat->data['admin'][$a]))
				{
					$ambot=$chat->data['admin'][$a]['lv'];
				}
				if($cbot['color'])
				{
					$clbot=$cbot['color'];
					if(is_array($cbot['color']))
					{
						$clbot=$cbot['color'];
						shuffle($clbot);
						$clbot=$clbot[0];
					}
				}
				array_push($chat->data['wait'],array('ty'=>'ms','u'=>$a,'m'=>$valid,'c'=>$clbot,'n'=>$nick[$a]['n'],'l'=>$nick[$a]['l'],'i'=>$nick[$a]['i'],'mb'=>1,'rk'=>1,'vid'=>'','am'=>$ambot,'wt'=>$chat->time2+rand(5,10)));	
				$chat->save=true;
				$nick[$a]['ls']=$chat->time2;
				$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);
				
				//_::$content[] = array('method'=>'chatbox','type'=>'notice','data'=>'2----'.$nick[$a]['n']);
				break;
			}
		}
	}
}
?>