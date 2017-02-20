<?php

_::$dbclick=2;
//define('HIDE_SIDEBAR',1);
$cache=_::cache();
//_::$meta['google']=array('id'=>'112235668332689047152');

if(!_::$content=$cache->get('ca1',_::$type.'_home'))
{
	//_::time();
	$db=_::db();
	$news=array();
	
	$wt=$db->find('weather',array(),array('_id'=>1,'name'=>1,'zone'=>1,'today'=>1),array('sort'=>array('name'=>1)));
	$weather=array(1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array());
	
	foreach($wt as $v)
	{
		$weather[$v['zone']][]=$v;	
	}
	$template->assign('weather',$weather);
	_::$content=$template->fetch('home');


	$cache->set('ca1',_::$type.'_home',_::$content,false,300);
}
?>