<?php

function delpoem($i)
{
	$db=_::db();
	
	$arg=array('_id'=>intval($i),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
	if(_::$my['am'])
	{
		unset($arg['u']);
	}
	
	if($poem=$db->findone('poem',$arg))
	{
		$db->update('poem',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
		_::upload()->send('s3','delete','poem/'.$poem['fd'].'/s.'.$poem['ty']);
		_::upload()->send('s3','delete','poem/'.$poem['fd'].'/t.'.$poem['ty']);
		_::upload()->send('s3','delete','poem/'.$poem['fd'].'/l.'.$poem['ty']);
		_::upload()->send('s3','delete','poem/'.$poem['fd'].'/poem.boxza.com-'.$poem['_id'].'.zip');
		_::cache()->delete('ca1','poem_home',0);
	}
	_::ajax()->redirect(URL);
}

?>