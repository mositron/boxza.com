<?php 


if($cf)
{
	require_once(HANDLERS.'facebook/facebook.php');
	facebook::$CURL_OPTS[CURLOPT_TIMEOUT]=300;
	$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret'],'fileUpload'=>true));
	$facebook->setAccessToken($cf['token']);
	$facebook->setExtendedAccessToken();
	
	
	
	
	
	date_default_timezone_set('Asia/Bangkok');

	echo '--'.date('H:i',microtime(true)).'---';
	echo '<br>#ตรวจสอบเวลา# '.intval(date('G')).' - '.$cf['delay']['start'].'<br>';
	if(intval(date('G'))>=$cf['delay']['start'])
	{
		echo '#เปิดการทำงานตามเวลา#<br>';
		
		$query=array(
																						'fb'=>array('$in'=>array('185668594895616','119275421551380','276439945704187','215561678464052','558905540806815','145147339021153','552419978152008','206907329467617','537003989706910','294688280665847','390054464415577','332998630119285','418024494891447','299590466830861')),
																						'fbp.'.$cf['delay']['key']=>array('$exists'=>false),
																		);
																		/*
		if($cf['_id']=='661732297181615')
		{
			$query['$or']=array(
											//array('fbp'=>array('$exists'=>false)),
											array('fbp.'.$cf['delay']['key']=>array('$exists'=>false))
			);
		}
		else
		{
			$query['$or']=array(
									//		array('fbp'=>array('$exists'=>false)),
											array('fbp.'.$cf['delay']['key']=>array('$exists'=>false))
			);
		//				'fbp'=>array('$exists'=>false)
																			
		}
		*/
		if($news=$db->find('fbimage',$query,
																		array(),
																		array('sort'=>array('ds'=>-1),'limit'=>100)))
		{
			echo '#เจอแหล่งข่าว#<br>';
			shuffle($news);
			
			$n=$news[0];
			echo '#ระบบกำลังตรวจสอบการหน่วงเวลา #<br>';
			$hash=" \r\n\r\n#BoxZa";
			
			$img = str_replace(array('_s.png','_s.jpg'),array('_o.png','_o.jpg'),$n['img']);
			
			$uid='100000795480500';
			
			echo '#ระบบเตรียมข้อมูลเพื่อโพสไปยัง fb #<br>';
			
			
			if ($uid=$facebook->getUser())
			{
				$tt=array(
			//		'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
					"รูปภาพคอมเม้นท์ฮาๆ  http://goo.gl/VFyuje",
				//	"ติ๊กเก้อไลน์ 4,500รูป http://goo.gl/V9Yvc9",
					"สติกเกอร์เฟสบุ๊ค อัพเดทเรื่อยๆ http://goo.gl/O54ciX",
					"คำคม+ อัพเดททุกวัน http://goo.gl/CxVQj0",
					"เกมบันไดงู - ลูกเต๋า 2 ลูก http://goo.gl/WPm5mQ",
					"Crazy Zombies เกมยิงซอมบี้ สุดมันส์ http://goo.gl/WsRcDy",
					
					"รูปภาพคำคม+ โดนๆอีกเพียบ http://goo.gl/MXX3bi",
					"เกมจับคู่+ สติกเกอร์สุดน่ารัก http://goo.gl/zzcU8B",
					"ฟังวิทยุออนไลน์ กว่า 40+คลื่น http://goo.gl/2LEi4e",
					"ดูละครย้อนหลัง ทุกเรื่องดังอัพเดททันที http://goo.gl/oDBU7X",
					"เช็คผลบอล บอลเมื่อคืน บอลวันนี้ บอลพรุ่งนี้ http://goo.gl/tbuli0",
					"ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล เช็คหวยหุ้น หาเลขเด็ด http://goo.gl/Jy2FzS",
					"ดูดวงเซียมซี จาก 18วัด(สถานที่)ชื่อดัง http://goo.gl/nuQ07A",
					"ดูดวงไพ่ยิปซี ไพ่ท่าโร่ ทั้งแบบรายวันและรายเดือน http://goo.gl/vh1BWO",
					"ดูดวงทำนายฝัน เมื่อคืนฝันเห็น.. เช็คผลทำนาย http://goo.gl/jjyau4",
					"เกมทายใจ เล่นสนุก ขำๆ  http://goo.gl/3bckmb",
					"พจนานุกรม+ ฉบับราชบัณฑิตยสถาน http://goo.gl/li9vd4",
					"เกมบันไดงู+ เล่นคนเดียวก็ได้ เล่นกับเพื่อนก็ดี ไม่ต้องต่อเน็ท http://goo.gl/7BhTlX",
			//		'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
				);
				/*
				if($cf['_id']=='128324113988612')
				{
					$tt=array_filter(array_unique($tt));	
				}
				*/
				if($cf['_id']=='229722963822965')
				{
					$tt=array('');	
				}
				else
				{
					shuffle($tt);
					shuffle($tt);
				}
				if(rand(0,9)>=8)
				{
					$_tt=trim($tt[0]."\r\nเครดิตรูปภาพ: ".$n['p']);	
				}
				else
				{
					$_tt = $tt[0];
				}
				$attachment = array('message' =>$_tt);
				
				$delmyimg='/tmp/post'.$cf['delay']['key'].'.jpg';
				copy($img,$delmyimg);
				$attachment['image'] = '@'.$delmyimg;
				echo '<br># กำลังโพสไป fb #<br>'.
				print_r($attachment);
				try
				{
					//$c=$facebook->api('/'.$cf['album'].'/photos', 'post', $attachment);
					$c=$facebook->api('/'.$cf['_id'].'/photos', 'post', $attachment);
					
					$db->update('fbimage',array('_id'=>$n['_id']),array('$set'=>array('fbp.'.$cf['delay']['key']=>new MongoDate())));
					$db->update('cron_fb',array('_id'=>$cf['_id']),array('$set'=>array('last_type'=>'image')));
					//print_r($c);
				}
				catch (FacebookApiException $e)
				{
					echo '<br>error: '.$e->getMessage().'<br>';
				}	
				if($delmyimg&&file_exists($delmyimg))
				{
					@unlink($delmyimg);
				}
			}
			
		}
		else
		{
			echo '#ไม่เจอแหล่งข่าว#<br>';	
		}
	}
	
}



?>