<?php 



if(!$cf2=$db->findone('user',array('_id'=>$c['uid']),array('sc.fb'=>1,'_id'=>1)))
{
	echo 'ไม่มี fb id นี้';
	exit;
}
$cf=array (
  'delay' => 
  array (
    'after' => 86400,
    'delete' => 10800,
    'hour' => 72000,
    'key' => 'fbme',
    'min_score' => 200,
    'post' => 1200,
    'start' => 9,
  ),
  'token'=>$cf2['sc']['fb']['token'],
  'like' => false,
  'name' => 'me',
  'notdel' => 1,
 );
		
require_once(HANDLERS.'facebook/facebook.php');
facebook::$CURL_OPTS[CURLOPT_TIMEOUT]=300;
$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret'],'fileUpload'=>true));
$facebook->setAccessToken($cf['token']);
$facebook->setExtendedAccessToken();





date_default_timezone_set('Asia/Bangkok');

if(intval(date('G'))>=$cf['delay']['start'])
{
	echo '#เปิดการทำงานตามเวลา#<br>';
	if($news=$db->find('fbimage',array(
																					'fb'=>array('$in'=>array('185668594895616','119275421551380','276439945704187','215561678464052','558905540806815','145147339021153','552419978152008','206907329467617','537003989706910','294688280665847','390054464415577','332998630119285')),
																					'dd'=>array('$exists'=>false),
																					'fbp'=>array('$exists'=>false)
																	),
																	array(),
																	array('sort'=>array('ds'=>-1),'limit'=>50)))
	{
		echo '#เจอแหล่งข่าว#<br>';
		shuffle($news);
		$n=false;
		$last=time();
		$first=time()-$cf['delay']['after'];
		for($i=0;$i<count($news);$i++)
		{
			if(!is_array($news[$i]['fbp']))
			{
				$news[$i]['fbp']=array();	
			}
			$__tm=$news[$i]['fbp'][$cf['delay']['key']];
			if(!$__tm || $__tm->sec<time()-$cf['delay']['hour'])
			{
				if(!$__tm)
				{
					if(!$n)
					{
						$n = $news[$i];
						$last=time()-($cf['delay']['after']+1);
					}
				}
				if($__tm)
				{
					if($__tm->sec<$last)
					{
						$n = $news[$i];
						$last=$__tm->sec;
					}
				}
			}
			if($__tm)
			{
				if($__tm->sec>$first)
				{
					$first=$__tm->sec;
				}
			}
		}
		
		echo '#ระบบกำลังตรวจสอบการหน่วงเวลา #<br>';
		$hash=" \r\n\r\n#BoxZa";
		if($n&&(($first+$cf['delay']['post'])<time()+180))
		{
			//$db->update('news',array('_id'=>$n['_id']),array('$set'=>array('fbp.'.$cf['delay']['key']=>new MongoDate())));
			
			$img = str_replace(array('_s.png','_s.jpg'),array('_o.png','_o.jpg'),$n['img']);
			
			$uid='100000795480500';
			
			echo '#ระบบเตรียมข้อมูลเพื่อโพสไปยัง fb #<br>';
			
			
			if ($uid=$facebook->getUser())
			{
				$tt=array(
					'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
					"รูปภาพคำคม+ โดนๆอีกเพียบ http://goo.gl/MXX3bi",
					"เกมจับคู่+ สติกเกอร์สุดน่ารัก http://goo.gl/zzcU8B",
					"ฟังวิทยุออนไลน์ กว่า 40+คลื่น http://goo.gl/2LEi4e",
					"ดูละครย้อนหลัง ทุกเรื่องดังอัพเดททันที http://goo.gl/oDBU7X",
					"สติกเกอร์ไลน์ เฟสบุ๊ค สุดน่ารัก  http://goo.gl/Wpkfkf",
					"เช็คผลบอล บอลเมื่อคืน บอลวันนี้ บอลพรุ่งนี้ http://goo.gl/tbuli0",
					"ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล เช็คหวยหุ้น หาเลขเด็ด http://goo.gl/Jy2FzS",
					"ดูดวงเซียมซี จาก 18วัด(สถานที่)ชื่อดัง http://goo.gl/nuQ07A",
					"ดูดวงไพ่ยิปซี ไพ่ท่าโร่ ทั้งแบบรายวันและรายเดือน http://goo.gl/vh1BWO",
					"ดูดวงทำนายฝัน เมื่อคืนฝันเห็น.. เช็คผลทำนาย http://goo.gl/jjyau4",
					"เกมทายใจ เล่นสนุก ขำๆ  http://goo.gl/3bckmb",
					"พจนานุกรม+ ฉบับราชบัณฑิตยสถาน http://goo.gl/li9vd4",
					"เกมบันไดงู+ เล่นคนเดียวก็ได้ เล่นกับเพื่อนก็ดี ไม่ต้องต่อเน็ท http://goo.gl/7BhTlX",
					"แอพแนะนำ สำหรับ Android  http://goo.gl/VzzS2P",
				);
				shuffle($tt);
				shuffle($tt);
				
				$_tt = $tt[0];
				
				$attachment = array('message' =>$_tt);
				
				$delmyimg='/tmp/post'.$cf['delay']['key'].'.jpg';
				copy($img,$delmyimg);
				$attachment['image'] = '@'.$delmyimg;
				echo '<br># กำลังโพสไป fb #<br>'.
				print_r($attachment);
				try
				{
					//$c=$facebook->api('/'.$cf['album'].'/photos', 'post', $attachment);
					$c=$facebook->api('/me/photos', 'post', $attachment);
					
					$db->update('fbimage',array('_id'=>$n['_id']),array('$set'=>array('fbp.'.$cf['delay']['key']=>new MongoDate())));
					//$db->update('cron_fb',array('_id'=>$cf['_id']),array('$set'=>array('last_type'=>'image')));
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
		elseif($first+$cf['delay']['post']>=time())
		{
			$m=time()-$first;
			$n=$m%60;
			$m=floor($m/60);
			echo '<br># ไม่สามารถโพสไป fb ได้ เนื่องจากพึ่งโพสล่าสุดไปเมื่อ '.$m.':'.$n.' นาทีที่แล้ว#<br>';
		}
	}
	else
	{
		echo '#ไม่เจอแหล่งข่าว#<br>';	
	}
}



?>