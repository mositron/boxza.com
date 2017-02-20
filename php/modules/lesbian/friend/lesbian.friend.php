<?php


_::ajax()->register(array('sendreport','setrec'),'friend');
if($_POST)require_once(__DIR__.'/lesbian.friend.post.php');


$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
$all=array('order','by','search','page','day','month','year','position','category');
extract(_::split()->get('/friend/',0,array('z','p','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($z) && !isset($zone[$z]))
{
	unset($z);
}
if(isset($p) && !isset($province[$p]))
{
	unset($p);
}

$_=array('dd'=>array('$exists'=>false),'ty'=>'lesbian');
if($z)
{
	$_['pr']=array('$in'=>$zone[$z]['l']);
}
elseif($p)
{
	$_['pr']=intval($p);
}

if(isset($p))
{
	$p=intval($p);
	foreach($zone as $k=>$v)
	{
		if(in_array($p,$v['l']))
		{
			$z=$k;
			break;
		}
	}
}
if($page<1)$page=1;
if($p)
{
	_::$meta['title']='หาเพื่อนเลสเบี้ยน ทอม ดี้ เลสรุก เลสรัก เลสคิง เลสควีน เลสไบ เลสทูเวย์ ในจังหวัด'.$province[$p]['name_th'].($page>1?' หน้า '.$page:'').' - '._::$meta['title'];
}
elseif($z)
{
	_::$meta['title']='หาเพื่อนเลสเบี้ยน ทอม ดี้ เลสรุก เลสรัก เลสคิง เลสควีน เลสไบ เลสทูเวย์ ใน'.$zone[$z]['n'].($page>1?' หน้า '.$page:'').' - '._::$meta['title'];
}
else
{
	_::$meta['title']='หาเพื่อนเลสเบี้ยน ทอม ดี้ เลสรุก เลสรัก เลสคิง เลสควีน เลสไบ เลสทูเวย์'.($page>1?' หน้า '.$page:'').' - '._::$meta['title'];
}
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

$ckey='lesbian_friend_'.$z.'_'.$p.'_'.intval($page);
$cache=_::cache();
#if(!_::$content=$cache->get('ca1',$ckey))
#{
	$db=_::db();
	if($count=$db->count('msn',$_))
	{
		list($pg,$skip)=_::pager()->bootstrap(100,$count,array($url,'page-'),$page);
		$msn=$db->find('msn',$_,array(),array('sort'=>array('au'=>1,'da'=>-1),'skip'=>$skip,'limit'=>100),false);
	}
	
	$template->assign('rec',$db->find('msn_rec',array('dd'=>array('$exists'=>false),'fd'=>array('$exists'=>true),'ty'=>'lesbian'),array(),array('sort'=>array('_id'=>-1),'limit'=>20),false));
	$template->assign('z',$z);
	$template->assign('p',$p);
	
	$pc=array();
	foreach($zone as $k=>$v)
	{
		if($k!=4)$pc[$k]=$db->find('msn_province',array('z'=>intval($k)),array('t'=>1,'c'=>1),array('sort'=>array('c'=>-1),'limit'=>5),false);
	}
	
	
	
	$hot=$db->find('forum',array('c'=>452,'dd'=>array('$exists'=>false),'do'=>array('$gte'=>20)),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$fashion=$db->find('forum',array('c'=>454,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	$health=$db->find('forum',array('c'=>455,'dd'=>array('$exists'=>false)/*,'rc'=>1*/),array('_id'=>1,'t'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	
	$template->assign('hot',(array)$hot);
	$template->assign('fashion',(array)$fashion);
	$template->assign('health',(array)$health);
	
	
	
	$template->assign('pc',$pc);
	
	
	
	$template->assign('pager',$pg);
	$template->assign('page',$page);
	$template->assign('error',$error);
	$template->assign('msn',$msn);
	_::$content=$template->fetch('friend');
#	$cache->set('ca1',$ckey,_::$content,false,600);

#}


?>