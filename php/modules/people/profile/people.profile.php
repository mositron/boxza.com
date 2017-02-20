<?php

define('HIDE_SIDEBAR',1);

$db=_::db();

$byid=false;
if(is_numeric(_::$path[0]))
{
	$arg=array('_id'=>intval(_::$path[0]));	
	$byid=true;
}
else
{
	$arg=array('lk'=>_::$path[0]);
}
$arg['pl']=1;
$arg['dd']=array('$exists'=>false);
if(!$people=$db->findone('people',$arg))
{
	_::move('/');
}

if($byid&&$people['lk'])
{
	_::move('/'.$people['lk'],true);	
}
if($people['n'])
{
	//$name=$people['n'].' ('.($people['nn']?$people['nn'].' ':'').$people['fn'].' '.$people['ln'].')';
	$name=$people['n'];
}
elseif($people['nn'])
{
	$name=$people['nn'].' '.$people['fn'].' '.$people['ln'];
}
else
{
	$name=$people['fn'].' '.$people['ln'];
}
$fname=trim($people['nn'].' '.$people['fn'].' '.$people['ln']);
_::$meta['title']=$name.' ประวัติ'.$fname.'  Instagram'.$fname.' - '._::$meta['title'];
_::$meta['description']=$name.' ประวัติ'.$fname.'  Instagram'.$fname.' - '._::$meta['description'];
_::$meta['image']='http://s3.boxza.com/people/'.$people['fd'].'/t.jpg';

//_::time();


$template->assign('name',$name);
$template->assign('fname',$fname);
$template->assign('people',$people);
$template->assign('news',$db->find('news',array('people'=>$people['_id'],'pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'c'=>1,'cs'=>1,'t'=>1,'fd'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1,'limit'=>10))));


$user=_::user()->profile($people['u']);
if($user['google'])
{
	_::$meta['google']=$user['google'];
}
$template->assign('user',$user);

_::$content=$template->fetch('profile');
?>