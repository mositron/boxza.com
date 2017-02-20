<?php
if(!isset($_league[_::$path[1]]))
{
	_::$path[1]=1;
//	_::move('/football');
}
$l=$_league[_::$path[1]];

$db=_::db();


$arg=array('lg'=>intval(_::$path[1]));
if($l['s'])
{
	$arg['sea']=$l['s'];
}

$score=$db->find('football_score',$arg,array(),array('sort'=>array('r'=>1)));

//_::time();
$template->assign('league',array(1=>$_league[1],5=>$_league[5],4=>$_league[4],3=>$_league[3],6=>$_league[6],7=>$_league[7]));
$template->assign('score',$score);
if($l['ty']=='l')
{
	_::$content=$template->fetch('football.score.view.league');
}
else
{
	_::$content=$template->fetch('football.score.view.cup');
}
?>