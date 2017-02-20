<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();
$upload=_::upload();


if($ban=$db->find('user',array('st'=>array('$lt'=>0),'dp'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>-1),'limit'=>1000)))
{
	for($i=0;$i<count($ban);$i++)
	{
		$status=intval($ban[$i]['st']);
		echo $ban[$i]['_id'].' - st = '.$ban[$i]['st'].' ('.$status.')<br>';
		
		if($status<=-1)
		{
			$db->update('user',array('_id'=>$ban[$i]['_id']),array('$unset'=>array('ct'=>1,'pet'=>1,'nf'=>1,'op'=>1,'pf'=>1,'ec'=>1,'if.ch'=>1),'$set'=>array('dp'=>new MongoDate())));
			
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
			$db->update('line',array('u'=>$ban[$i]['_id'],'dd'=>array('$exists'=>false)),array('$set'=>array('ud'=>-1,'dd'=>new MongoDate())),array('multiple'=>true));
			$db->update('line',array('p'=>$ban[$i]['_id'],'dd'=>array('$exists'=>false)),array('$set'=>array('ud'=>-1,'dd'=>new MongoDate())),array('multiple'=>true));
			
			// Services
			$db->remove('chat',array('u'=>$ban[$i]['_id']));
			$db->remove('chat',array('p'=>$ban[$i]['_id']));
			
			$db->update('deal',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
			$db->update('video',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
			$db->update('forum',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
					
			$db->remove('notify',array('u'=>$ban[$i]['_id']));
			$db->remove('notify',array('p'=>$ban[$i]['_id']));
							
			$db->update('chatroom',array('u'=>$ban[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())),array('multiple'=>true));
			
			
			$db->remove('point',array('u'=>$ban[$i]['_id']));
			
			
			$q=$upload->send('s1','profile-remove',$ban[$i]['if']['fd']);
			
			echo $ban[$i]['_id'].' - if.fd = '.$ban[$i]['if']['fd'].' - '. $q['status'].' - '.$q['message'].'<br>';
		}
	}
}


//$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
//$db->update('user',array(),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));




?>