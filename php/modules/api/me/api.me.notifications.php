<?php
if(_::$my['_id'])
{
	$arg = array('p'=>_::$my['_id']);
	$hash = (_::$path[3]&&_::$path[3]=='hash')?true:false;
	if(_::$path[2])
	{
		if(_::$path[2]=='friend')
		{
			$_type='fr';
			$arg['ty']='friend';
		}
		else
		{
			$_type='ot';
			$arg['ty']=array('$ne'=>'friend');
		}
		$limit=10;
		_::$my['nf'][$_type]=0;
		_::$my['nf']['ds']=new MongoDate();
	}
	else
	{
		$_type='';
		$limit=20;
	}
	$tmp=array();
	$u = _::db()->find('notify',$arg,array('_id'=>1,'u'=>1,'p'=>1,'ty'=>1,'dr'=>1,'tt'=>1,'da'=>1,'rl'=>1),array('sort'=>array('da'=>-1),'limit'=>$limit));
	$user = _::user();
	for($i=0;$i<count($u);$i++)
	{
		if($ui=$user->profile($u[$i]['u']))
		{
			$u[$i]['u']=$ui;
		}
		else
		{
			$u[$i]['u']=array('_id'=>$u[$i]['u']);
		}
		$u[$i]['da']=$u[$i]['da']->sec;
		if($u[$i]['dr'])$u[$i]['dr']=$u[$i]['dr']->sec;
		//$u[$i]['u']['link'] = PROTOCOL.'boxza.com/'.$u[$i]['u']['link'];
		switch($u[$i]['ty'])
		{
			case 'line':
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='โพสข้อความถึงคุณ "<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>'.$u[$i]['tt'].'</a>"';
				break;
			case 'gift':
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='ส่งของขวัญถึงคุณ "<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>'.$u[$i]['tt'].'</a>"';
				break;
			case 'pet':
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>ซื้อคุณเป็น Collection  ในราคา '.number_format($u[$i]['tt']).'บ๊อก </a>';
				break;
			case 'lk':
			case 'like':
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='"<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>โดนข้อความของคุณ</a>"';
				break;
			case 'lk-cm':
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='โดนความคิดเห็นของคุณ "<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>'.$u[$i]['tt'].'</a>"';
				break;
			case 'po':
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='ตอบคำถามของคุณ "<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>'.$u[$i]['tt'].'</a>"';
				break;
				
			case 'vt':
				$u[$i]['l']=PROTOCOL.'boxza.com/'._::$my['link'];
				$u[$i]['ms']='<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/'._::$my['link'].'\',true);return false"':'').'>โหวตโปรไฟล์ของคุณ</a>';
				break;
				
			case 'friend':
				$u[$i]['ms']='ส่งคำร้องขอเป็นเพื่อน';
				break;
			case 'follow':
				$u[$i]['ms']='กำลังติดตามคุณ';
				break;
			case 'friend-accept':
				$u[$i]['ms']='ตอบรับการเป็นเพื่อนของคุณแล้ว';
				break;
			case 'sp':
			case 'spam':
				$u[$i]['u'] = $user->profile(0);
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='"<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>มีการแจ้งสแปมภายในข้อความของคุณ</a>"';
				break;
			case 'cm':
			case 'comment':
				$u[$i]['l']='http://social.boxza.com/line/'.$u[$i]['rl'];
				$u[$i]['ms']='แสดงความคิดเห็น "<a href="'.$u[$i]['l'].'"'.($hash?' onclick="_.line.go(\'/line/'.$u[$i]['rl'].'\',true);return false"':'').'>'.$u[$i]['tt'].'</a>"';
				break;
		}
	}
	_::$content[] = array('method'=>'notifications','data'=>$u,'type'=>_::$path[2]);
	
	if(isset($arg['ty']))
	{
		_::db()->update('notify',array('p'=>_::$my['_id'],'ty'=>$arg['ty'],'dr'=>array('$exists'=>false)),array('$set'=>array('dr'=>new MongoDate())),array('multiple'=>true));
		$user->update(_::$my['_id'],array('$set'=>array('nf.'.$_type=>0,'nf.ds'=>new MongoDate())));
	}
	else
	{
		_::db()->update('notify',array('p'=>_::$my['_id'],'dr'=>array('$exists'=>false)),array('$set'=>array('dr'=>new MongoDate())),array('multiple'=>true));
		$user->update(_::$my['_id'],array('$set'=>array('nf' => array('fr'=>0,'ot'=>0,'ds'=>new MongoDate()))));
	}
}
else
{
	_::$content[] = array('method'=>'login');
}

?>