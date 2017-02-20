<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();
$upload=_::upload();


$year1=time()-(365*24*3600);
$year2=time()-(30*24*3600);
$year3=time()-(3*24*3600);

$ban=$db->find('user',array(
															'am'=>array('$exists'=>false),
															'$or'=>array(
															/*
																					array(
																								'st'=>1,
																								'du'=>array(
																														'$lt'=>new mongodate($year1)
																								),
																					),
														*/
																					array(
																								'st'=>0,
																								'du'=>array(
																														'$lt'=>new mongodate($year2)
																								),
																					),
																					array(
																								'st'=>array('$exists'=>false),
																								'du'=>array(
																														'$lt'=>new mongodate($year2)
																								),
																					),
																					array(
																								'du'=>array('$exists'=>false),
																								'da'=>array(
																														'$lt'=>new mongodate($year3)
																								),
																					)
															)
										),
										array(),
										array('limit'=>5000,'sort'=>array('_id'=>1))
								);
//print_r( $ban);

echo count($ban).'<br>';


for($i=0;$i<count($ban);$i++)
{
	$status=intval($ban[$i]['st']);
	echo $ban[$i]['_id'].' - em = '.$ban[$i]['em'].' - add = '.time::show($ban[$i]['da'],'datetime').' - last = '.time::show($ban[$i]['du'],'datetime').' - st = '.$ban[$i]['st'].' ('.$status.')<br>';
	if($status>1||$ban[$i]['am'])
	{
		continue;	
	}
	if(($ban[$i]['st']==1&&$ban[$i]['du']->sec<=$year1)||($ban[$i]['st']==0&&$ban[$i]['du']->sec<=$year2)||(empty($ban[$i]['du'])&&$ban[$i]['da']->sec<=$year2))
	{	
		$db->remove('user',array('_id'=>$ban[$i]['_id']));
		
		// Friends;
		$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
		$db->update('user',array(
			'$or'=>array(
									array('ct.ig'=>$ban[$i]['_id']),
									array('ct.bl'=>$ban[$i]['_id']),
									array('ct.bl2'=>$ban[$i]['_id']),
									array('ct.fr'=>$ban[$i]['_id']),
									array('ct.fq'=>$ban[$i]['_id'])
			)
		),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));
		
		// Lines
		$db->update('line',array('u'=>$ban[$i]['_id'],'dd'=>array('$exists'=>false)),array('$set'=>array('ud'=>-1,'dd'=>$ban[$i]['du'])),array('multiple'=>true));
		$db->update('line',array('p'=>$ban[$i]['_id'],'dd'=>array('$exists'=>false)),array('$set'=>array('ud'=>-1,'dd'=>$ban[$i]['du'])),array('multiple'=>true));
		
		// Services
		$db->remove('chat',array('u'=>$ban[$i]['_id']));
		$db->remove('chat',array('p'=>$ban[$i]['_id']));
		
		$db->update('deal',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>$ban[$i]['du'])),array('multiple'=>true));
		$db->update('video',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>$ban[$i]['du'])),array('multiple'=>true));
		$db->update('forum',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>$ban[$i]['du'])),array('multiple'=>true));
				
		$db->remove('notify',array('u'=>$ban[$i]['_id']));
		$db->remove('notify',array('p'=>$ban[$i]['_id']));
						
		$db->update('chatroom',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>$ban[$i]['du'])),array('multiple'=>true));
		
		
		$db->remove('football_lnw',array('u'=>$ban[$i]['_id']));
		$db->remove('football_game',array('u'=>$ban[$i]['_id']));
		
		$db->update('racing_forum',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
		$db->update('racing_market',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
		
		$db->remove('point',array('u'=>$ban[$i]['_id']));
		
		
		$q=$upload->send('s1','profile-remove',$ban[$i]['if']['fd']);
		
		echo $ban[$i]['_id'].' - if.fd = '.$ban[$i]['if']['fd'].' - '. $q['status'].' - '.$q['message'].'<br>';
	}
	
}
/*
for($i=0;$i<count($user);$i++)
{
	$sc = floor(intval($user[$i]['if']['crank'])/60);
	$db->update('user',array('_id'=>$user[$i]['_id']),array('$set'=>array('if.ch.sc'=>$sc,'if.ch.na'=>$user[$i]['if']['cn'])));
}
echo count($user);
*/

?>