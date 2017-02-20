<?php
set_time_limit(600);

$hashtag=array(
'9'=>array('t'=>'การเมือง'),
'1'=>array('t'=>'กีฬา'),
'2'=>array('t'=>'เกมส์','s'=>array(
																												1=>array('t'=>'ออนไลน์'),
																												2=>array('t'=>'บนเว็บ'),
																												3=>array('t'=>'PC'),
																												4=>array('t'=>'Console'),
																												5=>array('t'=>'มือถือ #แท็บเล็ต'),
																											),
),
'3'=>array('t'=>'เทคโนโลยี','s'=>array(
																												1=>array('t'=>'ข่าวไอที'),
																												2=>array('t'=>'ทิป #เทคนิค'),
																												3=>array('t'=>'น่ารู้'),
																												4=>array('t'=>'Gadget'),
																												5=>array('t'=>'แนะนำ'),
																											),
																											'sl'=>'http://tech.boxza.com/'
),
'4'=>array('t'=>'บันเทิง','s'=>array(
																												1=>array('t'=>'ซุบซิบดารา'),
																												2=>array('t'=>'ติดกระแส'),
																												3=>array('t'=>'คลิปดารา'),
																												4=>array('t'=>'กิจกรรม'),
																												5=>array('t'=>'ฮอลลีวู้ด'),
																												6=>array('t'=>'เอเชีย'),
																												7=>array('t'=>'เรื่องย่อละคร','s'=>array(
																																																			1=>array('t'=>'ช่อง3'),
																																																			2=>array('t'=>'ช่อง5'),
																																																			3=>array('t'=>'ช่อง7'),
																																																			4=>array('t'=>'ช่อง9'),
																																																			5=>array('t'=>'ThaiPBS'),
																												)),
																											),
),
'5'=>array('t'=>'ภาพยนตร์','s'=>array(
																												1=>array('t'=>'ข่าวหนัง')
																						)
),
'24'=>array('t'=>'เพลง','s'=>array(
																												1=>array('t'=>'ข่าวเพลง')
																						)
),
'6'=>array('t'=>'ไลฟ์สไตล์'),
'8'=>array('t'=>'โดนๆ'),
'13'=>array('t'=>'สังคมออนไลน์'),
'7'=>array('t'=>'ลึกลับ'),
'22'=>array('t'=>'หวย','s'=>array(
																											1=>array('t'=>'เลขเด็ด')
																						)
),

'20'=>array('t'=>'ดูดวง','s'=>array(
																												1=>array('t'=>'รายวัน'),
																												2=>array('t'=>'ความรัก'),
																												3=>array('t'=>'ไพ่ยิบซี'),
																												4=>array('t'=>'ฮวงจุ้ย'),
																												5=>array('t'=>'ทายนิสัย'),
																												6=>array('t'=>'ทำนายฝัน'),
																											),
),

'21'=>array('t'=>'พยากรณ์อากาศ','s'=>array(
																												1=>array('t'=>'สภาพอากาศ'),
																												2=>array('t'=>'เตือนภัย'),
																											),
),

'14'=>array('t'=>'แบบบ้าน','s'=>array(
																												1=>array('t'=>'ห้องนอน'),
																												2=>array('t'=>'ห้องนอนเด็ก'),
																												3=>array('t'=>'ห้องรับแขก'),
																												4=>array('t'=>'ห้องน้ำ'),
																												5=>array('t'=>'ห้องครัว'),
																												6=>array('t'=>'ของใช้ในบ้าน'),
																												7=>array('t'=>'คอนโด'),
																												8=>array('t'=>'ออฟฟิค'),
																												9=>array('t'=>'ไอเดียแต่งบ้าน'),
																												10=>array('t'=>'การจัดสวน'),
																												11=>array('t'=>'ฮวงจุ้ยบ้าน'),
																												12=>array('t'=>'ตัวอย่างบ้าน'),
																												13=>array('t'=>'สินเชื่อบ้าน'),
																											),
																											'sl'=>'http://home.boxza.com/'
),
'15'=>array('t'=>'ท่องเที่ยว','s'=>array(
																												1=>array('t'=>'พาชิม'),
																												2=>array('t'=>'เที่ยวกลางคืน'),
																												3=>array('t'=>'เที่ยวทะเล'),
																												4=>array('t'=>'เที่ยวภูเขา'),
																												5=>array('t'=>'เที่ยวเทศกาล #ประเพณี'),
																												6=>array('t'=>'ท่องเที่ยวไทย'),
																												7=>array('t'=>'เที่ยวกรุงเทพ'),
																												8=>array('t'=>'เที่ยวต่างประเทศ'),
																												9=>array('t'=>'Tips ท่องเที่ยว'),
																											),
),
'16'=>array('t'=>'แม่และเด็ก','s'=>array(
																												1=>array('t'=>'คุณแม่'),
																												2=>array('t'=>'คุณลูก'),
																												3=>array('t'=>'อาหารเด็ก'),
																												4=>array('t'=>'นิทาน'),
																												5=>array('t'=>'ตั้งชื่อลูก'),
																												6=>array('t'=>'ลูกดารา'),
																											),
),
'17'=>array('t'=>'แต่งงาน','s'=>array(
																												1=>array('t'=>'วางแผน'),
																												2=>array('t'=>'พิธีแต่งงาน'),
																												3=>array('t'=>'ชุดแต่งงาน'),
																												4=>array('t'=>'แหวนแต่งงาน'),
																												5=>array('t'=>'การ์ดแต่งงาน'),
																												6=>array('t'=>'ซุ้มดอกไม้'),
																												7=>array('t'=>'บทความความรัก'),
																												8=>array('t'=>'ของชำร่วย'),
																												9=>array('t'=>'ดารา'),
																											),
),
'18'=>array('t'=>'สัตว์เลี้ยง','s'=>array(
																												1=>array('t'=>'สุนัข #หมา'),
																												2=>array('t'=>'แมว'),
																												3=>array('t'=>'ปลา #สัตว์น้ำ'),
																												4=>array('t'=>'นก #สัตว์ปีก'),
																												5=>array('t'=>'สัตว์เลี้ยงทั่วไป'),
																											),
),
'19'=>array('t'=>'การศึกษา','s'=>array(
																												1=>array('t'=>'Admission'),
																												2=>array('t'=>'คลังข้อสอบ'),
																												3=>array('t'=>'แนะนำคณะ'),
																												4=>array('t'=>'ข่าวการศึกษา'),
																												5=>array('t'=>'เรียนต่อ'),
																												6=>array('t'=>'ทุนการศึกษา'),
																												7=>array('t'=>'หนุมสาว #ดาวเด่น'),
																											),
),
'23'=>array('t'=>'สุขภาพ','s'=>array(
																												1=>array('t'=>'สุขภาพน่ารู้'),
																												2=>array('t'=>'โรคภัยไข้เจ็บ'),
																												3=>array('t'=>'ออกกำลังกาย'),
																												4=>array('t'=>'สมุนไพร'),
																												5=>array('t'=>'อาหาร')
																											),
),
'12'=>array('t'=>'รถใหม่','s'=>array(
																						-1=>array('t'=>'โปรโมชั่น'),
																						-2=>array('t'=>'วิธีบำรุงรักษา'),
																						-3=>array('t'=>'ศูนย์บริการ'),
																						-6=>array('t'=>'MotorExpo #MotorExpo2013'),
																						3=>array('t'=>'Audi'),
																						5=>array('t'=>'BMW'),
																						7=>array('t'=>'Chevrolet'),
																						8=>array('t'=>'Citroen'),
																						57=>array('t'=>'Daihatsu'),
																						12=>array('t'=>'Fiat'),
																						13=>array('t'=>'Ford'),
																						14=>array('t'=>'Honda'),
																						15=>array('t'=>'Hyundai'),
																						16=>array('t'=>'Isuzu'),
																						17=>array('t'=>'Jaguar'),
																						69=>array('t'=>'Jeep'),
																						18=>array('t'=>'KIA'),
																						20=>array('t'=>'LandRover'),
																						21=>array('t'=>'Lexus'),
																						24=>array('t'=>'Mazda'),
																						25=>array('t'=>'MercedesBenz'),
																						26=>array('t'=>'Mini'),
																						27=>array('t'=>'Mitsubishi'),
																						30=>array('t'=>'Nissan'),
																						31=>array('t'=>'Peugeot'),
																						32=>array('t'=>'Porsche'),
																						33=>array('t'=>'Proton'),
																						88=>array('t'=>'Rover'),
																						89=>array('t'=>'Saab'),
																						90=>array('t'=>'Seat'),
																						37=>array('t'=>'Ssangyong'),
																						38=>array('t'=>'Subaru'),
																						39=>array('t'=>'Suzuki'),
																						40=>array('t'=>'TATA'),
																						42=>array('t'=>'Toyota'),
																						43=>array('t'=>'Volkswagen'),
																						44=>array('t'=>'Volvo'),
																						),
	)
);

