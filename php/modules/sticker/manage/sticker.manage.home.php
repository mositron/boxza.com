<?php

_::ajax()->register(array('newapp','delapp','frominet'));


$template->assign('getapp',getapp());
_::$content=$template->fetch('manage.home');


function getapp($page=1)
{
	_::time();
	$rows = 30;
	$allorder = array('_id'=>'#','p'=>'รูปภาพ','t'=>'คำถาม','s'=>'สถานะ');
	$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
	$all=array('order','by','search','page');
	
	extract(_::split()->get('/manage/',0,$all,$allorder,$allby));
	
	$arg = array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false));
	if(_::$my['_id']==1)
	{
		unset($arg['u']);
	}
	if($search)
	{
		$arg['$or']=array(array('t'=>$q),array('m'=>$q));
	}
	
	$db=_::db();
	if($count=$db->count('sticker',$arg))
	{
		list($pg,$skip)=_::pager()->bootstrap($rows,$count,array($url,'page-'),$page);
		$app=$db->find('sticker',$arg,array(),array('skip'=>$skip,'limit'=>$rows,'sort'=>array($order=>($by=='desc'?-1:1))));
	}
	
	$template=_::template();
	$template->assign(array('app'=>$app,'pager'=>$pg,'count'=>number_format($count),'allby'=>$allby,'allorder'=>$allorder));
	for($i=0;$i<count($all);$i++)if(${$all[$i]}) $template->assign($all[$i],${$all[$i]});
	return $template->fetch('manage.home.list');
}

function newapp($arg)
{
	$db=_::db();
	if(trim($arg['title']))
	{
		if($sticker=$db->insert('sticker',array('uid'=>_::$my['_id'],'do'=>0,'t'=>mb_substr(trim($arg['title']),0,100,'utf-8'),'ty'=>trim($arg['type']))))
		{		
			$fd = _::folder()->fd($sticker);
			$folder = substr($fd,2,2).'/'.substr($fd,4,2);
			$db->update('sticker',array('_id'=>$sticker),array('$set'=>array('fd'=>substr($fd,2,2).'/'.substr($fd,4,2))));
			_::ajax()->redirect('/manage/'.$sticker);
		}
	}
}

function delapp($i)
{
	$db=_::db();
	$arg=array('u'=>_::$my['_id'],'_id'=>intval($i));
	
	if(_::$my['_id']==1)
	{
		unset($arg['u']);
	}
	if($var=$db->findOne('sticker',$arg))
	{
		$db->update('sticker',array('_id'=>$var['_id']),array('$set'=>array('dd'=>new MongoDate())));
		_::upload()->send('s3','sticker-clean',$var['fd']);
	//	_::cache()->delete('social','app-fb-'.md5(trim(strtolower($var['l']))),0);
	}
	_::ajax()->jquery('#getapp','html',getapp());
}

?>