<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();

//$time=time()-((14+90)*24*3600);
$time=time()-((7)*24*3600);

echo $db->count('line',array(
													//'ty'=>array('$ne'=>'album'),
													'lo'=>array('$exists'=>false),
													'ex'=>array('$lte'=>new MongoDate($time)),
													'da'=>array('$lte'=>new MongoDate(time()-(3600*24*30*6))),
													'dd'=>array('$exists'=>false),
													)
												);
$db->update('line',
									array(
													//'ty'=>array('$ne'=>'album'),
													'lo'=>array('$exists'=>false),
													'ex'=>array('$lte'=>new MongoDate($time)),
													'da'=>array('$lte'=>new MongoDate(time()-(3600*24*30*6))),
													'dd'=>array('$exists'=>false),
									),
									array(
												'$set'=>array(
																			'dd'=>new mongodate(),
																			'ud'=>-9,
														)
									),
									array('multiple'=>true)
						);


//$db->remove('friend',array('$or'=>array(array('u'=>$ban[$i]['_id']),array('p'=>$ban[$i]['_id']))));
//$db->update('user',array(),array('$pull'=>array('ct.ig'=>$ban[$i]['_id'],'ct.bl'=>$ban[$i]['_id'],'ct.bl2'=>$ban[$i]['_id'],'ct.fr'=>$ban[$i]['_id'],'ct.fq'=>$ban[$i]['_id'])),array('multiple'=>true));




?>