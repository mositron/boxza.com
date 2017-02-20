<?php

if($b=$_GET['__b'])
{
	$data=json_decode(base64_decode(strtr($b,'-_','+/')),true);
	//print_r($data);
	//exit;
	if($data['i'])
	{
		$bot=is_bot();
		if($bot&&$data['l'])
		{
				_::move($data['l'],false);
		}
		$db=_::db();
		if($banner=$db->findone('banner',array('_id'=>intval($data['i']),'pl'=>1,'dd'=>array('$exists'=>false))))
		{
			if(!$bot)
			{
				$db->update('banner',array('_id'=>$banner['_id']),array('$inc'=>array('do'=>1)));
				$db->insert('banner_click',array('b'=>$banner['_id'],'kd'=>date('Y-m-d'),'km'=>date('Y-m'),'p'=>strval($data['p']),'s'=>strval($data['s']),'ip'=>$_SERVER['REMOTE_ADDR'],'ua'=>$_SERVER['HTTP_USER_AGENT']));
			}
			if($banner['l'])
			{
				_::move($banner['l'],false);
			}
			else
			{
				_::move('http://boxza.com/?__error=invalid-ads-link',true);
			}
		}
		else
		{
			_::move('http://boxza.com/?__error=invalid-ads-public',true);
		}
	}
	else
	{
		_::move('http://boxza.com/?__error=invalid-ads-id',true);
	}
}



?>