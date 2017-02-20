<?php 


if($cf)
{
	$db=_::db();
	echo 'ค้นหา fb id : '.$cf['id'].'<br>';
	if(!$cf=$db->findone('cron_fb',array('_id'=>$cf['id'])))
	{
		echo 'ไม่มี fb id นี้';
		exit;
	}
	$cf['id']=$cf['_id'];
	require_once(HANDLERS.'facebook/facebook.php');
	facebook::$CURL_OPTS[CURLOPT_TIMEOUT]=300;
	$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret'],'fileUpload'=>true));
	$facebook->setAccessToken($cf['token']);
	$facebook->setExtendedAccessToken();
	
	
	date_default_timezone_set('Asia/Bangkok');

	echo '--'.date('H:i',microtime(true)).'---';
	echo '<br>#ตรวจสอบเวลา# '.intval(date('G')).' - '.$cf['delay']['start'].'<br>';
	if(intval(date('G'))>=$cf['delay']['start'] || intval(date('G'))<=2)
	{
		echo '#เปิดการทำงานตามเวลา#<br>';
		if($news=$db->find('news',array(
																						'pl'=>1,
																						'dd'=>array('$exists'=>false),
																						'$or'=>array(
																														array('da'=>array('$gte'=>new MongoDate(time()-$cf['delay']['after']))),
																														array('da'=>array('$gte'=>new MongoDate(time()-(3600*24*7))),'do'=>array('$gte'=>7000),$cf['delay']['key']=>array('$lte'=>new MongoDate(time()-(3600*72))))
																						)
																		),
																		array('_id'=>1,'t'=>1,'fd'=>1,'c'=>1,'cs'=>1,$cf['delay']['key']=>1),
																		array('sort'=>array('_id'=>1),'limit'=>100)))
		{
			echo '#เจอแหล่งข่าว#<br>';
			shuffle($news);
			$n=false;
			$last=time();
			$first=time()-$cf['delay']['after'];
			for($i=0;$i<count($news);$i++)
			{
				if(!$news[$i][$cf['delay']['key']] || $news[$i][$cf['delay']['key']]->sec<time()-$cf['delay']['hour'])
				{
					if(!$news[$i][$cf['delay']['key']])
					{
						if(!$n)
						{
							$n = $news[$i];
							$last=time()-($cf['delay']['after']+1);
						}
					}
					if($news[$i][$cf['delay']['key']])
					{
						if($news[$i][$cf['delay']['key']]->sec<$last)
						{
							$n = $news[$i];
							$last=$news[$i][$cf['delay']['key']]->sec;
						}
					}
				}
				if($news[$i][$cf['delay']['key']])
				{
					if($news[$i][$cf['delay']['key']]->sec>$first)
					{
						$first=$news[$i][$cf['delay']['key']]->sec;
					}
				}
			}
			
			echo '#ระบบกำลังตรวจสอบการหน่วงเวลา #<br>';
			$hash=" \r\n\r\n#BoxZa ";
			if($n&&(($first+$cf['delay']['post'])<time()+180))
			{
				//$db->update('news',array('_id'=>$n['_id']),array('$set'=>array($cf['delay']['key']=>new MongoDate())));
				
				$type='news';
				$title = $n['t'];
				$img = 'http://s3.boxza.com/news/'.$n['fd'].'/m.jpg';
				
				if($n['c']==1)
				{
					$hash.='#กีฬา ';
					$url = 'http://news.boxza.com/view/'.$n['_id'];
				}
				elseif($n['c']==2)
				{
					$hash.='#เกมส์ ';
					$url = 'http://news.boxza.com/view/'.$n['_id'];
				}
				elseif($n['c']==3)
				{
					$hash.='#เทคโนโลยี ';
					$url = 'http://news.boxza.com/view/'.$n['_id'];
				}
				elseif($n['c']==4)
				{
					$hash.='#บันเทิง ';
					switch($n['cs'])
					{
						case 1:
							$hash.='#ซุบซิบดารา ';
							$url = 'http://entertain.boxza.com/gossip/'.$n['_id']; 
							break;
						case 3:
							$hash.='#ภาพหลุดดารา ';
							$url = 'http://entertain.boxza.com/photo/'.$n['_id']; 
							break;
						case 4:
							$hash.='#กิจกรรม ';
							$url = 'http://entertain.boxza.com/event/'.$n['_id']; 
							break;
						case 5:
							$hash.='#บันเทิงฮอลลีวู้ด ';
							$url = 'http://entertain.boxza.com/hollywood/'.$n['_id']; 
							break;
						case 6:
							$hash.='#บันเทิงเอเชีย ';
							$url = 'http://entertain.boxza.com/asian/'.$n['_id']; 
							break;
						case 7:
							$hash.='#เรื่องย่อละคร ';
							$url = 'http://entertain.boxza.com/drama/'.$n['_id']; 
							break;
						default:
							$hash.='#ติดกระแส ';
							$url = 'http://entertain.boxza.com/news/'.$n['_id']; 
							break;
					}
				}
				elseif($n['c']==5)
				{
					$hash.='#ภาพยนตร์ ';
					$url = 'http://news.boxza.com/view/'.$n['_id'];
				}
				elseif($n['c']==6)
				{
					$hash.='#ไลฟ์สไตล์ ';
					$url = 'http://news.boxza.com/view/'.$n['_id'];
				}
				elseif($n['c']==7)
				{
					if($n['cs']==1)
					{
						$hash.='#เลขเด็ด #ตรวจหวย ';
						$url = 'http://lotto.boxza.com/news/'.$n['_id'];	
					}
					else
					{
						$hash.='#ลึกลับ ';
						$url = 'http://news.boxza.com/view/'.$n['_id'];
					}
				}
				elseif($n['c']==9)
				{
					$hash.='#การเมือง ';
					$url = 'http://news.boxza.com/view/'.$n['_id'];
				}
				else
				{
					$url = 'http://news.boxza.com/view/'.$n['_id'];
				}
				$uid='100000795480500';
				
				echo '#ระบบเตรียมข้อมูลเพื่อโพสไปยัง fb #<br>';
				
				if($cf['like'])
				{
					if(!$autourl=$db->findone('shortener',array('l'=>$url,'u'=>$uid),array('_id'=>1,'g'=>1)))
					{
						if($id = $db->insert('shortener',array('u'=>$uid,'t'=>$title,'l'=>$url,'ac'=>new MongoDate(time()+$cf['delay']['delete']),'ip'=>$_SERVER['REMOTE_ADDR'],'do'=>0)))
						{
							$g = gen_link($id);
							$db->update('shortener',array('_id'=>$id),array('$set'=>array('g'=>$g)));
							$link='http://1.1lik.es/'.$g;
						}
					}
					else
					{
						$db->update('shortener',array('_id'=>$autourl['id']),array('$set'=>array('ac'=>new MongoDate(time()+$cf['delay']['delete']))));
						$link='http://1.1lik.es/'.$autourl['g'];
					}
				}
				else
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
				}
				
				if ($uid=$facebook->getUser())
				{
					if($cf['like'])
					{
						$attachment = array('message' =>$title.' -- อ่านข่าวต่อที่ '.$link.$hash);
					}
					else
					{
						$attachment = array('message' =>$title.' <- อ่านต่อ.. [ไม่ต้องกดไลค์] ได้ที่ '.$link.$hash);
					}
					$delmyimg='/tmp/post'.$cf['delay']['key'].'.jpg';
					copy($img,$delmyimg);
					$attachment['image'] = '@'.$delmyimg;
					echo '<br># กำลังโพสไป fb #<br>'.
					print_r($attachment);
					try
					{
						$facebook->api('/'.$cf['_id'].'/photos', 'post', $attachment);
						
						$db->update('news',array('_id'=>$n['_id']),array('$set'=>array($cf['delay']['key']=>new MongoDate())));
						//$facebook->api('/'.$cf['album'].'/photos', 'post', $attachment);
					}
					catch (FacebookApiException $e)
					{
						echo '<br>'.$e->getMessage().'<br>';
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
			else
			{
			}
		}
		else
		{
			echo '#ไม่เจอแหล่งข่าว#<br>';	
		}
	}
	
	
	if(!$cf['notdel'])
	{
		$page = $facebook->api('/'.$cf['id'].'/feed');
		
		//_::time();
		if(is_array($page)&&is_array($page['data']))
		{
			$p=array();
			for($i=0;$i<count($page['data']);$i++)
			{
				$lk=intval($page['data'][$i]['likes']['count']);
				$sh=intval($page['data'][$i]['shares']['count']);
				$cm=intval($page['data'][$i]['comments']['count']);
				if($lk+$sh+$cm <$cf['delay']['min_score'])
				{
					$t=strtotime($page['data'][$i]['created_time']);
					$ar=array(
											'id'=>$page['data'][$i]['id'],
											'message'=>$page['data'][$i]['message'],
											'likes'=>$lk,
											'shares'=>$sh,
											'comments'=>$cm,
											'create'=>time::show(new MongoDate($t),'datetime'),
											'now'=>time::show(new MongoDate(time()),'datetime'),
										);
										
						if($t+$cf['delay']['delete']<time())
						{
							$ar['status']='สั่งลบไปแล้ว - '.time::show(new MongoDate(time()),'datetime');
							$facebook->api('/'.$page['data'][$i]['id'], 'DELETE');
						}
						else
						{
							$ar['status']='รอลบ - '.time::show(new MongoDate($t+$cf['delay']['delete']),'datetime');
						}
						$p[]=$ar;
				}
			}
		}
		echo '<br><br>ข้อความที่ลบ<br><pre>';
		echo print_r($p);
		echo '</pre>';
	}
}



?>