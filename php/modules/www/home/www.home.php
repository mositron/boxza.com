<?php
_::$meta['title'] = 'BoxZa ข่าว เกมส์ ตรวจหวย ดูดวง เพลง หนัง รูปภาพ ฝากรูป ผลบอล ดูหนังออนไลน์ วิดีโอ เนื้อเพลง ดูดวง เกมส์ กลิตเตอร์ ลงประกาศฟรี  หาเพื่อน ผู้หญิง เลสเบี้ยน เกย์';
_::$meta['description'] = 'BoxZa สังคมออนไลน์ของคนไทยเต็มรูปแบบ พร้อมบริการ ข่าว เกมส์ อัลบั้ม รูปภาพ วิดีโอ หาเพื่อน ดูหนังออนไลน์ ลงประกาศฟรี และอื่นๆอีกมากมาย';
_::$meta['keywords'] = 'boxza, ข่าว, ตรวจหวย, ดูดวง, เกมส์, เพลง, หนัง, รูปภาพ, ดูหนังออนไลน์, วิดีโอ, เนื้อเพลง, ดูดวง, เกมส์, กลิตเตอร์, ลงประกาศฟรี, ตรวจหวย, หาเพื่อน, ผู้หญิง, เลสเบี้ยน, เกย์, ฝากรูป, ผลบอล, ข่าวฟุตบอล, ผลบอลสด, วิเคราะห์บอล';

$cache=_::cache();
if(!_::$content=$cache->get('ca1','home'))
{
	_::time();
	$db=_::db();
	
	$template=_::template();
	
	# profile
	$profile = $db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>12));
	# album
	//$album = $db->find('line',array('in'=>0,'ty'=>'album','rc.ab'=>array('$exists'=>true,'$gte'=>1),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'cm.c'=>1,'pt'=>1),array('sort'=>array('rc.ab'=>1),'limit'=>16));
	# video
	$video_rec=$db->find('video',array('dd'=>array('$exists'=>false),'rc'=>array('$gt'=>0)),array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'c'=>1,'cs'=>1,'n'=>1,'dr'=>1,'yt'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>21));
	# Line 
	#$line=_::profile()->line(array('uid'=>NULL),'all');
	# Movie
	$tm = strtotime(date('Y-m-d'));
	
	$movie_rc=$db->findone('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'rc'=>1));
	$movie_show=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'d'=>1),array('sort'=>array('cs'=>-1,'tm'=>-1),'limit'=>4));
	$movie_soon=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$gt'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1,'d'=>1),array('sort'=>array('cs'=>-1,'tm'=>1),'limit'=>3));
	
	# Friend
	$friend_type=array('girl'=>'หญิง','boy'=>'ชาย','lesbian'=>'เลสเบี้ยน','gay'=>'เกย์','ladyboy'=>'สาวประเภทสอง');
	$friend_rec=$db->find('msn_rec',array('dd'=>array('$exists'=>false),'fd'=>array('$exists'=>true)),array(),array('sort'=>array('_id'=>-1),'limit'=>12),false);
	
	$province = require(HANDLERS.'boxza/province.php');
	
	#lotto
	$lotto_last=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$lotto_all=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'tm'=>1),array('sort'=>array('tm'=>-1),'limit'=>12));
	
	#news
	/*
	
	$news_pos=array(1=>'เรื่องเด่น',2=>'ข่าวทั่วไป',3=>'การเมือง',4=>'บันเทิง',5=>'หนังใหม่',6=>'กีฬา',7=>'รถยนต์',8=>'ไลฟ์สไตล์﻿');
	$msg=$db->findone('msg',array('_id'=>'home_news'));
	
	$news=array();
	$notin=array();
	foreach($news_pos as $tab=>$name)
	{
		$news[$tab]=array();
		if($slot=$msg['slot'.$tab])	
		{
			for($j=0;$j<count($slot);$j++)
			{
				if($slot[$j])
				{
					$news[$tab][$j]=$db->findone('news',array('_id'=>intval($slot[$j])),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'url'=>1));
					if($tab==1)
					{
						$notin[]=intval($slot[$j]);
					}
				}
				else
				{
					$news[$tab][$j]=false;	
				}
			}
		}
	}
	*/
	
	#news
//	$honews=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'ho'=>1,'c'=>array('$ne'=>8)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>1));
	$news=array(0=>$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'rc'=>array('$gt'=>0),'c'=>array('$ne'=>8)),array('_id'=>1,'t'=>1,'fd'=>1,'rc'=>1,'da'=>1,'c'=>1,'cs'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>29)));
	$notin=array();
	//
