<?php

if(_::$my['st']>0)
{
	_::ajax()->register(array('newchat','delchat'));
	$template->assign('getchat',getchat());
}

_::$content=$template->fetch('manage.home');


function getchat($page=1)
{
	//_::time();
	$rows = 40;
	$allorder = array('_id'=>'#','p'=>'รูปภาพ','t'=>'คำถาม','s'=>'สถานะ');
	$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
	$all=array('order','by','search','page');
	
	extract(_::split()->get('/manage/',0,$all,$allorder,$allby));
	
	$arg = array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
	if(_::$my['_id']==1)
	{
		unset($arg['u']);
	}
	
	$db=_::db();
	if($count=$db->count('chatroom',$arg))
	{
		list($pg,$skip)=_::pager()->bootstrap($rows,$count,array($url,'page-'),$page);
		$chat=$db->find('chatroom',$arg,array(),array('skip'=>$skip,'limit'=>$rows,'sort'=>array('_id'=>-1)));
	}
	
	$template=_::template();
	$template->assign(array('chat'=>$chat,'pager'=>$pg,'count'=>number_format($count),'allby'=>$allby,'allorder'=>$allorder));
	for($i=0;$i<count($all);$i++)if(${$all[$i]}) $template->assign($all[$i],${$all[$i]});
	return $template->fetch('manage.home.list');
}

function newchat($arg)
{
	$db=_::db();
	#_::ajax()->alert('ปิดบริการชั่วคราว');
	#return;
	
	
	if(trim($arg['title']))
	{
		$t=mb_substr(trim($arg['title']),0,50,'utf-8');
		if($chat=$db->insert('chatroom',array(
																								'u'=>_::$my['_id'],
																								'n'=>$t,
																								'ip'=>$_SERVER['REMOTE_ADDR'],
																								'w'=>'ยินดีต้อนรับสู่ห้อง '.$t,
																								'am'=>array(_::$my['_id']=>array('lv'=>3,'ds'=>time())),
																								'bg'=>array(
																																'al'=>array('cl'=>'#2B2728','bg'=>''),
																																'pn'=>100,
																																'pc'=>100,
																																'snd'=>1,
																																'one'=>1,
																																'col'=>0,
																								)
																								)))
		{
			_::ajax()->redirect('/manage/'.$chat);
		}
	}
}

function delchat($i)
{
	$db=_::db();
	$arg=array('u'=>_::$my['_id'],'_id'=>intval($i));
	
	if(_::$my['_id']==1)
	{
		unset($arg['u']);
	}
	if($var=$db->findOne('chatroom',$arg))
	{
		$db->update('chatroom',array('_id'=>$var['_id']),array('$set'=>array('dd'=>new MongoDate())));
		_::cache()->delete('ca2','chatroom_data_'.$var['_id'],0);	
		//_::cache()->delete('social',FBAPP_PREFIX.'_view_'.md5(trim(strtolower($var['l']))),0);
	}
	_::ajax()->jquery('#getchat','html',getchat());
}
?>