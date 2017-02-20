<?php

if($_FILES['photo'])
{
	require_once ROOT_MODULES.'line/m.line.post.php';
}
elseif($_FILES['header']||$_FILES['avatar']||$_POST['upload_bg'])
{
	require_once(__DIR__.'/m.user.post.php');
}

_::ajax()->register(array('vote','sendgift','setblock'),'user');




$open=array('al'=>false,'fr'=>false,'pt'=>false,'ms'=>false,'ln'=>false);
$friend = false;

$template=_::template();

# Show All
if((!_::$profile['op']['pf']['al']) || ((_::$my) && ((_::$my['_id']==_::$profile['_id'])|| (_::$profile['op']['pf']['al']==1))))
{
	$open['al']=true;
}
if((_::$my) && (in_array(_::$my['_id'],(array)_::$profile['ct']['fr'])))
{
	$open['al']=true;
	$friend=1;
	define('IS_FRIEND',1);
}


if($open['al'])
{
	# Show Friends
	if((!_::$profile['op']['pf']['fr']) || ((_::$my) && ((_::$my['_id']==_::$profile['_id'])|| (_::$profile['op']['pf']['fr']==1))))
	{
		$open['fr']=true;
	}
	elseif($friend && (_::$profile['op']['pf']['fr']==2))
	{
		$open['fr']=true;
	}
	
	# Show Photos
	if((!_::$profile['op']['pf']['pt']) || ((_::$my) && ((_::$my['_id']==_::$profile['_id']) || (_::$profile['op']['pf']['pt']==1))))
	{
		$open['pt']=true;
	}
	elseif($friend && (_::$profile['op']['pf']['fr']==2))
	{
		$open['pt']=true;
	}
	
	# Send Message
	if((_::$my && _::$my['_id']!=_::$profile['_id']) && ((!_::$profile['op']['pf']['ms']) || ($friend && (_::$profile['op']['pf']['ms']==1))))
	{
		$open['ms']=true;
	}
	
	# Post to line
	if((_::$my && ((_::$my['_id']==_::$profile['_id']) || (!_::$profile['op']['pf']['ln']) || ((_::$profile['op']['pf']['ln']==1) && $friend))))
	{
		$open['ln']=true;
	}

	if($open['fr'] && _::$my['_id'] && _::$my['_id']!=_::$profile['_id'])
	{
		if($friend)
		{
		
		}
		elseif($f=_::db()->findOne('friend',array('$or'=>array(array('u'=>_::$my['_id'],'p'=>_::$profile['_id']),array('p'=>_::$my['_id'],'u'=>_::$profile['_id']))),array('u'=>1,'p'=>1,'ac'=>1)))
		{
			if(!$f['ac'])
			{
				if($f['u']==_::$my['_id'])
				{
					$friend = 2; // i'm request
				}
				elseif($f['p']==_::$my['_id'])
				{
					$friend = 3; // i'm accept
				}
			}
		}
		$cm = count(_::$my['ct']['fr']);
		$cf = count(_::$profile['ct']['fr']);
		if($cm && $cf)
		{
			$mutual=array();
			if($cm < $cf)
			{
				$k = array_flip((array)_::$profile['ct']['fr']);
				$f = _::$my['ct']['fr'];
			}
			else
			{
				$k = array_flip(array_map('intval',array_values((array)_::$my['ct']['fr'])));
				$f = _::$profile['ct']['fr'];
			}
			foreach($f as $v)
			{
				if(isset($k[$v]))
				{
					$mutual[] = $v;
				}
			}
		}
	}
	
	
	$pf=array(array(),array());
	$gd=intval(_::$profile['op']['pf']['gd']);
	if(($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
	{
		$pf[0]['gd']=_::$config['gender'][_::$profile['if']['gd']];
		$pf[1]['gd']='<span>'.$pf[0]['gd'].'</span>';
	}
	$gd=intval(_::$profile['op']['pf']['rl']);
	if(($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
	{
		if($rl2=_::$config['relate'][intval(_::$profile['if']['rl'])])
		{
			$pf[0]['rl']=$rl2;
			$pf[1]['rl']='<span>'.$pf[0]['rl'].'</span>'; 
		}
	}
	$gd=intval(_::$profile['op']['pf']['bd']);
	if((_::$profile['if']['bd']) && ($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
	{
		$month=array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		$d = explode('-',date('d-m-Y',_::$profile['if']['bd']->sec));
		$pf[0]['bd']=$d[0].' '.$month[intval($d[1])-1].(_::$profile['op']['pf']['yr']?'':' '.intval($d[2]+543));
		$pf[1]['bd']='วันเกิด <span>'.$pf[0]['bd'].'</span>';
	}
	$gd=intval(_::$profile['op']['pf']['pr']);
	if((_::$profile['if']['bd']) && ($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
	{
		$prov = require(HANDLERS.'boxza/province.php');
		$pf[0]['pr']=(_::$profile['if']['pr']?'จังหวัด ':'').$prov[_::$profile['if']['pr']]['name_th'];
		$pf[1]['pr']='<span>'.$pf[0]['pr'].'</span>';
	}

	$template->assign('user',_::user());
	$template->assign('open',$open);
	$template->assign('friend',$friend);
	$template->assign('mutual',$mutual);
	$template->assign('pf',$pf);
	$template->assign('is_profile', 1);
	
	if(_::$path[0]  && (in_array(_::$path[0],array('friends','photos','line','about'))))
	{
		if(_::$path[0]=='friends' && !$open['fr'])
		{
			_::move('/'._::$profile['link']);
		}
		elseif(_::$path[0]=='photos' && !$open['pt'])
		{
			_::move('/'._::$profile['link']);
		}
		require_once(__DIR__.'/m.user.'._::$path[0].'.php');
	}
	elseif(_::$path[0])
	{
		_::move('/'._::$profile['link']);
	}
	else
	{
		_::$path[0]='about';
		require_once(__DIR__.'/m.user.about.php');
	}
	
	if($open['fr'])
	{
		$friends = (array)_::$profile['ct']['fr'];
		shuffle($friends);
		$template->assign('friends',array_slice($friends,0,12));
	}
	if($friend==1)
	{
		$blog = _::db()->find('line',array('u'=>_::$profile['_id'],'ty'=>'blog','dd'=>array('$exists'=>false)),array('_id'=>1,'tt'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	}
	else
	{
		$blog = _::db()->find('line',array('u'=>_::$profile['_id'],'in'=>0,'ty'=>'blog','dd'=>array('$exists'=>false)),array('_id'=>1,'tt'=>1,'da'=>1),array('sort'=>array('_id'=>-1),'limit'=>10));
	}
	$template->assign('blog',$blog);
}
elseif(_::$path[0])
{
	_::move('/'._::$profile['link']);
}

$template->assign('user',_::user());
$template->assign('open',$open);


_::$content=$template->fetch('user');
?>