//	$news_pos=array(1=>'เรื่องเด่น',2=>'ข่าวทั่วไป',3=>'การเมือง',4=>'บันเทิง',5=>'หนังใหม่',6=>'กีฬา',7=>'รถยนต์',8=>'ไลฟ์สไตล์﻿');
	foreach(array(1=>10,2=>9,3=>4,4=>5,5=>11,6=>12,7=>6) as $k=>$v)
	{
		$news[$k]=$db->find('news',array('c'=>$v,'pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>11));
	}
	
	foreach($news as $k=>$k2)
	{
		foreach($k2 as $v)
		{
			$notin[]=$v['_id'];
		}
	}
	$newshot=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'rc'=>array('$gt'=>0),'_id'=>array('$nin'=>$notin)),array('_id'=>1,'t'=>1,'fd'=>1,'rc'=>1,'da'=>1,'c'=>1,'cs'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>8));
	

	$ent=array();
	$ent['hit']=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'$or'=>array(array('c'=>4,'cs'=>array('$in'=>array(2,3,7))),array('c'=>5))),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>8));
	$ent['hot']=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>array('$in'=>array(1))),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>6));
	$ent['inter']=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>4,'cs'=>array('$in'=>array(5,6))),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>3));
	
	#game
	$game=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('do'=>-1,'_id'=>-1),'limit'=>48));
	shuffle($game);
	$game=array_slice(array_values($game),0,12);
	#glitter
	$glitter=$db->find('glitter',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'ty'=>1),array('sort'=>array('rc'=>-1,'_id'=>-1),'limit'=>9));
	
	#football
	$football=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'c'=>11),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'limit'=>19));
	//$football=$db->find('forum',array('c'=>array('$in'=>array(421,422,423,424,425,426,427,428)),'dd'=>array('$exists'=>false)),array('_id'=>1,'fd'=>1,'t'=>1,'c'=>1,'sv'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>19));
	
	#beauty
	$beauty=$db->find('forum',array('c'=>array('$gte'=>301,'$lte'=>399),'ho'=>array('$exists'=>true),'dd'=>array('$exists'=>false),'$and'=>array(array('s'=>array('$exists'=>true)),array('s'=>array('$ne'=>'')))),array('_id'=>1,'fd'=>1,'t'=>1,'c'=>1,'sv'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>11));
	
	$picpost=$db->find('forum',array('c'=>array('$in'=>array(38,412,413,414,415,416,417,418,419,420)),'dd'=>array('$exists'=>false),'s'=>array('$ne'=>''),'fd'=>array('$ne'=>''),'rc'=>1),array('_id'=>1,'t'=>1,'fd'=>1,'sv'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>13));
	
	
	
	$market=$db->find('deal',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('ds'=>-1),'limit'=>15));
	
	
	$forum=array('link'=>array(),'cate'=>array(),'topic'=>array());
	$tmp=$db->find('forum_cate',array('$or'=>array(array('s'=>array('$exists'=>false)),array('s'=>array('$in'=>array('game'))))),array(),array('sort'=>array('s'=>1,'_id'=>1)),false);
	foreach($tmp as $v)
	{
		$forum['cate'][$v['_id']]=$v;
		if($v['sl'])
		{
			$forum['link'][$v['sl']]=$v['_id'];
		}
	}

	$forum['topic']=$db->find('forum',array('dd'=>array('$exists'=>false),'c'=>array('$in'=>array_keys($forum['cate']))),array('_id'=>1,'t'=>1,'ms'=>1,'c'=>1,'ic'=>1,'u'=>1,'ds'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>12),false);


	$hbanner=array();
	$hbanner['img']=$db->find('banner',array('dd'=>array('$exists'=>false),'ty'=>'home','pl'=>1,'p'=>'img'),array(),array('sort'=>array('so'=>1,'_id'=>-1),'limit'=>10));
	$hbanner['text']=$db->find('banner',array('dd'=>array('$exists'=>false),'ty'=>'home','pl'=>1,'p'=>'text'),array(),array('sort'=>array('so'=>1,'_id'=>-1),'limit'=>6));
	$hbanner['bottom']=$db->find('banner',array('dd'=>array('$exists'=>false),'ty'=>'home','pl'=>1,'p'=>'bottom'),array(),array('sort'=>array('so'=>1,'_id'=>-1),'limit'=>3));
	
	
	
		
	$tags=array();
	$tmp=$db->find('tags',array('amount'=>array('$gte'=>3)),array(),array('sort'=>array('amount'=>-1,'du'=>-1),'limit'=>10),false);
	
	$min=0;
	$max=0;
	foreach($tmp as $v)
	{
		if(!$min)
		{
			$min=$v['amount'];
		}
		elseif($min>$v['amount'])
		{
			$min=$v['amount'];
		}
		if(!$max)
		{
			$max=$v['amount'];
		}
		elseif($max<$v['amount'])
		{
			$max=$v['amount'];
		}
	}
	
	$rt = ($max-$min)/4;
	
	foreach($tmp as $v)
	{
		$av = $v['amount']-$min;
		$v['size'] = floor($av/$rt);
		$tags[]=$v;	
	}
	shuffle($tags);
	$template->assign('profile',$profile);
	//$template->assign('album',$album);
	$template->assign('video_rec',$video_rec);
	$template->assign('movie_rc',$movie_rc);
	$template->assign('movie_show',$movie_show);
	$template->assign('movie_soon',$movie_soon);
	$template->assign('friend_type',$friend_type);
	$template->assign('friend_rec',$friend_rec);
	$template->assign('province',$province);
	
	$template->assign('province',$province);
	$template->assign('lotto_last',$lotto_last);
	$template->assign('lotto_all',$lotto_all);
	
	$template->assign('news',$news);
	$template->assign('newshot',$newshot);
	$template->assign('ent',$ent);
	//$template->assign('honews',$honews[0]);
	$template->assign('game',$game);
	$template->assign('glitter',$glitter);
	
	$template->assign('football',$football);
	$template->assign('beauty',$beauty);
	$template->assign('picpost',$picpost);
	$template->assign('hbanner',$hbanner);
	
	
	$template->assign('forum',$forum);
	$template->assign('market',$market);
	$template->assign('tags',$tags);
	
	$template->assign('_banner',_::banner('www'));
	
	$template->assign('time12',(time()-(3600*12)));
	
	_::$content=$template->fetch('home');	
		
	$cache->set('ca1','home',_::$content,false,600);
}

function video_duration($t)
{
	if($t)
	{
		$h='';
		if($t>3600)
		{
			$h=intval($t / 3600).':';
		}
		$m=intval($t/60);
		return ($h?$h.substr('00'.$m,-2):$m).':'.substr('00'.intval($t%60),-2);
	}
}

?>