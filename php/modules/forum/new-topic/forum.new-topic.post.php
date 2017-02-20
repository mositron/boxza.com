<?php
_::session()->logged();

function checkout_nofollow($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(boxza|boxzacar|boxzaracing|doodroid|google|teededball|boxzafootball|autocar)\.(.*)$/',$arg[1]))
	{
		return 	'<a href="'.$arg[1].'" target="_blank">';
	}
	else
	{
		return 	'<a href="http://out.boxza.com/#'.base64_encode($arg[1]).'" target="_blank">';
	}
}

function checkout_iframe($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(youtube)\.com(.*)$/',$arg[2]))
	{
		return 	'<iframe'.$arg[1].'src="'.$arg[2].'"'.$arg[3].'>';
	}
	else
	{
		return 	'<iframe width="0" height="0">';
	}
}


$db=_::db();

$ct_img='';
$error=array();
$arg=array();
$arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
$arg['d']=trim($_POST['detail']);
$arg['place']=array_filter(array_map('intval',(array)$_POST['place']));
$arg['people']=array_filter(array_map('intval',(array)$_POST['people']));

$badword = '('.implode('|',require(HANDLERS.'boxza/badword.php')).')';

if(!$arg['t'])
{
	$error['title']='กรุณากรอกหัวข้อกระทู้';
}
elseif(preg_match('/'.$badword.'/i',$arg['t'],$bw))
{
	$error['title']='ไม่สามารถใช้คำว่า "'.$bw[1].'" ในหัวข้อกระทู้ได้';
}

$len=mb_strlen($arg['d'],'utf-8');
if(!$arg['d'])
{
	$error['detail']='กรุณากรอกรายละเอียดของกระทู้';	
}
elseif(preg_match('/'.$badword.'/i',$arg['d'],$bw))
{
	$error['detail']='ไม่สามารถใช้คำว่า "'.$bw[1].'" ในรายละเอียดกระทู้ได้';
}
elseif($len>10000&&!_::$my['am'])
{
	$error['detail']='เนื้อหาของกระทู้มีความยาวมากเกินไป (สุงสุด 10,000ตัวอักษร)';	
}
elseif(preg_match('/\[([url|img|b|color]+)([^\]]*)\]/i',$arg['d']))
{
	$error['detail']='ไม่สามารถใช้งาน BBCode ได้';
}
elseif(preg_match('/\<(script|style)([^\>]*)\>/i',$arg['d']))
{
	$error['detail']='ไม่สามารถใช้งาน &lt;script&gt;, &lt;style&gt;, ได้';
}
/*
elseif($len>15000)
{
	$error['detail']='เนื้อหาของกระทู้มีความยาวมากเกินไป (สุงสุด 15,000ตัวอักษร)';	
}
*/
if(is_array($cate[$c]['a']))
{
	if($cate[$c]['a']['t'])
	{
		if(!isset($_FILES['attach1']) && !$_FILES['attach1']['tmp_name'])
		{
			$error['attach']='กรุณาเลือกรูปภาพ';	
		}
	}
	
	if(($f=$cate[$c]['a']['f']) && is_array($f))
	{
		foreach($f as $fk=>$fv)
		{
			if($fv[2] && !trim(strip_tags($_POST['f_'.$fk])))
			{
				$error['f_'.$fk]='กรุณากรอก'.$fv[0];	
			}
		}
	}
}


