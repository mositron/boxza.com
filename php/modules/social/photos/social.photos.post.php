<?php
$status =array('status'=>'FAIL','message'=>'ข้อมูลรูปภาพไม่ถูกต้อง');

if(_::$my)
{
	if($_FILES['photo'] && $_POST['album'])
	{
		$db=_::db();
		if($album=$db->findOne('line',array('_id'=>intval($_POST['album']),'ty'=>'album','dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'pt'=>1,'ds'=>1)))
		{
			if($album['u']==_::$my['_id'])
			{
				$num=array();
				foreach($_FILES['photo']['tmp_name'] as $f)
				{
					if($f)
					{
						$size=@getimagesize($f);
						$type=false;
						switch (strtolower($size['mime']))
						{
							case 'image/gif':
								$type="gif";
								break;
							case 'image/jpg':
							case 'image/jpeg':
							case 'image/bmp':
							case 'image/wbmp':
								$type="jpg";
								break;
							case 'image/png':
							case 'image/x-png':
								//$type="png";
								$type="jpg";
								break;
						}
						if($type && $size[0]>=200 && $size[1]>=200)
						{
							if($p = $db->insert('line',array('u'=>_::$my['_id'])))
							{
								$fd = _::folder()->fd($p);
								$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
								//$name = substr($fd,4,2);
								$q=_::upload()->send('s1','line-photo','@'.$f,array('type'=>$type,'folder'=>$folder));
								if($q['status']=='OK')
								{
									$db->update('line',array('_id'=>$p),array('$set'=>array('ty'=>'photo','hi'=>1,'ex'=>new MongoDate(time()+_::$config['line_expire']),'pt'=>array('a'=>$album['_id'],'e'=>$type,'fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
									$status['status']='OK';
									$num[]=array('i'=>$p,'f'=>$folder,'e'=>$type,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h']);
								}
								else
								{
									$db->remove('line',array('_id'=>$p));
								}
							}
						}
						else
						{
							$status['message']='รองรับไฟล์รูปภาพ และมีขนาดมากกว่าหรือเท่ากับ 200x200 เท่านั้น';
						}
					}
				}
				if(count($num))
				{
					if(!is_array($album['pt']))$album['pt']=array('c'=>0,'l'=>0,'f'=>array());
					if($album['ds']->sec > time()-(3600*6))
					{
						$album['pt']['l']+=count($num);
						$uplast=false;
					}
					else
					{
						$album['pt']['l']=count($num);
						$uplast=true;
					}
					foreach($num as $n)
					{
						array_unshift($album['pt']['f'],$n);
					}
					$album['pt']['f']=array_slice($album['pt']['f'],0,5);
					$album['pt']['c']+=count($num);
					if($uplast)
					{
						$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'],'ex'=>new MongoDate(time()+_::$config['line_expire']),'ds'=>new MongoDate()),'$unset'=>array('hi'=>1)));
					}
					else
					{
						$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'],'ex'=>new MongoDate(time()+_::$config['line_expire'])),'$unset'=>array('hi'=>1)));
					}
				}
			}
			else
			{
				$status['message']='ไม่สามารถอัพโหลดรูปภาพไปยังอัลบั้มผู้อื่นได้';
			}
		}
		else
		{
			$status['message']='อัลบั้มไม่ถูกต้อง';
		}
	}
	elseif(!$_POST['album'])
	{
		$status['message']='ไม่มีอัลบั้มปลายทางที่ต้องการอัพโหลด';
	}
}
else
{
	$status['message']='กรุณาล็อคอินใหม่อีกครั้ง';
}
echo json_encode($status);
exit;
?>