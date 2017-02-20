<?php
$cache=_::cache();

//_::time();
$db=_::db();

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get(FORUM_URL,0,array('c','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));
if($c && !isset($cate[$c]))
{
	unset($c);
}
if(!$c)
{
	_::move(FORUM_URL);
}
if($cate[$c]['l'])
{
	$f=array_merge($cate[$c]['l'],array(intval($c)));
}
else
{
	$f=array(intval($c));
}

if($cate[$c]['s'] && !defined('FORUM_IN'))
{
	_::move('http://'.$cate[$c]['s'].'.boxza.com/forum/c-'.$c,true);
}
elseif(defined('FORUM_IN') && !$cate[$c]['s'])
{
	_::move('http://forum.boxza.com/c-'.$c,true);
}
_::$meta['title'] = $cate[$c]['t'].' - '.$cate[$c]['d'].' - '._::$meta['title'];
_::$meta['description'] = $cate[$c]['t'].' - '.$cate[$c]['d'].' - '._::$meta['description'];

$topic=array();
$_=array('dd'=>array('$exists'=>false));
if(defined('FORUM_IN'))
{
	$_['c']=array('$in'=>$f);
}
else
{
	$_['$or']=array(array('c'=>array('$in'=>$f)),array('c'=>3,'sk'=>1));
}
$_2=array('_id'=>1,'t'=>1,'ms'=>1,'ic'=>1,'u'=>1,'s'=>1,'o'=>1,'ds'=>1,'do'=>1,'sk'=>1,'lo'=>1,'f'=>1,'c'=>1,'fd'=>1,'lk.c'=>1,'s'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1);
$pp=30;
$lorder=(defined('FORUM_ORDER')?FORUM_ORDER:'ds');
if(isset($option) && isset($option['list']) && isset($option['list'][$c]))
{
	if(isset($option['list'][$c]['cm']))
	{
		$_2['cm.d']['$slice']=$option['list'][$c]['cm'];
	}
	if(isset($option['list'][$c]['pp']))
	{
		$pp=$option['list'][$c]['pp'];
	}
	if(isset($option['list'][$c]['order']))
	{
		$lorder=$option['list'][$c]['order'];
	}
	if(isset($option['list'][$c]['th_page']))
	{
		define('TH_PAGE',$option['list'][$c]['th_page']);
	}
	
	if(isset($option['list'][$c]['nsk'])&&isset($_['$or']))
	{
		unset($_['$or']);
		$_['c']=array('$in'=>$f);
	}
}
if($count=$db->count('forum',$_))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array(FORUM_URL.'c-'.$c,'/page-'),$page);
	$topic=$db->find('forum',$_,$_2,array('sort'=>array('sk'=>-1,$lorder=>-1),'skip'=>$skip,'limit'=>$pp),false);
}
$template->assign('c',$c);
$template->assign('pager',$pg);
$template->assign('count',$count);
$template->assign('topic',$topic);
$template->assign('user',_::user());

if(isset($option) && isset($option['tpl']) && isset($option['tpl'][$c]) && isset($option['tpl'][$c]['list']))
{
	_::$content=$template->fetch2(FORUM_TPL.'list.'.$option['tpl'][$c]['list']);
}
else
{
	_::$content=$template->fetch2(FORUM_TPL.'list');
}


function topic_page($link,$count)
{
	$tmp='';
	if($count>20)
	{
		$pages=ceil($count/20);
		$pagerarr=array();
		$start_p=0;
		$stop_p=$start_p+5;
		for ($i=1;$i<=$pages; $i++)
		{		
			if (($i!=$pages&&$i!=1)&&($start_p>$i||$stop_p<$i))
			{
				if(!$dotted)$pagerarr[]=" ... ";
				$dotted=true;
				continue;
			}
			$dotted=false;
			$pagerarr[]='<a href="'.$link.'/page-'.$i.'">'.$i.'</a>';
		}
		$tmp='<div class="gopage">ไปหน้า '.join(", ",$pagerarr).'</div>';
	}
	return $tmp;
}
?>