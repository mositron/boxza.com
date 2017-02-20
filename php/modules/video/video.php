<?php


# check session/login
_::session();


//_::time();

_::$meta['image']='http://s0.boxza.com/static/images/global/logo-video.png';
_::$meta['title'] = ' คลิป วิดีโอ ดู คลิปขำๆ ฮาๆ น่ารัก มิวสิควิดีโอ';
_::$meta['description'] = 'ดูหนังออนไลน์ ดูทีวีออนไลน์ ดูทีวีย้อนหลัง  คลิป วิดีโอ คลิปขำๆ ฮาๆ น่ารัก มิวสิควิดีโอ - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ดูหนังออนไลน์, ดูทีวีออนไลน์, ดูทีวีย้อนหลัง, คลิป, วิดีโอ, คลิปขำๆ, น่ารัก, มิวสิควิดีโอ, คลิปตลก, คลิปสาวสวย';

$template=_::template();
$cache=_::cache();
if(!$ca=$cache->get('ca1','video_cate'))
{
	$tmp=_::db()->find('video_cate',array(),array(),array('sort'=>array('_id'=>1)));
	$acate=array();
	$cate=array();
	for($i=0;$i<count($tmp);$i++)
	{
		$acate[$tmp[$i]['_id']]=$tmp[$i];
		$acate[$tmp[$i]['_id']]['in']=array($tmp[$i]['_id']);
		if($tmp[$i]['lv'])
		{
			if($tmp[$i]['lv']>1)
			{
				$cate[$tmp[$i]['p0']]['l'][$tmp[$i]['p1']]['l'][$tmp[$i]['_id']]=array('n'=>$tmp[$i],'l'=>array());
				$acate[$tmp[$i]['p1']]['in'][]=$tmp[$i]['_id'];
			}
			else
			{
				$cate[$tmp[$i]['p0']]['l'][$tmp[$i]['_id']]=array('n'=>$tmp[$i],'l'=>array());
			}
			$acate[$tmp[$i]['p0']]['in'][]=$tmp[$i]['_id'];
		}
		else
		{
			$cate[$tmp[$i]['_id']]=array('n'=>$tmp[$i],'l'=>array());
		}
	}
	unset($tmp);
	$cache->set('ca1','video_cate',array('acate'=>$acate,'cate'=>$cate),false,(3600*24));
}
else
{
	$acate=$ca['acate'];
	$cate=$ca['cate'];
	unset($ca);
}
$template->assign('acate',$acate);
$template->assign('cate',$cate);


if(!$data=$cache->get('ca1','video-global'))
{
	$db=_::db();
	$data=array();
	//$data['profile']=$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>25));
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner('video');
	$cache->set('ca1','video-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('profile',$data['profile']);
$template->assign('service',$data['service']);


# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'post'=>'post',
																	'update'=>'update',
																	'manage'=>'manage',
																	'playlist'=>'playlist',
																	'report'=>'report',
																	'fbtab'=>'fbtab',
																	'view'=>'view',
													),
													true,
													function()
													{
														$url=explode('-',_::$path[0]);
														if(is_numeric($url[0]))
														{
															_::move('/view/'.$url[0],true);
														}
														else
														{
															define('MODULE','list');
														}
													}
									)
);


$template->display('content');


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