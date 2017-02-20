<?php

//_::time();

_::ajax()->register(array('gethome','sethome'),'forum.home');

$db=_::db();

$l=array(311=>'review',321=>'hot-item',331=>'street-fashion',332=>'how-to',333=>'open-box',334=>'fashion',335=>'did-u',336=>'pr-news',337=>'mouth-2-mouth');

$fo=array();
foreach($l as $k=>$v)
{
	if($cate[$k]['l'])
	{
		$in=array('$in'=>$cate[$k]['l']);
	}
	else
	{
		$in=$k;
	}
	$fo[$v]=$cate[$k];
	$fo[$v]['topic']=$db->find('forum',array('c'=>$in,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'c'=>1),array('sort'=>array('_id'=>-1),'limit'=>($k==337?10:10)));
}



$template->assign('fo',$fo);
_::$content=$template->fetch2(FORUM_TPL.'home');




?>