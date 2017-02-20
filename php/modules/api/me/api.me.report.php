<?php

if(_::$my)
{
	$lid=intval(_::$path[2]);
	$reason=intval(_::$path[3]);
	if($lid&&$reason)
	{
		if($reason<1||$reason>7)return;
		$db=_::db();
		if($line=$db->findOne('line',array('_id'=>$lid,'dd'=>array('$exists'=>false))))
		{
			if(!is_array($line['sp']))
			{
				$line['sp']=array('u'=>array(),'c'=>0);
			}
			if(!in_array(_::$my['_id'],(array)$line['sp']['u']))
			{
				$db->update('line',array('_id'=>$line['_id']),array('$inc'=>array('sp.c'=>1),'$push'=>array('sp.u'=>_::$my['_id'],'sp.r'=>$reason),'$set'=>array('sp.ds'=>new MongoDate())));
				if($c=$db->findOne('notify',array('p'=>$line['u'],'rl'=>$line['_id'],'ty'=>'spam'),array('_id'=>1,'dr'=>1)))
				{
					$db->remove('notify',array('_id'=>$c['_id']));
				}
				_::notify()->insert($line['u'],'spam',$line['_id']);
			}
			_::$content[] = array('method'=>'line','type'=>'report','data'=>'success');
		}
		else
		{
			_::$content[] = array('method'=>'line','type'=>'report','data'=>'error');
		}
	}
	else
	{
		_::$content[] = array('method'=>'line','type'=>'report','data'=>'error');
	}
}
else
{
	_::$content[] = array('method'=>'line','type'=>'report','data'=>'error');
}
?>