<?php

define('EXPIRE_NEWS',7);
define('HIDE_SIDEBAR',1);

_::ajax()->register(array('delnews','newnews'),'admin.home');

$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
extract(_::split()->get('/',0,array('c'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(!empty($c))
{
	$cp=explode('_',$c);
	if(empty($cate[$cp[0]]))
	{
		unset($c);
	}
}

$url='/admin/';
//_::time();
$db=_::db();
extract(_::split()->get('/admin/',0,array('page')));

$arg = array('dd'=>array('$exists'=>false));
if(!_::$my['am'])
{
	$arg['u']=_::$my['_id'];
}


_::$meta['title']='Admin - หน้ารวมข่าว';

if($c)
{
	$arg['c']=intval($cp[0]);
	if($cp[1])
	{
		$arg['cs']=intval($cp[1]);
	}
	if($cp[2])
	{
		$arg['cs2']=intval($cp[2]);
	}
	$url .= 'c-'.$c.'/';
}
if($count=$db->count('news',$arg))
{
	list($pg,$skip)=_::pager()->bootstrap(50,$count,array($url,'page-'),$page);
	$news=$db->find('news',$arg,array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'c'=>1,'cs'=>1,'ty'=>1,'tm'=>1,'pl'=>1,'do'=>1,'u'=>1,'da'=>1,'wt'=>1,'ds'=>1,'exl'=>1,'url'=>1),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
}


if(!$catelogs=$cache->get('ca1','news-cate-count'))
{
	$catelogs='<ul class="nav-clist">';
	foreach($cate as $k=>$v)
	{
		if($v['s'])
		{
			$catelogs.='<li><a href="/admin/c-'.$k.'">'.$v['t'].' ('.number_format($db->count('news',array('c'=>intval($k),'pl'=>1,'dd'=>array('$exists'=>false)))).')</a><ul>';
			foreach($v['s'] as $k2=>$v2)
			{
				if($v2['s'])
				{
					$catelogs.='<li><a href="/admin/c-'.$k.'_'.$k2.'">'.$v2['t'].' ('.number_format($db->count('news',array('c'=>intval($k),'cs'=>intval($k2),'pl'=>1,'dd'=>array('$exists'=>false)))).')</a><ul>';
					foreach($v2['s'] as $k3=>$v3)
					{
						$catelogs.='<li><a href="/admin/c-'.$k.'_'.$k2.'_'.$k3.'">'.$v3['t'].' ('.number_format($db->count('news',array('c'=>intval($k),'cs'=>intval($k2),'cs2'=>intval($k3),'pl'=>1,'dd'=>array('$exists'=>false)))).')</a></li>';
					}
					$catelogs.='</ul></li>';
				}
				else
				{
					$catelogs.='<li><a href="/admin/c-'.$k.'_'.$k2.'">'.$v2['t'].' ('.number_format($db->count('news',array('c'=>intval($k),'cs'=>intval($k2),'pl'=>1,'dd'=>array('$exists'=>false)))).')</a></li>';
				}
			}
			$catelogs.='</ul></li>';
		}
		else
		{
			$catelogs.='<li><a href="/admin/c-'.$k.'">'.$v['t'].' ('.number_format($db->count('news',array('c'=>intval($k),'pl'=>1,'dd'=>array('$exists'=>false)))).')</a></li>';
		}
	}
	$catelogs.='</ul><div class="cate-logs">อัพเดท: '.time::show(new mongodate(),'datetime').'</div>';
	$cache->set('ca1','news-cate-count',$catelogs,false,3600);
}

$template->assign('catelogs',$catelogs);
$template->assign('count',$count);
$template->assign('news',$news);
$template->assign('pager',$pg);
$template->assign('cp',$cp);
$template->assign('user',_::user());
_::$content=$template->fetch('admin.home');





?>