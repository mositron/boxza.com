<?php
define('HIDE_SIDEBAR',1);

if(!is_numeric(_::$path[0]))
{
	_::move('/',true);	
}

_::ajax()->register(array('playapp'));

$db=_::db();
if(!$app=$db->findOne('guess',array('_id'=>intval(_::$path[0]),'pl'=>1,'dd'=>array('$exists'=>false))))
{
	_::move('/',true);
}

$quest=array();
$ans=array();

shuffle($app['quest']);

_::$meta['title'] = $app['t'].' - เกมทายใจ เกมส์วัดดวง เกมเฟสบุ๊ค faceook';
_::$meta['description'] = $app['d'].' - สร้าง Application บน Facebook ง่ายๆ ฟรี!';
_::$meta['image']='http://s3.boxza.com/guess/'.$app['fd'].'/m.jpg';
		
$template=_::template();
$template->assign('app',$app);

$poster=_::user()->profile($app['u']);
if($poster['google'])
{
	_::$meta['google']=$poster['google'];
}
$template->assign('user',$poster);

_::$content=$template->fetch('game');


function playapp($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$play=false;
	$k=date('Y-m-d');
	if($q=$db->findOne('guess',array('_id'=>intval(_::$path[0]),'pl'=>1)))
	{
		/*
		if(date('m')==12)
		{
			if($q['do']>=1000 && !$q['box'])
			{
				$db->update('guess',array('_id'=>$q['_id']),array('$set'=>array('box'=>1)));
				_::point()->action($q['u'],1000,'point','ได้รับ 1,000บ๊อก จากเกมทายใจที่มีผู้เล่นเกิน 1,000ครั้ง - '.URI);
			}
		}
		*/
		$ans=array();
		for($i=0;$i<count($q['quest']);$i++)
		{
			$v=strval($arg['ans'.$i]);	
			if($v!='')
			{
				$v=intval($v);
				if(!isset($ans[$v]))
				{
					$ans[$v]=0;
				}
				$ans[$v]++;
			}
		}
		arsort($ans);
		$k=array_keys($ans);
		$rs=$k[0];
		$fb=array(
							'message'=>$q['t'],
							'name'=>$q['ans'][$rs]['t'],
							'caption'=>$q['t'],
							'link'=>'http://guess.boxza.com/game/'.$q['_id'],
							'picture'=>'http://s3.boxza.com/guess/'.$q['fd'].'/s.jpg',
							'description'=>$q['ans'][$rs]['d'],
							'actions'=>array(array('name'=>'เกมทายใจ+ for Android','link'=>'https://play.google.com/store/apps/details?id=com.doodroid.guess'))
		);
		if($q['ans'][$rs]['i'])
		{
			$fb['picture']='http://s3.boxza.com/guess/'.$q['fd'].'/'.$q['ans'][$rs]['i'];
		}
		$ajax->script('showresult('.json_encode($fb).')');

		$u=$arg['uid'];
		
		$num=5;
		if($pa=$db->findOne('guess_play',array('a'=>$q['_id'],'k'=>$k)))
		{
			if(!in_array($u,(array)$pa['p']))
			{
				$num=10;
				$db->update('guess_play',array('_id'=>$pa['_id']),array('$push'=>array('p'=>$u),'$set'=>array('c'=>intval($pa['c'])+1)));
				$db->update('guess',array('_id'=>$q['_id']),array('$set'=>array('do'=>intval($q['do'])+1)));
			}
		}
		else
		{
			$num=10;
			$db->insert('guess_play',array('a'=>$q['_id'],'k'=>$k,'p'=>array($u),'c'=>1));
			$db->update('guess',array('_id'=>$q['_id']),array('$set'=>array('do'=>intval($q['do'])+1)));
		}
		
		if(_::$my)
		{
			$cache=_::cache();
			$time=microtime(true);
			$al=array(
										'ty'=>'game',
										'u'=>-1,
										'_id'=>$time,
										'_sn'=>str_replace('.','_',strval($time)),
										't'=>date('H:i',$time),
										'p'=>'',
										'm'=>'เล่นเกมทายใจ "<a href="http://guess.boxza.com/game/'.$q['_id'].'" target="_blank">'.$q['t'].'</a> ได้ผลลัพธ์คือ... <strong>'.$q['ans'][$rs]['t'].'</strong><br> (อัพเดท: เกมทายใจไหนมีผู้เล่นเกิน 1,000คน เจ้าของเกมรับไปเลย 1,000บ็อก ภายในสิ้นเดือนนี้)',
										'mb'=>1,
										'c'=>16,
										'n'=>_::$my['cname'],
										'l'=>'/'._::$my['link'],
										'i'=>_::$my['img'],
										'am'=>1,
										'ip'=>$_SERVER['REMOTE_ADDR'],
										'rk'=>rand(1,5),
										'vid'=>'',
									);
			$c = $db->find('chatroom',array('dd'=>array('$exists'=>false),'du'=>array('$gte'=>new MongoDate(time()-600))),array('_id'=>1),array('sort'=>array('cu'=>-1),'limit'=>$num),false);
			foreach($c as $v)
			{
				$key='chatroom_data_'.$v['_id'];
				if($data=$cache->get('ca2',$key))
				{
					if(is_array($data['text']))
					{
						array_push($data['text'],$al);
						$cache->set('ca2',$key,$data,false,3600*24*7);
					}
				}
			}
		}
		
		if($_setans)
		{
			$db->update('guess_play',array('a'=>$q['_id'],'k'=>$k),array('$set'=>array('o.'.$u=>$_setans)));
		}
	}
}

?>