<?php



$position=array(1=>'เรื่องเด่น',2=>'ข่าวทั่วไป',3=>'การเมือง',4=>'บันเทิง',5=>'หนังใหม่',6=>'กีฬา',7=>'รถยนต์',8=>'ไลฟ์สไตล์﻿');

if(_::$path[0])
{
	if(isset($position[_::$path[0]]))
	{
		$tab=intval(_::$path[0]);
	}
	else
	{
		_::move('/home-news');	
	}
}
else
{
	$tab=1;
}

define('NEWS_TAB',$tab);

if($access)
{
	_::ajax()->register(array('update'),'home-news.home');
}

//_::time();
$db=_::db();

$msg=$db->findone('msg',array('_id'=>'home_news'));

$news=array();
if($slot=$msg['slot'.$tab])	
{
	for($j=0;$j<count($slot);$j++)
	{
		if($slot[$j])
		{
			$news[$j]=$db->findone('news',array('_id'=>intval($slot[$j])),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'url'=>1,'do'=>1,'ds'=>1));
		}
		else
		{
			$news[$j]=false;	
		}
	}
}

$template->assign('msg',$msg);
$template->assign('news',$news);
$template->assign('position',$position);
$template->assign('tab',$tab);
$template->assign('html',_::html());
$template->assign('access',$access);
_::$content=$template->fetch('home-news.home');





?>