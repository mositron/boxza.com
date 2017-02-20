<?php
$status =array('status'=>'FAIL','message'=>'เกิดปัญหาในการอัพโหลด');
if($_FILES['file_post']['tmp_name'] && $_POST['sesimage'])
{
	list($s,$p) = explode('.', $_POST['sesimage'], 2);
	$sig = base64_decode(strtr($s, '-_', '+/'));
	$data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);
	
	if($sig == hash_hmac('sha256', $p, $data['sesimage'].'-up-image-'.$data['uid'], true))
	{
		if($f=$_FILES['file_post']['tmp_name'])
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
					$type='jpg';
					break;
				case 'image/png':
				case 'image/x-png':
					$type='png';
					break;
			}
			if($type && $size[0]>=1 && $size[1]>=1)
			{
				$db=_::db();
				if($p = $db->insert('image',array('u'=>intval($data['uid']),'n'=>$_FILES['file_post']['name'],'ty'=>$type,'s'=>$data['sesimage'],'w'=>$size[0],'h'=>$size[1],'si'=>filesize($f),'ip'=>$_SERVER['REMOTE_ADDR'])))
				{
					$fd = _::folder()->fd($p);
					$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
					$fd2=ltrim($fd,'0');
					
					
					$q = _::upload()->send('s2','image-post','@'.$f,array('folder'=>$folder,'type'=>$type));
					if($q['status']=='OK')
					{
						$db->update('image',array('_id'=>$p),array('$set'=>array('f'=>$fd2,'fd'=>$folder)));
						$status =array('status'=>'OK','message'=>'','folder'=>$folder,'fd'=>$fd2,'type'=>$type);
					}
					else
					{
						$db->remove('image',array('_id'=>$p));
						$status['message'] = print_r($q,true);
					}
				}
			}
			else
			{
				$status['message'] = 'ไฟล์ไม่ถูกต้อง';
			}
		}
	}
}
echo json_encode($status);
exit;


?>