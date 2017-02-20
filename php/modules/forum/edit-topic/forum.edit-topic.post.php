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

if($topic['fd']&&$topic['s'])
{
	$ct_img='http://s3.boxza.com/forum/'.$topic['fd'].'/'.$topic['s'];
}

if(_::$my['am'])
{
	if(_::$my['am']>=9)
	{
		$arg['sk']=($_POST['sticky']?1:0);
	}
	$arg['lo']=($_POST['lock']?1:0);
	$arg['rc']=($_POST['recommend']?1:0);
}
elseif($topic['lo'])
{
	$error['title']='กระทู้นี้ถูกล็อคแล้ว ไม่สามารถแก้ไขได้';
}
$arg['ic']=max(1,min(14,intval($_POST['icon'])));

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

if($_POST['moveforum'])
{
	$arg['c']=intval($_POST['moveforum']);
	if(!isset($cate[$arg['c']]) || !$cate[$arg['c']]['n'])
	{
		$error['cate']='ไม่สามารถย้ายไปยังหมวดฟอรั่มดังกล่าวได้';
	}
}

if(is_array($cate[$topic['c']]['a']))
{
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


	$db->update('forum',array('_id'=>$topic['_id']),array('$set'=>$arg,'$push'=>array('e'=>array('u'=>_::$my['_id'],'t'=>new MongoDate(),'ip'=>$_SERVER['REMOTE_ADDR']))));
	
	if($arg['c'] && ($topic['c']!=$arg['c']))
	{
		$db->update('forum_cate',array('_id'=>intval($arg['c'])),array('$inc'=>array('tp'=>1)));
		$db->update('forum_cate',array('_id'=>intval($topic['c'])),array('$inc'=>array('tp'=>-1)));
	}
	if(!$topic['fd'])
	{
		$fd = _::folder()->fd($topic['_id']);
		$topic['fd'] = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
		$db->update('forum',array('_id'=>$topic['_id']),array('$set'=>array('fd'=>$topic['fd'])));
	}
	if(is_array($_POST['delo'])&&count($_POST['delo']))
	{
		foreach($_POST['delo'] as $v)
		{
			if($v && $topic['o'][$v])
			{
				_::upload()->send('s3','delete','forum/'.$topic['fd'].'/'.$topic['o'][$v]);
				$db->update('forum',array('_id'=>$topic['_id']),array('$unset'=>array('o.'.$v=>1)));
			}
		}
	}
	if(is_array($cate[$topic['c']]['a']))
	{
		$_img=array(
										's'=>array(100,100),
										't'=>array(250,250),
										't2'=>array(700,1000),
		);
		
		if($cate[$topic['c']]['a']['t'])
		{
			if(is_array($cate[$topic['c']]['a']['t']))
			{
				$_ci=$cate[$topic['c']]['a']['t'];
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
		
		if(_::$my['am'] && $cate[$topic['c']] && $cate[$topic['c']]['a'] && $cate[$topic['c']]['a']['a'])
		{
			$_limita=intval($cate[$topic['c']]['a']['a']);
		}
		elseif((!_::$my['am']) && $cate[$topic['c']] && $cate[$topic['c']]['a'] && $cate[$topic['c']]['a']['m'])
		{
			$_limita=intval($cate[$topic['c']]['a']['m']);
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
									$q=_::upload()->send('s3','forum-post','@'.$f,array('index'=>$i,'folder'=>$topic['fd'],'size'=>$_img));
								
									if($q['status']=='OK')
									{
										_::upload()->send('s3','watermark','forum/'.$topic['fd'].'/'.$q['data']['n'],array('watermark'=>'forum/watermark2.png'));
										$set=array('o.'.$i=>$q['data']['n']);
										if($i==1&&$q['data']['s'])
										{
											$set['s']=$q['data']['s'];
											$ct_img='http://s3.boxza.com/forum/'.$topic['fd'].'/'.$set['s'];
										}
										$db->update('forum',array('_id'=>$topic['_id']),array('$set'=>$set));
									}
								}
								break;
						}
					}
				}
			}
		}
		
		if(($f=$cate[$topic['c']]['a']['f']) && is_array($f))
		{
			$_f=array();
			foreach($f as $fk=>$fv)
			{
				$_f[$fk]=trim(strip_tags($_POST['f_'.$fk]));
			}
			$db->update('forum',array('_id'=>$topic['_id']),array('$set'=>array('f'=>$_f)));
		}		
		
	}
	
	_::tags()->update($_POST['tags'], 'forum', $topic['_id'],$arg['t'],$arg['d'],'http://'._::$type.'.boxza.com/'.(_::$type=='forum'?'':'forum/').'topic/'.$topic['_id'],$ct_img,intval($arg['c']),$topic['da']);
		
	_::move(FORUM_URL.'topic/'.$topic['_id']);
}

$template->assign('error',$error);
$template->assign('post',$_POST);
?>