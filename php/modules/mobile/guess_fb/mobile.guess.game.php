<?php
define('HIDE_SIDEBAR',1);

if(!is_numeric(_::$path[1]))
{
	_::move('/guess',true);	
}

_::ajax()->register(array('playapp'));

$db=_::db();
if(!$app=$db->findOne('guess',array('_id'=>intval(_::$path[1]),'pl'=>1,'dd'=>array('$exists'=>false))))
{
	_::move('/guess',true);
}

$quest=array();
$ans=array();

shuffle($app['quest']);

$template=_::template();


$template->assign('parent',$_GET['parent']?$_GET['parent']:'/guess/recent');

$template->assign('app',$app);

$poster=_::user()->profile($app['u']);

$template->assign('user',$poster);
$template->assign('apps',$db->find('guess',array('_id'=>array('$ne'=>$app['_id']),'u'=>$app['u'],'pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1,'limit'=>10))));

_::$content=$template->fetch('guess.game');


function playapp($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$play=false;
	$k=date('Y-m-d');
	if($q=$db->findOne('guess',array('_id'=>intval(_::$path[1]),'pl'=>1)))
	{
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
							'message'=>$q['t'].' (via Android)',
							'name'=>$q['ans'][$rs]['t'],
							'caption'=>$q['t'],
							'link'=>'https://play.google.com/store/apps/details?id=com.doodroid.guess',//'http://guess.boxza.com/game/'.$q['_id'],
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
		/*
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
										'm'=>'เล่นเกมทายใจ "<a href="http://guess.boxza.com/game/'.$q['_id'].'" target="_blank">'.$q['t'].'</a> ได้ผลลัพธ์คือ... <strong>'.$q['ans'][$rs]['t'].'</strong>',
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
		*/
		if($_setans)
		{
			$db->update('guess_play',array('a'=>$q['_id'],'k'=>$k),array('$set'=>array('o.'.$u=>$_setans)));
		}
	}
}

?>