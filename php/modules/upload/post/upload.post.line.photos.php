<?php

if($_FILES['file'] && $data['par'])
{
	$db=_::db();
	if($album=$db->findOne('line',array('_id'=>intval($data['par']),'ty'=>'album','dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'pt'=>1,'ds'=>1)))
	{
		if($album['u']==_::$my['_id'])
		{
			$num=array();
			if($f=$_FILES['file']['tmp_name'])
			{
				$size=@getimagesize($f);
				$type=false;
				switch(strtolower($size['mime']))
				{
					case 'image/gif':
						$type='gif';
						break;
					case 'image/jpg':
					case 'image/jpeg':
					case 'image/bmp':
					case 'image/wbmp':
					case 'image/png':
					case 'image/x-png':
						$type='jpg';
						break;
				}
				if($type && $size[0]>=200 && $size[1]>=200)
				{
					if($p = $db->insert('line',array('u'=>_::$my['_id'])))
					{
						$fd = _::folder()->fd($p);
						$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
						$name = substr($fd,4,2);
						if($n = _::photo()->thumb('o',$f,UPLOAD_FOLDER.'line/'.$folder,1200,1200,'inboth',$type))
						{
							_::photo()->thumb('m',$f,UPLOAD_FOLDER.'line/'.$folder,500,375,'inboth',$type);
							_::photo()->thumb('s',$f,UPLOAD_FOLDER.'line/'.$folder,200,120,'both',$type);
							$f = UPLOAD_PATH.'line/'.$folder.'/'.$n;
							$size=@getimagesize($f);
							$db->update('line',array('_id'=>$p),array('$set'=>array('ty'=>'photo','hi'=>1,'pt'=>array('a'=>$album['_id'],'e'=>$type,'fd'=>$fd,'f'=>$folder,'n'=>$n,'w'=>$size[0],'h'=>$size[1],'s'=>filesize($f)))));
							$status['status']='OK';
							$num=array('i'=>$p,'f'=>$folder,'n'=>$n,'w'=>$size[0],'h'=>$size[1],'e'=>$type);
							if(!is_array($album['pt']))$album['pt']=array('c'=>0,'l'=>0,'f'=>array());
							if(!is_array($album['pt']['f']))$album['pt']['f']=array();
							if(!isset($album['pt']['c']))$album['pt']['c']=0;
							if(!isset($album['pt']['l']))$album['pt']['l']=0;
							$album['pt']['l']=max(0,intval($album['pt']['l']))+1;
							$album['pt']['c']=max(0,intval($album['pt']['c']))+1;
							array_unshift($album['pt']['f'],$num);
							$album['pt']['f']=array_slice($album['pt']['f'],0,5);
							
							if(!$album['pt']['cv'])
							{
								$album['pt']['cv']=array('i'=>$p,'f'=>$folder,'n'=>$n,'e'=>$type);
							}
							
							if($album['ds']->sec > time()-(3600*6))
							{
								if($album['pt']['c']<3)
								{
									$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'],'hr'=>1),'$unset'=>array('hi'=>1)));
								}
								else
								{
									$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt']),'$unset'=>array('hi'=>1,'hr'=>1)));
								}
							}
							else
							{
								$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'],'ds'=>new MongoDate()),'$unset'=>array('hi'=>1,'hr'=>1)));
							}
							$status =array('status'=>'OK','message'=>'','_id'=>$num['i'],'img'=>'http://s1.boxza.com/line/'.$num['f'].'/s.'.$num['e']);
						}
						else
						{
							$db->remove('line',array('_id'=>$p));
							$status['message']='มีความผิดพลาดในการอัพโหลด';
						}
					}
				}
				else
				{
					$status['message']='รองรับไฟล์รูปภาพ และมีขนาดมากกว่าหรือเท่ากับ 200x200 เท่านั้น';
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
elseif(!$data['par'])
{
	$status['message']='ไม่มีอัลบั้มปลายทางที่ต้องการอัพโหลด';
}
	?>