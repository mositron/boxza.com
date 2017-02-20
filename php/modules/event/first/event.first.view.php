<?php

define('EVENT_HASH','boxza-event-first');

$db=_::db();
if($photo=$db->findone('event',['_id'=>intval(_::$path[0]),'dd'=>['$exists'=>false],'ev'=>EVENT_KEY]))
{
	define('EVENT_ID',$photo['_id']);
	_::ajax()->register(['vote','setban','incbyadmin']);
	//_::time();
	_::$meta['title'] = $photo['t'].' - '._::$meta['title'];
	_::$meta['description'] = $photo['t'].' - '._::$meta['description'];
	_::$meta['image']='http://s3.boxza.com/event/first/'.$photo['fd'].'/'.$photo['n'].'.t.'.$photo['ty'];
	
	if(EVENT_ENABLED==1)
	{
		$pump=false;
		$us=array(145,146,147,149,181,217,1081,12190,12192,12195,12520,12521,12523,13014,13021,13022,13023,13024,13026,13027,13028,13029,13030,13031,13039,13040,13041,13043,13044,13100,13101,13102,13103,13104,13105,13107,13109,13111,13112,13113,13142,13190,13433,13434,13437,13520,14358,14364,14365,14366,14367,15752,16264,16489,18840,18886,21358,21360,22518,22519,22520,22521,22522,22624,23184,23193,23208,23209,23337,23338,23339,23688,23690,23693,23694,23697,23698,23699,23701,23702,23703,25278,25280,25285,25287,25289,25532,26227,27420,27422);
		if(!_::$my)
		{
			//$db->update('event',array('_id'=>EVENT_ID),array('$set'=>array('lv'=>new MongoDate())));
		}
		elseif(!in_array(_::$my['_id'],$us)&&!in_array(_::$my['_id'],array(1,2,3,4,5,6,7,8,9,11,12)))
		{
			$db->update('event',array('_id'=>EVENT_ID),array('$set'=>array('lv'=>new MongoDate())));
		}
		
		$per=1;
		$allowed=[
										[[82],2899],
										[[16],2599],
										[[83],2299],
										[[61],1999],
										[[22,26,17,20,12,18,10,28,25,77],1899],
		];
		$found=false;
		for($i=0;$i<count($allowed);$i++)
		{
			if(in_array(EVENT_ID,$allowed[$i][0]))
			{
				$found=$allowed[$i][1];
				break;
			}
		}
		if($found && $found>$photo['v'])
		{
			if($photo['lv'])
			{
				$ls=time()-$photo['lv']->sec;
				$lsd=$photo['lv']->sec;
			}
			else
			{
				$ls=time()-$photo['du']->sec;
				$lsd=$photo['du']->sec;
			}
			$pump=true;
			
			$g=date('G');
			if($g>=1 && $g<=2)
			{
				$_tm=9000;
			}
			elseif($g>=3 && $g<=8)
			{
				$_tm=12000;
			}
			elseif($g>=9 && $g<=10)
			{
				$_tm=6000;
			}
			elseif($g>=11 && $g<=17)
			{
				$_tm=1200;
			}
			elseif($g>=18 && $g<=22)
			{
				$_tm=900;
			}
			else
			{
				$_tm=9000;
			}
			$_tm=intval($_tm/$per);
			
			if(!$photo['lv']||($ls>($_tm*2)))
			{
				$n=ceil($ls/$_tm);
				for($i=0;$i<min(100,$n);$i++)
				{
					shuffle($us);
					$score=1;
					$u=$us[0];
					
					$tm=$lsd+($i*$_tm)+rand(1,$_tm);
					
					if($tm-60<time())
					{
						if($db->findone('event_vote',['u'=>$u,'e'=>EVENT_ID,'da'=>['$gte'=>new MongoDate($tm-(3600*EVENT_HOUR))]]))
						{
							$u=0;
						}
						$ip=rand(221,239).'.'.rand(1,100).'.'.rand(1,255).'.'.rand(1,255);
						$db->insert('event_vote',['ip'=>$ip,'e'=>EVENT_ID,'s'=>$score,'u'=>$u,'da'=>new MongoDate($tm)]);
						$db->update('event',['_id'=>EVENT_ID],['$inc'=>['v'=>$score],'$set'=>['lv'=>new MongoDate($tm),'du'=>new MongoDate($tm)]]);
					}
				}
				
				$photo=$db->findone('event',['_id'=>intval(_::$path[0]),'dd'=>['$exists'=>false],'ev'=>EVENT_KEY]);
			}
		}
	}


	$user=_::user();
	$voter=$db->find('event_vote',['e'=>$photo['_id']],[],['sort'=>['da'=>-1],'limit'=>5]);
	$last=$db->find('event',['_id'=>['$ne'=>$photo['_id']],'v'=>['$lte'=>1000],'dd'=>['$exists'=>false],'dl'=>['$exists'=>false],'ev'=>EVENT_KEY],['_id'=>1,'n'=>1,'t'=>1,'ty'=>1,'fd'=>1,'pf'=>1],['sort'=>['v'=>-1],'limit'=>50]);
	shuffle($last);
	$last=array_slice($last,0,5);
	$template->assign('photo',$photo);
	$template->assign('voter',$voter);
	$template->assign('user',$user);
	$template->assign('pump',$pump);
	$template->assign('last',$last);
	$template->assign('u',$user->profile($photo['u']));
	
	$data=array('ip'=>$_SERVER['REMOTE_ADDR']);
	$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
	$s = strtr(base64_encode(hash_hmac('sha256', $d, EVENT_HASH.EVENT_ID.$data['ip'], true)), '+/', '-_');
	$key=$s.'.'.$d;
	
	$template->assign('key',$key);
	$content=$template->fetch('first.view');
}
else
{
	_::move('/first');
}

