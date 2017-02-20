<?php

_::session()->logged();

_::ajax()->register(array('morefriends'));

$template=_::template();
$template->assign('user',_::user());
$template->assign('flast',_::db()->find('friend',array('$or'=>array(array('u'=>_::$my['_id']),array('p'=>_::$my['_id']))),array('_id'=>1,'p'=>1,'u'=>1,'du-'._::$my['_id']=>1),array('sort'=>array('du-'._::$my['_id']=>-1,'da'=>-1),'limit'=>20)));
$template->assign('getfriends',getfriends());
_::$content=$template->fetch('friends');

_::$meta['title'] = 'เพื่อน - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'เพื่อน - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'เพื่อน, สังคมออนไลน์';

function getfriends($start=0)
{
	if(_::$path[0]=='request')
	{
		$list=(array)_::$my['ct']['fq'];
		$p=1;
	}
	else
	{
		$list=(array)_::$my['ct']['fr'];
		$p=0;
	}
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
	return $template->fetch('friends.'.($p?'request':'list'));
}


function morefriends($next=0)
{
	_::ajax()->script('$("#getfriends .next").remove()');
	_::ajax()->jquery('#getfriends','append',getfriends($next));
}
?>