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
	
	echo '<br>#ตรวจสอบเวลา#<br>';
	if(intval(date('G'))>=$cf['delay']['start'] || intval(date('G'))<=2)
	{
		echo '#เปิดการทำงานตามเวลา#<br>';
		if($news=$db->find('forum',array('c'=>array('$in'=>array(422,423,424,425,426,427,428)),'dd'=>array('$exists'=>false),'da'=>array('$gte'=>new MongoDate(time()-$cf['delay']['after']))),array('_id'=>1,'t'=>1,'fd'=>1,$cf['delay']['key']=>1,'o'=>1,'s'=>1,'team'=>1),array('sort'=>array('_id'=>1),'limit'=>100)))
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
			//$hash=" \r\n\r\n#BoxZa #Football #ฟุตบอล #ผลบอล";
			$hash=" \r\n\r\n#BoxZa #Football ";
			if($n&&(($first+$cf['delay']['post'])<time()+180))
			{
				$db->update('forum',array('_id'=>$n['_id']),array('$set'=>array($cf['delay']['key']=>new MongoDate())));
				
				$type='football';
				$title = $n['t'];
				$img = 'http://s3.boxza.com/forum/'.$n['fd'].'/'.$n['o']['1'];
				$url = 'http://www.teededball.com/forum/topic/'.$n['_id'];
				$uid='100000795480500';
				
				if(is_array($n['team'])&&count($n['team'])>0)
				{
					if($_team=$db->find('football_team',array('_id'=>array('$in'=>$n['team'])),array('t'=>1,'n'=>1)))
					{
						for($k=0;$k<count($_team);$k++)
						{
							if($te=trim($_team[$k]['t']?$_team[$k]['t']:$_team[$k]['n']));
							{
								$hash.='#'.str_replace(' ','',$te).' ';	
							}
						}
					}
				}
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
						$attachment = array('message' =>$title.' <- อ่านต่อ.. ไม่ต้องกดไลค์. ได้ที่ '.$link.$hash);
					}
					$delmyimg='/tmp/post'.$cf['delay']['key'].'.jpg';
					copy($img,$delmyimg);
					$attachment['image'] = '@'.$delmyimg;
					echo '<br># กำลังโพสไป fb #<br>'.
					print_r($attachment);
					try
					{
						$facebook->api('/'.$cf['_id'].'/photos', 'post', $attachment);
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
				echo '<br># ไม่มีข่าวที่จะโพส - จะทำการโพสกลิตเตอร์แทน#<br>';
				
				if($glitter=$db->find('glitter',array(
																								'dd'=>array('$exists'=>false),
																							//	'$or'=>array(
																						//										array($cf['delay']['key']=>array('$exists'=>false)),
																					//											array($cf['delay']['key']=>array('$gte'=>new MongoDate(time()-(3600*24*3)))),
																						//		),
																								'da'=>array('$gte'=>new MongoDate(time()-(3600*24*14)))
																					),
																					array('_id'=>1,'t'=>1,'fd'=>1,'ty'=>1,$cf['delay']['key']=>1),
																					array('sort'=>array('_id'=>-1),'limit'=>52)))
				{
					shuffle($glitter);
					$n=false;
					$last=time();
					$first=time()-$cf['delay']['after'];
					for($i=0;$i<count($glitter);$i++)
					{
						if(!$glitter[$i][$cf['delay']['key']] || $glitter[$i][$cf['delay']['key']]->sec<time()-(3600*24*3))
						{
							if(!$glitter[$i][$cf['delay']['key']])
							{
								if(!$n)
								{
									$n = $glitter[$i];
									$last=time()-($cf['delay']['after']+1);
								}
							}
							if($glitter[$i][$cf['delay']['key']])
							{
								if($glitter[$i][$cf['delay']['key']]->sec<$last)
								{
									$n = $glitter[$i];
									$last=$glitter[$i][$cf['delay']['key']]->sec;
								}
							}
						}
						if($glitter[$i][$cf['delay']['key']])
						{
							if($glitter[$i][$cf['delay']['key']]->sec>$first)
							{
								$first=$glitter[$i][$cf['delay']['key']]->sec;
							}
						}
					}
					
					if($n&&(($first+$cf['delay']['post'])<time()))
					{
						$db->update('glitter',array('_id'=>$n['_id']),array('$set'=>array($cf['delay']['key']=>new MongoDate())));
						
						$img='http://s3.boxza.com/glitter/'.$n['fd'].'/l.'.$n['ty'];
						if ($uid=$facebook->getUser())
						{
							$attachment = array('message' =>$n['t']);
							$delmyimg='/tmp/post'.$cf['delay']['key'].'.jpg';
							copy($img,$delmyimg);
							$attachment['image'] = '@'.$delmyimg;
							try
							{
								$facebook->api('/'.$cf['_id'].'/photos', 'post', $attachment);
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
				}
			}
		}
		else
		{
			echo '#ไม่เจอแหล่งข่าว#<br>';	
		}
	}
	
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



?>