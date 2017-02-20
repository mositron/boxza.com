<?php

$db=_::db();
if(!$match=$db->findone('football_match',array('_id'=>intval(_::$path[1])),array('_id'=>1,'_ng'=>1,'lg'=>1,'t1'=>1,'t2'=>1,'tm'=>1,'ft'=>1,'fp'=>1,'gm'=>1,'lv'=>1,'em'=>1,'gm'=>1,'kd'=>1,'ki'=>1,'py'=>1)))
{
	_::move('/');
}

$team1=$db->findone('football_team',array('_id'=>$match['t1']['_id']));
$team2=$db->findone('football_team',array('_id'=>$match['t2']['_id']));
$team=array($match['t1']['_id']=>$team1,$match['t2']['_id']=>$team2);

$tm=time::show($match['tm'],'datetime');

if($match['ft'])
{
	
	
	$match['gf']=array('c5'=>array(),'c15'=>array());
	list($t1,$t2)=explode('-',$match['ft']);
	$t1=intval($t1);
	$t2=intval($t2);
	if($t1>$t2)
	{
		$w=1;	
	}
	elseif($t2>$t1)
	{
		$w=2;	
	}
	else
	{
		$w=0;	
	}
	if($win=$db->find('football_game',array('m'=>$match['_id'],'w'=>$w)))
	{
		$user=_::user();
		for($k=0;$k<count($win);$k++)
		{
			if($u=$user->profile($win[$k]['u']))
			{
				if($match['ft']==$win[$k]['ft'])
				{
					$match['gf']['c15'][]='<a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['name'].'</a>';
				}
				else
				{
					$match['gf']['c5'][]='<a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['name'].'</a>';
				}
			}
		}
	}

}

//_::$meta['image']='http://s3.boxza.com/football/team/'.$_team['fd'].'/o.jpg';

$score=$db->find('football_score',array('t._id'=>array('$in'=>array($team1['_id'],$team2['_id'])),'lg'=>$match['lg']),array(),array('sort'=>array('lg'=>1,'r'=>1)));

$match1=$db->find('football_match',array('$or'=>array(array('t1._id'=>$match['t1']['_id']),array('t2._id'=>$match['t1']['_id'])),'tm'=>array('$lt'=>$match['tm']),'ft'=>array('$ne'=>'')),array(),array('sort'=>array('tm'=>-1),'limit'=>5));
$match2=$db->find('football_match',array('$or'=>array(array('t1._id'=>$match['t2']['_id']),array('t2._id'=>$match['t2']['_id'])),'tm'=>array('$lt'=>$match['tm']),'ft'=>array('$ne'=>'')),array(),array('sort'=>array('tm'=>-1),'limit'=>5));
$match3=$db->find('football_match',array('t1._id'=>$match['t1']['_id'],'tm'=>array('$lt'=>$match['tm']),'ft'=>array('$ne'=>'')),array(),array('sort'=>array('tm'=>-1),'limit'=>5));
$match4=$db->find('football_match',array('t2._id'=>$match['t2']['_id'],'tm'=>array('$lt'=>$match['tm']),'ft'=>array('$ne'=>'')),array(),array('sort'=>array('tm'=>-1),'limit'=>5));

$video=$db->findone('football_video',array('dd'=>array('$exists'=>false),'tm'=>array('$gte'=>new MongoDate($match['tm']->sec-(3600*24*5)),'$lte'=>new MongoDate($match['tm']->sec+(3600*24*5))),'pl'=>1,'lg'=>$match['lg'],'t1'=>$match['t1']['_id'],'t2'=>$match['t2']['_id']),array('_id'=>1,'em'=>1,'fd'=>1,'t1'=>1,'t2'=>1,'ft'=>1,'tm'=>1));
	
//print_r($match);

$template->assign('score',$score);
$template->assign('team',$team);
$template->assign('team1',$team1);
$template->assign('team2',$team2);
$template->assign('match',$match);
$template->assign('match1',$match1);
$template->assign('match2',$match2);
$template->assign('match3',$match3);
$template->assign('match4',$match4);
$template->assign('video',$video);
_::$content=$template->fetch('football.match');

function gtype($v)
{
	if(!$v)return '';
	switch($v)
	{
		case 'g':
			return '<i class="icon-goal" title="ทำประตู"></i>';
		case 'g1':
			return '<i class="icon-goal1" title="ประตูลูกโทษ"></i>';
		case 'g2':
			return '<i class="icon-goal2" title="ประตูตัวเอง"></i>';
		case 'p':
			return '<i class="icon-change" title="เปลี่ยนตัว"></i>';
		case 'y':
			return '<i class="icon-yellow" title="ใบเหลือง"></i>';
		case 'r':
			return '<i class="icon-red" title="ใบแดง"></i>';
	}
	return '';
}

function getmatchrs($h,$v)
{
	if($v['t1']['_id']==$h)
	{
		$st='ในบ้าน';
		list($t1,$t2)=explode('-',$v['ft']);
		$ot=$v['t2']['_id'];
	}
	else
	{
		$st='นอกบ้าน';
		list($t2,$t1)=explode('-',$v['ft']);
		$ot=$v['t1']['_id'];
	}
	if($t1>$t2)
	{
		$rs='<strong style="color:#009900">ชนะ</strong>';
	}
	elseif($t1<$t2)
	{
		$rs='<strong style="color:#FF0000">แพ้</strong>';
	}
	else
	{
		$rs='<strong>เสมอ</strong>';
	}
	return array($ot,$rs,$st);
}

function getbattle($data,$isajax=false)
{
	if(is_array($data) && count($data))
	{
		$ajax=_::ajax();
		$return='';
		$user=_::user(); 
		for($i=0;$i<count($data);$i++)
		{
			$v=$data[$i];
			if($v['u'] &&  ($u=$user->profile($v['u'])))
			{
				$name=$u['name'];
				$img='<a href="http://boxza.com/'.$u['link'].'" target="_blank" title="'.$name.'"><img src="'.$u['img'].'" alt="'.$name.'"></a>';
				$link='<a href="http://boxza.com/'.$u['link'].'" target="_blank" title="'.$name.'">'.$name.'</a>';
			}
			elseif($v['n'])
			{
				$name=$v['n'];
				$img='<img src="http://s0.boxza.com/static/images/news/avatar.jpg" alt="'.$name.'">';
				$link=$name;
			}
			else
			{
				continue;
			}
			$tmp='<div class="sel'.$v['s'].' battle-'.$v['i'].'">
			<div class="a">'.$img.'</div>
			<div class="d">
			<p>'.nl2br($v['m']).'</p>
			<span cm="'.$v['i'].'">#'.$v['i'].', '.$link.' '.(!$v['u']?', IP: '.$v['p'].' ':'').', '.time::show($v['t'],'datetime').'</span>
			</div>
			</div>
			<p class="clear"></p>';
			if($isajax)
			{
				$ajax->script('assignbattle('.json_encode(array('i'=>$v['i'],'m'=>$tmp)).')');
			}
			else
			{
				$return=$tmp.$return;
			}
		}
		if(!$isajax)
		{
			return $return;
		}
	}
}
?>