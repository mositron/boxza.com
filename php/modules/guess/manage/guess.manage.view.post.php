<?php

$error=array();
$arg=array();
$arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,50,'utf-8'));
$arg['d']=trim(mb_substr(strip_tags($_POST['detail']),0,150,'utf-8'));
$arg['c']=intval(trim($_POST['cate']));
$arg['pl']=($_POST['published']?1:0);
$ans=array();
for($i=0;$i<count($_POST['ans_id']);$i++)
{
	$ans_t=trim(mb_substr(strip_tags($_POST['ans_t'][$i]),0,100,'utf-8'));
	$ans_d=trim(mb_substr(strip_tags($_POST['ans_d'][$i]),0,500,'utf-8'));
	if(!$ans_t&&!$ans_d)
	{
		$error['answer']='กรุณากรอกผลลัพธ์ให้ครบถ่วน';
	}
	
	$ans[]=array(
							't'=>$ans_t,
							'd'=>$ans_d,
							'i'=>($app['ans']&&$app['ans'][$i]&&$app['ans'][$i]['i'])?$app['ans'][$i]['i']:''
	);
}
$arg['ans']=$ans;


$quest=array();
$no=count($_POST['ans_id']);
for($i=0;$i<count($_POST['quest_id']);$i++)
{
	$quest_t=trim(mb_substr(strip_tags($_POST['quest_t'][$i]),0,100,'utf-8'));
	$a1=$i*$no;
	$a2=$a1+$no;
	$quest_a=array();
	$ca=0;
	$cb=0;
	for($j=$a1;$j<$a2;$j++)
	{
		if($qa=trim(mb_substr(strip_tags($_POST['quest_a'][$j]),0,500,'utf-8')))
		{
			$ca++;
		}
		$quest_a[]=array('id'=>$cb,'t'=>strval($qa));
		$cb++;
	}
	$quest[]=array(
								't'=>$quest_t,
								'a'=>$quest_a
	);
	if($ca!=$no)
	{
		$error['qans']='กรุณากรอกคำตอบของคำถามให้ครบทุกช่อง';
	}
	if(!$quest_t)
	{
		$error['quest']='กรุณากรอกคำถามให้ครบถ่วน';
	}
}
$arg['quest']=$quest;



if(!$arg['t'])
{
	$error['title']='กรุณากรอกชื่อเกม';	
}
if(!$arg['d'])
{
	$error['detail']='กรุณากรอกคำอธิบายของเกม';	
}
if((!$arg['c'])||!isset($cate[$arg['c']]))
{
	$error['cate']='กรุณาเลือกหมวด';	
}
if(count($arg['ans'])<2)
{
	$error['answer']='กรุณากรอกผลลัพธ์ให้ครบถ้วนอย่างน้อย 2 ข้อ';
}
if(count($arg['quest'])<1)
{
	$error['question']='กรุณากรอกคำถามให้ครบถ้วนอย่างน้อย 1 ข้อ';
}

if(_::$my['am']>=9)
{
	$arg['rc']=($_POST['rc']?1:0);	
}
if(!count($error))
{
	if(_::$path[0]=='new')
	{
		$arg['u']=_::$my['_id'];
		$arg['do']=0;
		if($id=$db->insert('guess',$arg))
		{
			$app=$arg;
			$app['_id']=$id;
			$fd=_::folder()->fd($id);
			$app['fd']=substr($fd,2,2).'/'.substr($fd,4,2);
			$db->update('guess',array('_id'=>$id),array('$set'=>array('fd'=>$app['fd'])));
		}
	}
	else
	{
		$id=$app['_id'];
		$db->update('guess',array('_id'=>$id),array('$set'=>$arg));
	}
	
	
	if($f=$_FILES['photo']['tmp_name'])
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
				if($size[0]>=100 && $size[1]>=100)
				{
					$q=_::upload()->send('s3','guess-post','@'.$f,array('folder'=>$app['fd']));
					if($q['status']=='OK')
					{
						$db->update('guess',array('_id'=>$app['_id']),array('$set'=>array('img'=>$q['data']['n'])));	
					}
				}
		}
	}
	
	$tm=time();
	for($i=0;$i<count($_POST['ans_id']);$i++)
	{
		if(empty($_POST['ans_del'][$i]) && ($f=$_FILES['ans_i']['tmp_name'][$i]))
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
					if($size[0]>=100 && $size[1]>=100)
					{
						if($arg['ans']&&$arg['ans'][$i]&&$arg['ans'][$i]['i'])
						{
							$q=_::upload()->send('s3','delete','guess/'.$app['fd'].'/'.$arg['ans'][$i]['i']);
						}
					
						$q=_::upload()->send('s3','guess-answer','@'.$f,array('folder'=>$app['fd'],'name'=>$tm.'-'.$i));
						if($q['status']=='OK')
						{
							$db->update('guess',array('_id'=>$app['_id']),array('$set'=>array('ans.'.$i.'.i'=>$q['data']['n'])));	
						}
					}
			}
		}
	}
	for($i=0;$i<count($_POST['ans_del']);$i++)
	{
		if($_POST['ans_del'][$i]!='')
		{
			if($app['ans'][$_POST['ans_del'][$i]])
			{
				if($app['ans'][$_POST['ans_del'][$i]]['i'])
				{
					$q=_::upload()->send('s3','delete','guess/'.$app['fd'].'/'.$app['ans'][$_POST['ans_del'][$i]]['i']);
					$db->update('guess',array('_id'=>$app['_id']),array('$unset'=>array('ans.'.$_POST['ans_del'][$i]=>1)));	
					$db->update('guess',array('_id'=>$app['_id']),array('$pull'=>array('ans'=>NULL)));	
				}		
			}
		}
	}
	_::move('/manage/'.$app['_id'].'?completed');
}
else
{
	$app=array_merge($app,$arg);	
}

?>