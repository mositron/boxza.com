<?php


class sidebar
{
	public function __construct()
	{
		
	}
	public function service($arg=false)
	{
		$key='service-sidebar';
		if(!$arg)
		{
			$arg=array();
		}
		else
		{
			$key.= ('-'.implode('-',array_keys($arg)).'-'.implode('-',array_values($arg)));
		}
		$cache=_::cache();
		if(!$content=$cache->get('ca1',$key))
		{
			_::time();
			$db=_::db();
			$template=_::template();
			
			if(!isset($arg['movie']) || $arg['movie'])
			{
				$tm = strtotime(date('Y-m-d'))+(3600*24*14);
				$movie=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'v'=>1,'t2'=>1,'tm'=>1,'d'=>1),array('sort'=>array('cs'=>-1,'tm'=>-1),'limit'=>12));
				shuffle($movie);
				$movie=array_slice(array_values($movie),0,1);
				$template->assign('movie',$movie[0]);
			}
			if(!isset($arg['game']) || $arg['game'])
			{
				$game=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>48));
				shuffle($game);
				$game=array_slice(array_values($game),0,2);
				$template->assign('game',$game);
			}
			if(!isset($arg['sexy']) || $arg['sexy'])
			{
				$sexy=$db->find('forum',array('c'=>array('$in'=>array(38,412,413,414,415,416,417,418,419,420)),'dd'=>array('$exists'=>false),'s'=>array('$ne'=>''),'fd'=>array('$ne'=>''),'rc'=>1),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'limit'=>30));
				shuffle($sexy);
				$sexy=array_slice(array_values($sexy),0,3);
				$template->assign('sexy',$sexy);
			}
						
			$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
			$template->assign('lotto',$lotto[0]);
			
			$template->assign('about',$db->find('about',array('pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'lk'=>1),array('sort'=>array('du'=>-1),'limit'=>10)));
			$content=$template->fetch2('social.line.service');
			if(_::$config['domain']=='boxza.com')
			{
				$data='<!DOCTYPE HTML><html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#"><head><meta charset="UTF-8"><title>บริการต่างๆภายใน boxza.com</title><link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/boxza.css"><style>body{background:#fff;}.mn-global h4{margin:0px -5px}</style></head><body>'.$content.'<script type="text/javascript"> __th_page="iframe-service";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></body></html>';
				_::folder()->save('chat/_html/service.html',$data);
			}
			$cache->set('ca1',$key,$content,false,300);
		}
		return $content;
	}

}
?>