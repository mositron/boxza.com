<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();

# notify
$db->remove('notify',array(
																	'$or'=>array(
																									array('ty'=>array('$ne'=>'friend'),'dr'=>array('$exists'=>true)),
																									array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*7))))
																						)
														)
								);

$db->remove('game_lottery_answer',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*3)))));
$db->remove('game_namtoa',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*3)))));
$db->remove('game_slave',array('fn'=>1,'da'=>array('$lte'=>new MongoDate(time()-(3600*24*3)))));
$db->remove('chat_thief',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*3)))));

$db->remove('lionica_drop',array('da'=>array('$lte'=>new MongoDate(time()-(3600*3)))));

$db->remove('football_game',array('fn'=>array('$exists'=>true),'fnd'=>array('$lte'=>new MongoDate(time()-(3600*30)))));


$db->remove('point',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*3)))));


$db->remove('gift',array('ex'=>array('$lte'=>new MongoDate(time()-(3600*24*7)))));

$db->remove('user_thank',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*15)))));



$db->remove('chat_online',array('m'=>array('$ne'=>date('n'))));

$db->remove('msn',array('dd'=>array('$lte'=>new MongoDate(time()-(3600*24*90)))));
$db->remove('deal',array('dd'=>array('$lte'=>new MongoDate(time()-(3600*24*90)))));

						
echo '<br><br>line delete='.$db->count('line',array('dd'=>array('$exists'=>true,'$lte'=>new MongoDate(time()-(3600*24*90))))).',<br><br>';
$db->remove('line',array('dd'=>array('$exists'=>true,'$lte'=>new MongoDate(time()-(3600*24*90)))));

/*
$db->remove('line',array('ty'=>'signup','dd'=>array('$exists'=>true)));
echo $db->remove('line',array('pt'=>array('$exists'=>false),'dd'=>array('$exists'=>true,'$lte'=>new MongoDate(time()-(3600*24*30)))));
echo '---<br><br>';
*/
/*
{
'dd':{$exists:true},
'pt':{$exists:false}	
}
*/


//'ty':{'$nin':['friend']},'dr':{$exists:true}


#appfb_play 
#$db->remove('appfb_play',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*15)))));
/*
if($app=$db->find('appfb',array('dd'=>array('$exists'=>true))))
{
	for($i=0;$i<count($app);$i++)
	{
		$db->remove('appfb_answer',array('a'=>$app[$i]['_id']));
		$db->remove('appfb',array('_id'=>$app[$i]['_id']));
		if($app[$i]['fd'] && mb_strlen($app[$i]['fd'],'utf-8')==5)
		{
			exec('rm -fR '.FILES.'appfb/'.$app[$i]['fd']);
			//echo 'rm -fR '.FILES.'appfb/'.$app[$i]['fd'].'<br>';
		}
		
	}
}
*/


$lt7=new MongoDate(time()-(3600*24*7));
if($room=$db->find('chatroom',array('u'=>array('$nin'=>array(1,43416)),'dd'=>array('$exists'=>false),'$or'=>array(array('du'=>array('$exists'=>false)),array('du'=>array('$lt'=>$lt7))),'da'=>array('$lt'=>$lt7)),array(),array('sort'=>array('_id'=>-1))))
{
	for($i=0;$i<count($room);$i++)
	{
		echo 'http://chat.boxza.com/room/'.$room[$i]['_id'].' - '.time::show($room[$i]['da'],'datetime').' - '.time::show($room[$i]['du'],'datetime').'<br>';
		$db->update('chatroom',array('_id'=>$room[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())));
	}
}



//$db->remove('line',array('ty'=>'point'));

echo 'chat = '.$db->count('chat',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*3))))).' -<br>';
$db->remove('chat',array('c-p'=>array('$exists'=>true),'c-u'=>array('$exists'=>true)));
$db->remove('chat',array('da'=>array('$lte'=>new MongoDate(time()-(3600*24*3)))));


//$db->remove('event_vote',array('u'=>0));

if($friend=$db->find('friend',array('$or'=>array(
																												array('ac'=>array('$exists'=>false),'da'=>array('$lte'=>new MongoDate(time()-(3600*24*30)))),
																												array('dd'=>array('$exists'=>true),'dd'=>array('$lte'=>new MongoDate(time()-(3600*24*30)))),	
																											)
																	),
																	array(),
																	array('limit'=>1000)
											)
)
{
	$user=_::user();
	echo '<pre>';
	for($i=0;$i<count($friend);$i++)
	{
		$u=$friend[$i]['u'];
		$p=$friend[$i]['p'];


		$user->update($u,array('$pull'=>array('ct.fq'=>$p)));
		$user->update($p,array('$pull'=>array('ct.fq'=>$u)));
		$db->remove('friend',array('_id'=>$friend[$i]['_id']));
	
		//print_r($friend[$i]);
	}
}
?>