<?php
function digdeal($i)
{
	$db=_::db();
	if($deal=$db->findone('deal',array('_id'=>intval($i),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false))))
	{
		$ds = date('Y-m-d',$deal['ds']->sec);
		if($ds != date('Y-m-d'))
		{
			$db->update('deal',array('_id'=>intval($i)),array('$set'=>array('ds'=>new MongoDate())));
			_::cache()->delete('ca1','deal_home',0);
			_::ajax()->redirect(URL);
		}
		else
		{
			_::ajax()->alert('สามารถดันประกาศได้วันละครั้งเท่านั้น');
		}
	}
}
function deldeal($i)
{
	$db=_::db();
	$arg=array('_id'=>intval($i),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
	if(_::$my['am']>5)
	{
		unset($arg['u']);
	}
	if($deal=$db->findone('deal',$arg))
	{
		$db->update('deal',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
		_::cache()->delete('ca1','deal_home',0);
		
		_::upload()->send('s3','delete','deal/'.$deal['fd'].'/s.jpg');
		_::upload()->send('s3','delete','deal/'.$deal['fd'].'/m.jpg');
		for($i=1;$i<=5;$i++)
		{
			if($deal['o'.$i])
			{
				_::upload()->send('s3','delete','deal/'.$deal['fd'].'/'.$deal['o'.$i]);
			}
		}
		if($d = $db->findone('deal_province',array('_id'=>intval($deal['pr']))))
		{
			if($d['c'])
			{
				$c = max(0,intval($d['c'])-1);
				$db->update('deal_province',array('_id'=>intval($deal['pr'])),array('$set'=>array('c'=>$c)));
			}
		}
			
	}
	_::ajax()->redirect(URL);
}

function addtab($fp)
{
	$db=_::db();
	$ajax=_::ajax();
}
?>