$twconfig=array(
										'news'=>array(
																				'oauth'=>array(/*
																													  'consumer_key' => 'mNWBginzVyrhBmG8LO28jA',
																													  'consumer_secret' => 'Rd6wlJzDSwO9kZNaXTqgOqyvp7xnmNWfZV1jxX6eN9c',
																													  'user_token' => '1371487340-IYgGPED1c5CNCxhhrcSsBftvN2a6H1BhquAsToB',
																													  'user_secret' => 'lb62v4YAowt9wQBT4YPyQUYGx0MFwxgWPj6nWiA3wOI',
																													  */
																													  'consumer_key' => 'eT9sLQAqkeau9de37bsgYw',
																													  'consumer_secret' => 'E1oOhw0J6UzztbQm0zTc2Qid58h7F3An55eIuMWo',
																													  'user_token' => '5733372-ueC9bBarkXB5ZWlGrFOTRFNC2G1ljFiDwJBB9BVW5o',
																													  'user_secret' => 'QON0kjjNcWrI9QyzmNM2iuersL34xAfQjKlQbHV5LI',
																													  'curl_connecttimeout' => 600,
																													  'curl_timeout' => 600,
																													  'curl_ssl_verifypeer'=>false,
																				),
																			  'format' => '{:TITLE:} {:LINK:} #BoxZa'
																			),
										'video'=>array(
																				'oauth'=>array(
																													  'consumer_key' => '06PcXQctRrY8qc5JAcxQ',
																													  'consumer_secret' => 'yd1CgEcTCPRnRS6WH1c0YpdqkrEswyvdjKkGAsBw58',
																													  'user_token' => '1371794744-9md22JGWzfBtvPAFdmpBnXJVhzWPCbZ1wnJrhtf',
																													  'user_secret' => '8Dt5xYYr9ITFEdXBCae4V306YqWCmVvOFadhUNfg',
																													  'curl_connecttimeout' => 600,
																													  'curl_timeout' => 600,
																				),
																			  'format' => '{:TITLE:} {:LINK:} #BoxZa'
																			),
);

