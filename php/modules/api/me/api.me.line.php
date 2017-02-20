<?php

/*
if(!_::$my || _::$my['_id']>3)
{
	exit;
}
*/

if(_::$path[2]=='post')
{
	require_once(__DIR__.'/api.me.line.post.php');
}
else
{
	$next = 0;
	$func = false;
	
	if(_::$path[2])
	{
		$f = array('hide'=>1,'unhide'=>1,'ignore'=>1,'unignore'=>1);
		$t = explode('-',_::$path[2]);
		if(isset($f[$t[0]])&&is_numeric($t[1]))
		{
			call_user_func_array('line_'.$t[0],array(intval($t[1])));
			$func = true;
		}
	}
			
	if(!$func)
	{
		for($i=2;$i<count(_::$path);$i++)
		{
			if(_::$path[$i])
			{
				$arg = explode('-',_::$path[$i]);
				if($arg[0]=='next' && is_numeric($arg[1]))
				{
					$next = intval($arg[1]);
				}
			}
		}
		$data=_::profile()->line($who,(in_array(_::$path[2],array('hash','list'))?_::$path[2].'-'._::$path[3]:_::$path[2]),$next);
		_::$content[] = array('method'=>'line','type'=>defined('SORT_DC')?'most':'list','data'=>$data);
	}
}

function line_hide($id)
{
	if($id)
	{
		if(_::$my['_id'])
		{
			$db=_::db();
			if($line=$db->findOne('line',array('_id'=>$id),array('hu'=>1)))
			{
				if(!in_array(_::$my['_id'],(array)$line['hu']))
				{
					$db->update('line',array('_id'=>$id),array('$push'=>array('hu'=>_::$my['_id'])));
				}
				_::$content[] = array('method'=>'line','type'=>'hide','data'=>$id);
			}
		}
	}
}
function line_unhide($id)
{
	if($id)
	{
		if(_::$my['_id'])
		{
			$db=_::db();
			if($line=$db->findOne('line',array('_id'=>$id),array('hu'=>1)))
			{
				if(in_array(_::$my['_id'],(array)$line['hu']))
				{
					$db->update('line',array('_id'=>$id),array('$pull'=>array('hu'=>_::$my['_id'])));
				}
				_::$content[] = array('method'=>'line','type'=>'unhide','data'=>$id);
			}
		}
	}
}
function line_ignore($id)
{
	if($id)
	{
		if(_::$my['_id'])
		{
			$db=_::db();
			if($id!=_::$my['_id'])
			{
				if(!in_array($id,(array)_::$my['ct']['ig']))
				{
					_::user()->update(_::$my['_id'],array('$push'=>array('ct.ig'=>$id)));
				}
				_::$content[] = array('method'=>'line','type'=>'ignore','data'=>$id);
			}
		}
	}
}
function line_unignore($id)
{
	if($id)
	{
		if(_::$my['_id'])
		{
			$db=_::db();
			if(in_array($id,(array)_::$my['ct']['ig']))
			{
				_::user()->update(_::$my['_id'],array('$pull'=>array('ct.ig'=>$id)));
			}
			_::$content[] = array('method'=>'line','type'=>'unignore','data'=>$id);
		}
	}
}



?>