if(!count($error))
{
	//$arg['d'] = htmlspecialchars($arg['d'], ENT_QUOTES,'utf-8');
	
	# remove nofollow for link to boxza.com
	//$arg['d']=preg_replace('/\<a href\="http\:\/\/([a-z0-9\.]+)?boxza\.com([^"]+)"([^\>]+)?"\>/i','<a href="http://\1boxza.com\2" target="_blank">',$arg['d']);
	$arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['d']);

	# add title to image(alt)
	$arg['d']=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?boxza.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2boxza.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$arg['d']);
	$arg['d']=preg_replace_callback('/\<iframe([^\>]+)src\="([^"]+)"([^\>]+)?"\>/i','checkout_iframe',$arg['d']);
	
	$home_img=false;
	$set=array(
								'u'=>_::$my['_id'],
								't'=>$arg['t'],
								'c'=>intval($c),
								'd'=>$arg['d'],
								'ds'=>new MongoDate(),
								'ip'=>$_SERVER['REMOTE_ADDR'],
								'ic'=>max(1,min(14,intval($_POST['icon'])))
								);
	if(_::$my['am'])
	{
		if(_::$my['am']>=9)
		{
			$set['sk']=($_POST['sticky']?1:0);
		}
		else
		{
			$set['sk']=0;
		}
		$set['sk']=($_POST['sticky']?1:0);
		$set['rc']=($_POST['recommend']?1:0);
		$set['lo']=($_POST['lock']?1:0);
		
		if($_POST['sethome'] && $option && $option['home'] && $option['home'][$_POST['sethome']])
		{
			$_ho=$option['home'][$_POST['sethome']];
			if($_ho['i'])
			{
				$home_img=$_ho['i'];
			}
			$set['ho']=array($_POST['sethome']=>new MongoDate());
		}
	}
	else
	{
		$set['sk']=0;
		$set['rc']=0;
		$set['lo']=0;
	}
	
	if($id=$db->insert('forum',$set))
	{
		$key='chatroom_data_1';
		$cache=_::cache();
		if($data=$cache->get('ca2',$key))
		{
			if(is_array($data['text']))
			{
				$time=microtime(true);
				$al=array(
											'ty'=>'ms',
											'u'=>_::$my['_id'],
											'_id'=>$time,
											'_sn'=>str_replace('.','_',strval($time)),
											't'=>date('H:i',$time),
											'p'=>'',
											'm'=>'เขียนกระทู้ใหม่: "<a href="http://'.HOST.(defined('FORUM_IN')?'/forum':'').'/topic/'.$id.'" target="_blank">'.$arg['t'].'</a>"',
											'mb'=>1,
											'c'=>21,
											'n'=>_::$my['cname'],
											'l'=>_::$my['link'],
											'i'=>_::$my['img'],
											'am'=>0,
											'ip'=>$_SERVER['REMOTE_ADDR'],
											'rk'=>(_::$my['pet']?intval(_::$my['pet']['ty']):0),
											'vid'=>'',
										);
				
				array_push($data['text'],$al);
				$cache->set('ca2',$key,$data,false,3600*24*7);
			}
		}
		
		
		$_limita=0;
		$photo=_::photo();
		$fd = _::folder()->fd($id);
		$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
		$o=array();
		$_f=array();
		$s='';
		
		$_img=array(
										's'=>array(100,100),
										't'=>array(250,250),
										't2'=>array(700,1000),
		);
		if(is_array($cate[$c]['a']))
		{
			if($cate[$c]['a']['t'])
			{
				if(is_array($cate[$c]['a']['t']))
				{
					$_ci=$cate[$c]['a']['t'];
					if($_ci['s'])
					{
						$_img['s']=$_ci['s'];
					}
					if($_ci['t'])
					{
						$_img['t']=$_ci['t'];
					}
					if($_ci['t2'])
					{
						$_img['t2']=$_ci['t2'];
					}
				}
				if(!$_limita)$_limita=1;
			}
			if(_::$my['am'] && $cate[$c] && $cate[$c]['a'] && $cate[$c]['a']['a'])
			{
				$_limita=intval($cate[$c]['a']['a']);
			}
			elseif((!_::$my['am']) && $cate[$c] && $cate[$c]['a'] && $cate[$c]['a']['m'])
			{
				$_limita=intval($cate[$c]['a']['m']);
			}
			if($_limita)
			{
				for($i=1;$i<=$_limita;$i++)
				{
					if(isset($_FILES['attach'.$i]) && $_FILES['attach'.$i]['tmp_name'])
					{
						if($f=$_FILES['attach'.$i]['tmp_name'])
						{
							$size=@getimagesize($f);
							switch (strtolower($size['mime']))
							{
								case 'image/gif':
								case 'image/jpg':
								case 'image/jpeg':
								case 'image/bmp':
								case 'image/wbmp':
								case 'image/png':
								case 'image/x-png':
									if($size[0]>=10 && $size[1]>=10)
									{								
										$q=_::upload()->send('s3','forum-post','@'.$f,array('index'=>$i,'folder'=>$folder,'size'=>$_img));
										if($q['status']=='OK')
										{
											_::upload()->send('s3','watermark','forum/'.$folder.'/'.$q['data']['n'],array('watermark'=>'forum/watermark2.png'));
											
											$o[$i]=$q['data']['n'];
											if($i==1)
											{
												$s=$q['data']['s'];
												$ct_img='http://s3.boxza.com/forum/'.$folder.'/'.$s;
												if(_::$my['am'])
												{
													if($_POST['sethome'] && $home_img)
													{
														_::upload()->send('s3','upload','@'.$f,array('name'=>$_POST['sethome'],'folder'=>'forum/'.$folder,'width'=>$home_img[0],'height'=>$home_img[1],'fix'=>'both','type'=>'jpg'));
													}
													if(defined('FORUM_CACHE'))
													{
														_::cache()->delete('ca1',FORUM_CACHE.'_home',0);
														_::cache()->delete('ca1',FORUM_CACHE.'_forum_home',0);
														_::cache()->delete('ca1',FORUM_CACHE.'_global',0);
													}
												}
											}
										}
									}
									break;
							}
						}
					}
				}
			}
			
			if(($f=$cate[$c]['a']['f']) && is_array($f))
			{
				foreach($f as $fk=>$fv)
				{
					$_f[$fk]=trim(strip_tags($_POST['f_'.$fk]));
				}
			}		
		}
		
		$db->update('forum',array('_id'=>$id),array('$set'=>array('fd'=>$folder,'o'=>$o,'s'=>$s,'f'=>$_f,'sv'=>(defined('FORUM_FILES')?FORUM_FILES:'s1'))));
		
		$_rc=intval($c);
		while($_rc && isset($cate[$_rc]))
		{
			$db->update('forum_cate',array('_id'=>$_rc),array('$inc'=>array('tp'=>1),'$set'=>array('ls'=>array('u'=>_::$my['_id'],'t'=>new MongoDate(),'f'=>$arg['t'],'i'=>$id))));
			if($cate[$_rc]['p'])
			{
				$_rc=$cate[$_rc]['p'];
			}
			else
			{
				$_rc=0;
			}
		}
		_::user()->update(_::$my['_id'],array('$inc'=>array('fr.tp'=>1)));
		
		_::tags()->update($_POST['tags'], 'forum', $id,$arg['t'],$arg['d'],'http://'._::$type.'.boxza.com/'.(_::$type=='forum'?'':'forum/').'topic/'.$id,$ct_img,intval($c),new MongoDate());
	
		if(function_exists('hook_forum_new_topic'))
		{
			call_user_func_array('hook_forum_new_topic',array($id,$_POST));
		}
	//_::cache()->delete('ca1','deal_home',0);
		header('Location: '.FORUM_URL.'topic/'.$id);
		exit;
	}
	else
	{
		$error['title']='ไม่สามารถเพิ่มข้อมูลได้ ';	
	}
}

$template->assign('error',$error);
$template->assign('post',$_POST);
?>