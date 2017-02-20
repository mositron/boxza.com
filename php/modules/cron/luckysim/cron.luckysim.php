<?php
$db = _::db();


if($e = $db->find('horo_phone',array(),array('_id'=>1,'du'=>1),array('sort'=>array('du'=>1),'limit'=>1)))
{
	$data = json_decode(file_get_contents('http://www.luckysim.com/api.php?'.$e[0]['_id']),true);
	if($data['status']=='OK')
	{
		$db->update('horo_phone',array('_id'=>$e[0]['_id']),array('$set'=>array('mb'=>$data['data'],'du'=>new MongoDate())));
	}
	
	print_r($e);
	print_r($data);
}
?>