$type='';


// NEWS

$db = _::db();
if($news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'tw'=>array('$exists'=>false),'da'=>array('$gte'=>new MongoDate(time()-(3600*12)))),array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1,'cs2'=>1),array('sort'=>array('_id'=>1),'limit'=>1)))
{
	$n = $news[0];
	$db->update('news',array('_id'=>$n['_id']),array('$set'=>array('tw'=>new MongoDate())));
	
	$type='news';
	$title = $n['t'];
	$img = 'http://s3.boxza.com/news/'.$n['fd'].'/s.jpg';
	$url=link::news($n);
}
elseif($video=$db->find('video',array('dd'=>array('$exists'=>false),'tw'=>array('$exists'=>false),'da'=>array('$gte'=>new MongoDate(time()-(3600*12)))),array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'n'=>1),array('sort'=>array('_id'=>1),'limit'=>1)))
{
	// $video_rec=$db->find('video',array('dd'=>array('$exists'=>false),'rc'=>array('$gt'=>0)),array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'c'=>1,'cs'=>1,'n'=>1,'dr'=>1,'yt'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	$n = $video[0];
	$db->update('video',array('_id'=>$n['_id']),array('$set'=>array('tw'=>new MongoDate())));
	
	$type='video';
	$title = $n['t'];
	$img = 'http://s3.boxza.com/video/'.$n['f'].'/'.$n['n'];
	$url = 'http://video.boxza.com/view/'.$n['_id'];
}
else
{
	echo 'ยังไม่มีเนื้อหาใหม่';
}
		
		


