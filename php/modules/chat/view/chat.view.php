<?php

//_::move('http://friend.boxza.com/',true);
//exit;
if(MODULE_LINK=='room')
{
	$arg=array('_id'=>intval(_::$path[0]));
}
else
{
	$arg=array('l'=>_::$path[0]);
}
$arg['dd']=array('$exists'=>false);
$db=_::db();
if(!$room=$db->findone('chatroom',$arg))
{
	_::move('/');
}

if(MODULE_LINK=='room'&&$room['l'])
{
	_::move('/'.$room['l'],true);
}

if($room['_id']<8)
{
	/*
	if(_::$my)
	{
		if(in_array(_::$my['_id'],array(21654,31284,10989,40556,45586,53537,27960)))
		{
			_::move('/banned');
			$room=$db->findone('chatroom',array('_id'=>8));
		}
	}
	*/
	if($room['_id']==7)
	{
		_::move('/lobby');
	}
}

if($room['_id']<=3)
{
	define('EXP_RATE',5);
}
else
{
	define('EXP_RATE',1);
}
define('HIDE_SIDEBAR',1);

_::$meta['title'] = 'ห้อง'.$room['n'].' - chat แชท พูดคุย สนทนา หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย พบปะพูดคุยกับเพื่อนใหม่ๆได้ทีนี่';
_::$meta['description'] = 'ห้อง'.$room['n'].' '.$room['w'].' - chat แชท พูดคุย สนทนา หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย พบปะพูดคุยกับเพื่อนใหม่ๆใน boxza.com';
_::$meta['keywords'] = $room['n'].', chat, แชท, พูดคุย, สนทนา';

if($room['mt'])
{
	if($room['mt']['tt'])
	{
		_::$meta['title']=$room['mt']['tt'];
	}
	if($room['mt']['dc'])
	{
		_::$meta['description']=$room['mt']['dc'];
	}
	if($room['mt']['kw'])
	{
		_::$meta['keywords']=$room['mt']['kw'];
	}
	
}
$template->assign('room',$room);
_::$content=$template->fetch('view');


#	$cache->set('ca1','fb_home',_::$content,false,300);
#}

function getvideokey()
{
	$data=array('_id'=>_::$my['_id'],'ip'=>$_SERVER['REMOTE_ADDR'],'time'=>time());
	$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
	$s = strtr(base64_encode(hash_hmac('sha256', $d, _::$config['chat_key'].$data['_id'], true)), '+/', '-_');
	return $s.'.'.$d;
}
?>