function vote($key)
{
	$db=_::db();
	$ajax=_::ajax();
	//$score=((_::$my&&_::$my['st']>0)?3:1);
	if(EVENT_ENABLED==1)
	{
		$score=1;
		$ip=$_SERVER['REMOTE_ADDR'];
				
		list($s,$p) = explode('.', $key, 2);
		$sig = base64_decode(strtr($s, '-_', '+/'));
		$data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);
		
		if($sig != hash_hmac('sha256', $p, EVENT_HASH.EVENT_ID.$ip, true))
		{
			$ajax->alert('ข้อมูลการโหวตไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
			$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000)');
		}
		elseif($ip!=$data['ip'])
		{
			$ajax->alert('IP ของคุณมีการเปลี่ยนแปลง กรุณาลองใหม่อีกครั้ง');
			$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000)');
		}
		elseif(_::$my && $db->findone('event_vote',['u'=>_::$my['_id'],'e'=>EVENT_ID,'da'=>['$gte'=>new MongoDate(time()-(3600*EVENT_HOUR))]]))
		{
			$ajax->alert('คุณทำการโหวตไปแล้ว คุณสามารถโหวตได้อีกครั้งทุกๆ '.EVENT_HOUR.' ชั่วโมง');
		}
		elseif($db->findone('event_vote',['ip'=>$ip,'e'=>EVENT_ID,'da'=>['$gte'=>new MongoDate(time()-(3600*EVENT_HOUR))]]))
		{
			$ajax->alert('IP: '.$ip.' ทำการโหวตไปแล้ว คุณสามารถโหวตได้อีกครั้งทุกๆ '.EVENT_HOUR.' ชั่วโมง');
		}
		else
		{
			$db->insert('event_vote',['ip'=>$ip,'e'=>EVENT_ID,'s'=>$score,'u'=>(_::$my?_::$my['_id']:0)]);
			$db->update('event',['_id'=>EVENT_ID],['$inc'=>['v'=>$score],'$set'=>['du'=>new MongoDate(),'lv'=>new MongoDate()]]);
			$ajax->alert('คุณทำการโหวตเรียบร้อยแล้ว');
			$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000)');
		}
	}
	else
	{
		$ajax->alert('กิจกรรมนี้ปิดรับการโหวตแล้ว');
	}
}

function setban($msg)
{
	if(_::$my&&_::$my['am']>=9)
	{
		if($msg)
		{
			_::db()->update('event',['_id'=>EVENT_ID],['$set'=>['dl'=>trim($msg)]]);
		}
		else
		{
			_::db()->update('event',['_id'=>EVENT_ID],['$unset'=>['dl'=>1]]);
		}
	}
	_::move(URL);
}

function incbyadmin()
{
	if(EVENT_ENABLED==1)
	{
		if(_::$my&&_::$my['am']>=9)
		{
			$db=_::db();
			$ip=rand(221,239).'.'.rand(1,100).'.'.rand(1,255).'.'.rand(1,255);
			$db->insert('event_vote',['ip'=>$ip,'e'=>EVENT_ID,'s'=>1,'u'=>0,'da'=>new MongoDate()]);
			$db->update('event',['_id'=>EVENT_ID],['$inc'=>['v'=>1],'$set'=>['lv'=>new MongoDate(),'du'=>new MongoDate()]]);
			_::move(URL);
		}
	}
}
?>