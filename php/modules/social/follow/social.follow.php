<?php

_::session()->logged();

_::ajax()->register(array('morefriends'));

$template=_::template();
$template->assign('flast',_::db()->find('user',array('_id'=>array('$in'=>(array)_::$my['ct']['fl']),'dd'=>array('$exists'=>false)),array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1),array('sort'=>array('du'=>-1,'da'=>-1),'limit'=>20)));
$template->assign('getfriends',getfriends());
_::$content=$template->fetch('follow');

_::$meta['title'] = 'เพื่อน - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'กำลังติดตาม - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'กำลังติดตาม, สังคมออนไลน์';

function getfriends($start=0)
{
	$list=(array)_::$my['ct']['fl'];
	$p=0;
	$per = 50;
	$count = count($list);
	if($start>$count)return'';
	$arg=array('_id'=>array('$in'=>$list),'$or'=>array(array('st'=>array('$gte'=>0)),array('st'=>array('$exists'=>false))));
	if(isset(_::$config['gender'][_::$path[$p]]))
	{
		$arg['if.gd']=_::$path[$p];
	}
	$template=_::template();
	$res=_::db()->find('user',$arg,array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1),array('skip'=>$start,'limit'=>$per));
	$template->assign('friend',$res);
	$template->assign('next', (count($res)==$per?$start+$per:''));
	return $template->fetch('follow.list');
}


function morefriends($next=0)
{
	_::ajax()->script('$("#getfriends .next").remove()');
	_::ajax()->jquery('#getfriends','append',getfriends($next));
}
?>