#################################          TWITTER         ####################################

if($type&&isset($twconfig[$type]))
{
	
	if(!$autourl=$db->findone('autourl',array('l'=>$url),array('_id'=>1,'g'=>1)))
	{
		if($id=$db->insert('autourl',array('t'=>$title,'i'=>$img,'l'=>$url,'ty'=>$type)))
		{
			$g = gen_link($id);
			$db->update('autourl',array('_id'=>$id),array('$set'=>array('g'=>$g)));
			$link='http://boxz.co/'.$g;
		}
	}
	else
	{
		$link='http://boxz.co/'.$autourl['g'];
	}
	
	if(!$link)
	{
		$link=$url;
	}
	
	require_once(__DIR__.'/tmhOAuth/tmhOAuth.php');
	require_once(__DIR__.'/tmhOAuth/tmhUtilities.php');

	$txtserv=$twconfig[$type]['format'];
	if($type=='news')
	{
		if(isset($hashtag[$n['c']]))
		{
			$txtserv.=' #'.$hashtag[$n['c']]['t'];
			if($hashtag[$n['c']]['s'])
			{
				if($n['cs'])
				{
					if(isset($hashtag[$n['c']]['s'][$n['cs']]))
					{
						$txtserv.=' #'.$hashtag[$n['c']]['s'][$n['cs']]['t'];					
						if($hashtag[$n['c']]['s'][$n['cs']]['s'])
						{
							if($n['cs2'])
							{
								if(isset($hashtag[$n['c']]['s'][$n['cs']]['s'][$n['cs2']]))
								{
									$txtserv.=' #'.$hashtag[$n['c']]['s'][$n['cs']]['s'][$n['cs2']]['t'];
								}
							}
						}
					}
				}
			}
		}
	}
	$message=str_replace('{:LINK:}',$link,$txtserv);
	$len=140-mb_strlen($message,'utf-8')+mb_strlen('{:TITLE:}','utf-8');
	if(mb_strlen($title,'utf-8')>$len)
	{
		$message=str_replace('{:TITLE:}',mb_substr($title,0,$len-3,'utf-8').'...',$message);
	}
	else
	{
		$message=str_replace('{:TITLE:}',$title,$message);
	}
	
	$tmhOAuth = new tmhOAuth($twconfig[$type]['oauth']);
	#echo $tmhOAuth->url('1.1/statuses/update_with_media');
	
	#if($type=='news')
	#{
	#	$response = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update_with_media'), array('status' => $message,'media[]'=>file_get_contents('http://s3.boxza.com/news/'.$n['fd'].'/m.jpg')),true,true);
	#}
	#else
	#{
		$response = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update'), array('status' => $message));
	#}
	print_r($tmhOAuth->response);
	print_r($response);
	print_r($twconfig[$type]['oauth']);
	echo '<br>message: '.$message.'<br>';
	if ($response != 200)
	{
		echo 'ข้อมูลการโพส twitter ไม่ถูกต้อง <br><br><br><br>';
	} 
}

################################################################################################

	
	
	
	

#######################################          FACEBOOK         ######################################## 

$c=array('fbid'=>'229722963822965');

$db=_::db();
echo 'ค้นหา fb id : '.$c['fbid'].'<br>';
if(!$cf=$db->findone('cron_fb',array('_id'=>$c['fbid'])))
{
	echo 'ไม่มี fb id นี้';
	exit;
}
$cf['id']=$cf['_id'];


//require_once(dirname(__DIR__).'/facebook/cron.facebook.image.php');



function gen_link($i)
{
	$a = array(
	'0', '1', '2', '3','4', '5', '6', '7', '8', '9',
	'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
	'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
	'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
	'y', 'z',
	'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
	'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
	'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
	'Y', 'Z',
	);
	$s = '';
	$c = count($a);
	while($i > 0)
	{
		$s = (string)$a[$i % $c] . $s;
		$i = floor($i / $c);
	}
	return $s;
}
	
?>