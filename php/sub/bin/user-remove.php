<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();
$upload=_::upload();


$ban=$db->find('user',array(
															'am'=>array('$exists'=>false),
															'if.fn'=>'ณัฏฐินี',
															'if.ln'=>'รอดมณี',
															'st'=>array('$ne'=>-1)
										),
										array(),
										array('limit'=>5000,'sort'=>array('_id'=>1))
								);
//print_r( $ban);

echo count($ban).'<br>';


for($i=0;$i<count($ban);$i++)
{
	_::user()->update($ban[$i]['_id'],array('$set'=>array('st'=>-1)));
	$db->update('line',array('u'=>$ban[$i]['_id']),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
	$db->update('line',array('p'=>$ban[$i]['_id']),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
	
	
	$db->update('chat',array('u'=>$ban[$i]['_id']),array('$set'=>array('c-p'=>new MongoDate(),'c-u'=>new MongoDate())),array('multiple'=>true));
	$db->update('chat',array('p'=>$ban[$i]['_id']),array('$set'=>array('c-p'=>new MongoDate(),'c-u'=>new MongoDate())),array('multiple'=>true));
	
	$db->update('deal',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
	$db->update('video',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
	$db->update('forum',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
			
	$db->remove('notify',array('u'=>$ban[$i]['_id']));
	$db->remove('notify',array('p'=>$ban[$i]['_id']));
					
	$db->update('chatroom',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));

	$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
	
	
	$db->remove('football_lnw',array('u'=>$ban[$i]['_id']));
	$db->remove('football_game',array('u'=>$ban[$i]['_id']));
	
	$db->update('racing_forum',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
	$db->update('racing_market',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));

	$db->update('user',array(),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));
}


?>