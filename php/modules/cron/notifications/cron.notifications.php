<?php
$db = _::db();
$mail = _::mail();
$user = _::user();
$template = _::template();


$time = new MongoDate(time()-(3600*6));
$time2 = new MongoDate(time()-(3600*24));

//$cron = $db->group('cron_notifications',array('p'=>1), array('count'=>0,'p'=>''), "function(obj, prev) {prev.p=obj.p;prev.count++; }",array('condition'=>array('da'=>array('$lte'=>$time))));
$cron = $db->find('cron_notifications',array('da'=>array('$lte'=>$time)),array(),array('sort'=>array('_id'=>1),'limit'=>500));

for($i=0;$i<count($cron);$i++)
{
	$p = $user->get($cron[$i]['p'],true);
	
	if((!$p['dm']) || $p['dm']->sec<$time2->sec)
	{
		if($news=$db->find('cron_notifications',array('p'=>$cron[$i]['p']),array(),array('sort'=>array('u'=>1))))
		{
			$ms=array();
			$count=array('rq'=>0,'ac'=>0,'ln'=>0);
			$us=array();
			for($j=0;$j<count($news);$j++)
			{
				$db->remove('cron_notifications',array('_id'=>$news[$j]['_id']));
				
				if(!$p || ($p['du']->sec > $news[$j]['da']->sec))
				{
					continue;
				}
				if($p['st']!=1)
				{
					continue;
				}
				if(!$u=$user->profile($news[$j]['u']))
				{
					continue;
				}
				$valid=false;
				if($news[$j]['ty']=='rq')
				{
					$valid=array('u'=>$u,'t'=>'ส่งคำร้องขอเป็นเพื่อนถึงคุณ','l'=>array('text'=>'ไปยังโปรไฟล์ของ '.$u['name'],'href'=>'http://boxza.com/'.$u['link']));
				}
				elseif($news[$j]['ty']=='ac')
				{
					$valid=array('u'=>$u,'t'=>'ตอบรับคุณเป็นเพื่อน','l'=>array('text'=>'ไปยังโปรไฟล์ของ '.$u['name'],'href'=>'http://boxza.com/'.$u['link']));
				}
				elseif($news[$j]['ty']=='ln')
				{
					$valid=array('u'=>$u,'m'=>$news[$j]['ms'],'t'=>'โพสข้อความบนไลน์ของคุณ','l'=>array('text'=>'ไปยังข้อความที่โพส','href'=>'http://social.boxza.com/line/'.$news[$j]['rl']));
				}
				if($valid)
				{
					$count[$news[$j]['ty']]++;
					$ms[]=$valid;
					$us[$u['_id']]=$u;
				}
			}
			if(count($ms)>0)
			{
				$us=array_values($us);
				if(count($us)==1)
				{
					$title = $us[0]['name'];
				}
				elseif(count($us)==2)
				{
					$title = $us[0]['name'].' และ '.$us[1]['name'];
				}
				elseif(count($us)==3)
				{
					$title = $us[0]['name'].', '.$us[1]['name'].' และ '.$us[2]['name'];
				}
				elseif(count($us)==4)
				{
					$title = $us[0]['name'].', '.$us[1]['name'].' และเพื่อนอีก 2 คน';
				}
				elseif(count($us)>4)
				{
					$title = $us[0]['name'].', '.$us[1]['name'].', '.$us[2]['name'].' และเพื่อนอีก '.(count($us)-3).' คน';
				}
				$title .= ' กำลังติดต่อกับคุณบน BoxZa Social Network ของคนไทย';
				$mail->to=$p['em'];
				$mail->subject = $title;
				$template->assign('us',$us);
				$template->assign('title',$title);
				$template->assign('ms',$ms);
				echo '<br>-------------------------------<br>'.$p['em'].' - <br>';
				echo '<br>'.$title.'<br>';
				echo '<br>-------------------------------<br>';
				echo $mail->message = $template->fetch('notifications');
				echo '<br>-------------------------------<br>'.$p['em'].' - ';
				echo $mail->send()?'send':'fail';
				echo ' - '.$mail->_m->ErrorInfo;
				echo '<br>-------------------------------<br>';
				/*
				if(count($us)>4)
				{
					$mail->to='positron.th@gmail.com';
					$mail->subject = $title;
					$template->assign('us',$us);
					$template->assign('title',$title);
					$template->assign('ms',$ms);
					$mail->message = $template->fetch('notifications');
					$mail->send()?'send':'fail';
				}
				*/
				$user->update($p['_id'],array('$set'=>array('dm'=>new MongoDate())));
			}
		}
	}
}



echo '<br>---------'.count($cron).'----------';
?>