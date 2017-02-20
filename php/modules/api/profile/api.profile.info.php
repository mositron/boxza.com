<?php

if(_::$profile=_::user()->get(intval($relate),true))
{
	//	public $fields=array('_id'=>1,'if'=>1,'em'=>1,'cd'=>1,'st'=>1,'sc'=>1,'nf'=>1,'pf'=>1,'op'=>1,'ct'=>1,'du'=>1,'ip'=>1,'am'=>1,'rk'=>1,'ht'=>1,'fr'=>1,'sg'=>1,'da'=>1,'dm'=>1);
	
	
	$pf=array();
	$open=array('al'=>false,'fr'=>false,'pt'=>false,'ms'=>false,'ln'=>false);
	$friend = 0;
	
	# Show All
	if((!_::$profile['op']['pf']['al']) || ((_::$my) && ((_::$my['_id']==_::$profile['_id'])|| (_::$profile['op']['pf']['al']==1))))
	{
		$open['al']=true;
	}
	if(_::$my)
	{
		if(_::$my['_id']==_::$profile['_id'])
		{
			$open['al']=true;
			$friend=5;
		}
		elseif(in_array(_::$my['_id'],(array)_::$profile['ct']['fr']))
		{
			$open['al']=true;
			$friend=1;
		}
		elseif(in_array(_::$my['_id'],(array)_::$profile['ct']['fr']))
		{
			$open['al']=true;
			$friend=1;
		}
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
		}
		
		
		$gd=intval(_::$profile['op']['pf']['gd']);
		if(($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
		{
			$pf['gd']=_::$config['gender'][_::$profile['if']['gd']];
		}
		$gd=intval(_::$profile['op']['pf']['rl']);
		if(($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
		{
			if($rl2=_::$config['relate'][intval(_::$profile['if']['rl'])])
			{
				$pf['rl']=$rl2;
			}
		}
		$gd=intval(_::$profile['op']['pf']['bd']);
		if((_::$profile['if']['bd']) && ($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
		{
			$month=array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
			$d = explode('-',date('d-m-Y',_::$profile['if']['bd']->sec));
			$pf['bd']=$d[0].' '.$month[intval($d[1])-1].(_::$profile['op']['pf']['yr']?'':' '.intval($d[2]+543));
		}
		$gd=intval(_::$profile['op']['pf']['pr']);
		if((_::$profile['if']['bd']) && ($gd!=3) && (($gd==0)||(($gd==1)&&_::$my)||(($gd==2)&&$friend==1)))
		{
			$prov = require(HANDLERS.'boxza/province.php');
			$pf['pr']=(_::$profile['if']['pr']?'จังหวัด ':'').$prov[_::$profile['if']['pr']]['name_th'];
		}
	/*
		$template->assign('user',_::user());
		$template->assign('open',$open);
		$template->assign('friend',$friend);
		$template->assign('mutual',$mutual);
		$template->assign('pf',$pf);
		$template->assign('is_profile', 1);
		*/
		if(_::$path[0]  && (in_array(_::$path[0],array('friends','photos','line','about'))))
		{
			if(_::$path[0]=='friends' && !$open['fr'])
			{
				$open['al']=false;
			}
			elseif(_::$path[0]=='photos' && !$open['pt'])
			{
				$open['al']=false;
			}
			//require_once(__DIR__.'/www.user.'._::$path[0].'.php');
		}
		elseif(_::$path[0])
		{
		//	$open['al']=false;
		}
		else
		{
			_::$path[0]='about';
			//require_once(__DIR__.'/www.user.about.php');
		}
		
		if($open['fr'])
		{
			//$friends = (array)_::$profile['ct']['fr'];
			//shuffle($friends);
			//$template->assign('friends',array_slice($friends,0,12));
		}
	//	$template->assign('blog',$blog);
	}
	unset(_::$profile['em'],_::$profile['cd'],_::$profile['sc'],_::$profile['nf'],_::$profile['op'],_::$profile['ct'],_::$profile['du'],_::$profile['ip'],_::$profile['am'],_::$profile['ht'],_::$profile['fr'],_::$profile['sg'],_::$profile['da'],_::$profile['dm']);
	
		_::$content[] = array('method'=>'profile','type'=>'info','data'=>array('info'=>_::$profile,'friend'=>$friend,'open'=>$open,'status'=>implode(', ',array_values($pf))));
	if($open['al'])
	{
		_::$content[] = array('method'=>'line','type'=>'list','data'=>_::profile()->line($who,'profile',0));
	}
	else
	{
		_::$content[] = array('method'=>'profile','type'=>'error','data'=>array('message'=>'คุณไม่สามารถเข้าถึงข้อมูลนี้ได้'));
	}
}
else
{
	_::$content[] = array('method'=>'error','type'=>'info','data'=>"no profile - ".$relate);
}

?>