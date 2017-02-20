<?php


$db=_::db();
if(!_::$path[1] || !$user=$db->findone('matching_user',array('_id'=>intval(_::$path[1]))))
{
	_::move('/matching');	
}

define('USER_ID',$user['_id']);
define('USER_FB',$user['fb']);
define('USER_LV',$user['lv']);

_::ajax()->register(array('setpass'));

$lv=intval(_::$path[2]);

if(!$lv || $lv>USER_LV)
{
	$lv=USER_LV;
}

$game=array('error'=>'เลเวลนี้ยังไม่เปิด.');
$games=require(__DIR__.'/mobile.matching.game.config.php');
if(isset($games[$lv]))
{
	$game=$games[$lv];
}

$template->assign('lv',$lv);
$template->assign('game',$game);
$template->assign('maxlv',count($games)+1);
$template->assign('user',$user);
_::$content=$template->fetch('matching.game');



function setpass($arg)
{
	global $user;
	$db=_::db();
	$ajax=_::ajax();
	
	$lv=array('error'=>'เลเวลนี้ยังไม่เปิด.');
	$game=require(__DIR__.'/mobile.matching.game.config.php');
	if(isset($game[$arg['lv']]))
	{
		$g=$game[$arg['lv']];
		$cell=$g['cell'];
		$sc=intval(($cell*$cell)/2)*$g['score'];
		//$score=$g['score'];
		
		$max=intval($arg['score']);
		$fail=intval($arg['fail']);
		$score=$max-$fail;
		if($sc==$max && $fail<$max && USER_ID==$arg['id'] && USER_FB==$arg['fb'])
		{
			$nlv=($arg['lv']+1);
			
			$set=array();
			$wall=false;
			if(USER_LV==$arg['lv'])
			{
				$wall=true;
				$set['lv']=$nlv;	
			}
			$clv=$user['pass']['lv'.$arg['lv']];
			if(!$clv || $clv['s']<$score)
			{
				$set['pass.lv'.$arg['lv']]=array('m'=>$max,'f'=>$fail,'s'=>$score);
				
				if(!is_array($user['pass']))
				{
					$user['pass']=array();
				}
				$user['pass']['lv'.$arg['lv']]=array('m'=>$max,'f'=>$fail,'s'=>$score);
				
				$now=0;
				for($i=1;$i<=USER_LV;$i++)
				{
					$now+=intval($user['pass']['lv'.$i]['s']);
				}
				$set['score']=$now;
			}
			if($wall)
			{
				
			}
			//'lv'=>$nlv,'pass.lv'.$arg['lv']=>array())
			if(count($set)>0)
			{
				//$ajax->alert(print_r(array('_id'=>USER_ID),true).' - '.print_r($set,true));
				$db->update('matching_user',array('_id'=>USER_ID),array('$set'=>$set));
			}
			$fb=array(
								'message'=>'อัพเลเวล '.$nlv.'. ใน เกมจับคู่+',
								'name'=>'เลเวล '.$nlv.'!.',
								'caption'=>'อัพเลเวล '.$nlv.'. ใน เกมจับคู่+ สำหรับ Android',
								'link'=>'https://play.google.com/store/apps/details?id=com.doodroid.matching',
								'picture'=>'https://lh6.ggpht.com/3qgcgzMX5TmSq6kWthzd9IwhA7O62k5jfHY0swhyjwqCqSJ3FUbsoFqjmuu1APFAyQ',
								'description'=>'เกมจับคู่+ by BoxZa.com - เกมทดสอบควมจำ เก็บเลเวล สะสมแต้ม เล่นง่ายๆ บนมือถือ/แท็บเล็ต Android',
								'actions'=>array(array('name'=>'เกมจับคู่+ for Android','link'=>'https://play.google.com/store/apps/details?id=com.doodroid.matching'))
			);
			if($wall)
			{
				$ajax->script('m.result('.json_encode($fb).')');
			}
			if(isset($game[$nlv]))
			{
				$ajax->script('m.nextlevel(true,'.json_encode(array('lv'=>$nlv,'wall'=>$wall)).');');
			}
			else
			{
				$ajax->script('m.nextlevel(false,'.json_encode(array('lv'=>$nlv,'wall'=>$wall)).');');
			}
		}
		else
		{
			$ajax->script('m.playagain(true);');
		}
	}
	else
	{
		$ajax->script('m.playagain(false);');
	}
}

?>