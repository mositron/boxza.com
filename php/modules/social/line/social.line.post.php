<?php

_::session()->logged();

$status =array('status'=>'FAIL','message'=>'ข้อมูลรูปภาพไม่ถูกต้อง');


if($_FILES['photo']['tmp_name'])
{
	$db=_::db();
	$p=0;
	if($_POST['album'])
	{
		$album=$db->findone('line',array('_id'=>intval($_POST['album']),'u'=>_::$my['_id'],'ty'=>'album'));
	}
	if(!$album)
	{
		$album=$db->findone('line',array('u'=>_::$my['_id'],'ty'=>'album','lo'=>1));
	}
	if($album)
	{
		$size=@getimagesize($_FILES['photo']['tmp_name']);
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
		if(!$type)
		{
			$status['message']='สามารถแนบไฟล์รูปภาพได้เท่านั้น';
		}
		elseif($size[0]<1||$size[1]<1)
		{
			$status['message']='ขนาดไฟล์ไม่ถูกต้อง';
		}
		else
		{
			if($p = $db->insert('line',array('u'=>_::$my['_id'])))
			{
				try
				{
					$fd = _::folder()->fd($p);
					$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
					//$name = substr($fd,4,2);
					$status['message']=$p.' - '.$folder.' - '.$name;
					
					$q=_::upload()->send('s1','line-photo','@'.$_FILES['photo']['tmp_name'],array('type'=>$type,'folder'=>$folder));
					if($q['status']=='OK')
					{
						$status['status']='OK';
						$status['photo']=$p;
						
						if(!$album['lo'])
						{
							if(!is_array($album['pt']))$album['pt']=array('c'=>0,'l'=>0,'f'=>array());
							if($album['ds']->sec > time()-(3600*6))
							{
								$album['pt']['l']+=1;
								$uplast=false;
							}
							else
							{
								$album['pt']['l']=1;
								$uplast=true;
							}
							array_unshift($album['pt']['f'],array('i'=>$p,'f'=>$folder,'e'=>$type,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h']));
							$album['pt']['f']=array_slice($album['pt']['f'],0,5);
							$album['pt']['c']+=1;
							if($uplast)
							{
								$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'],'ex'=>new MongoDate(time()+_::$config['line_expire']),'ds'=>new MongoDate()),'$unset'=>array('hi'=>1)));
							}
							else
							{
								$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'],'ex'=>new MongoDate(time()+_::$config['line_expire'])),'$unset'=>array('hi'=>1)));
							}
							$db->update('line',array('_id'=>$p),array('$set'=>array('ty'=>'photo','hi'=>1,'ex'=>new MongoDate(time()+_::$config['line_expire']),'pt'=>array('a'=>$album['_id'],'e'=>$type,'fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
						}
						else
						{
							$db->update('line',array('_id'=>$p),array('$set'=>array('ty'=>'photo','ex'=>new MongoDate(time()+_::$config['line_expire']),'pt'=>array('a'=>$album['_id'],'e'=>$type,'fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
						}
					}
					else
					{
						$db->remove('line',array('_id'=>$p));
						$status['message']='ไม่สามารถอัพโหลดรูปภาพนี้ได้ ('.print_r($q,true).')';
					}
				}
				catch (Exception $e)
				{
					if($p)$db->remove('line',array('_id'=>$p));
					$status['message']='เกิดข้อผิดพลาด '.$e->getMessage().' ';
				}
			}
			else
			{
				$status['message']='ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้';
			}
		}
	}
	else
	{
		$status['message']='คุณยังไม่มีอัลบั้มสำหรับเก็บรูปภาพ';
	}
}
else
{
    switch ($_FILES['photo']['error'])
	 {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
				$status['message']='รูปภาพมีขนาดใหญ่เกินไป';
            break;
        case UPLOAD_ERR_PARTIAL:
				$status['message']='ข้อมูลรูปภาพไม่สมบูรณ์';
            break;
        case UPLOAD_ERR_NO_FILE:
				$status['message']='ไม่มีไฟล์ข้อมูลรูปภาพ';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
				$status['message']='ตำแหน่งเก็บ TEMP รูปภาพไม่ถูกต้อง';
            break;
        case UPLOAD_ERR_CANT_WRITE:
				$status['message']='ไม่สามารถบันทึกรูปภาพได้';
            break;
        case UPLOAD_ERR_EXTENSION:
				$status['message']='การอัพโหลดถูกขัดจังหวะ';
            break;
    }
}
echo json_encode($status);
exit;
?>