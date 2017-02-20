<?php
function delvideo($id)
{
	$db=_::db();
	$arg=array('_id'=>intval($id),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
	if(_::$my['am'])
	{
		unset($arg['u']);
	}
	if($video=$db->findone('video',$arg))
	{
		if($video['n'])
		{
			_::upload()->send('s3','delete','video/'.$video['f'].'/'.$video['n']);
		}
		$db->update('video',array('_id'=>intval($id)),array('$set'=>array('dd'=>new MongoDate())));	
		_::tags()->remove('video', $video['_id']);
	}
	_::ajax()->redirect(URL);
}
?>