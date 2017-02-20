<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'home' => 'home',
						'league'=>'league',
						'team'=>'team',
						'match'=>'match',
						'news'=>'news',
						'calendar'=>'calendar',
						'score'=>'score',
						'last-match'=>'last-match',
						'analyze'=>'analyze',
						'next-match'=>'next-match',
						'live-score'=>'live-score',
						'live-program'=>'live-program',
						'top-goal'=>'top-goal',
						'highlight'=>'video',
						'forum'=>'forum',
						'online'=>'online',
						'rate'=>'rate',
						'radio'=>'radio',
						'match-updater'=>'match-updater',
						'worldcup'=>'worldcup',
						'apps'=>'apps',
);



$cache=_::cache();
if(!$data=$cache->get('ca1','mobile-football-global'))
{
	$db=_::db();
	$data=array('_team'=>array(),'_score'=>array(),'_sexy'=>array(),'_live'=>0,'_banner'=>array(),'_league'=>array());
	
	$tmp=$db->find('football_team',array(),array('_id'=>1,'_ng'=>1,'t'=>1,'n'=>1,'l'=>1,'fd'=>1,'png'=>1),array('sort'=>array('n'=>1)),false);
	foreach($tmp as $v)
	{
		$v['f']=($v['t']?$v['t']:$v['n']);
		if(!$v['t'])$v['t']=$v['n'];
		$data['_team'][$v['_id']]=$v;
	}
	
	$tmp=$db->find('football_league',array(),array(),array('sort'=>array('so'=>1,'_id'=>1)),false);
	foreach($tmp as $v)
	{
		$data['_league'][$v['_id']]=$v;
	}
	
	$cache->set('ca1','mobile-football-global',$data,false,3600);
}


$_team=$data['_team'];
$_league=$data['_league'];

$template=_::template();
$template->assign('cate',$cate);
$template->assign('_league',$_league);
$template->assign('_team',$data['_team']);


if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.football.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.football.home.php');
}


echo $template->fetch('football');
exit;
?>