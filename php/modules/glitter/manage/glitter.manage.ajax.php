<?php

function delglitter($i)
{
	$db=_::db();
	
	$arg=array('_id'=>intval($i),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
	if(_::$my['am'])
	{
		unset($arg['u']);
	}
	
	if($glitter=$db->findone('glitter',$arg))
	{
		$db->update('glitter',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
		_::upload()->send('s3','delete','glitter/'.$glitter['fd'].'/s.'.$glitter['ty']);
		_::upload()->send('s3','delete','glitter/'.$glitter['fd'].'/t.'.$glitter['ty']);
		_::upload()->send('s3','delete','glitter/'.$glitter['fd'].'/l.'.$glitter['ty']);
		_::upload()->send('s3','delete','glitter/'.$glitter['fd'].'/glitter.boxza.com-'.$glitter['_id'].'.zip');
		_::cache()->delete('ca1','glitter_home',0);
	}
	_::ajax()->redirect(URL);
}

?>