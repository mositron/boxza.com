<?php
if(count($_FILES['upload']['tmp_name']) && is_array($_FILES['upload']['tmp_name']))
{
	$up='';
	$format=trim(strval($_POST['format']));
	for($i=0;$i<count($_FILES['upload']['tmp_name']);$i++)
	{
		if($f=$_FILES['upload']['tmp_name'][$i])
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
				$arg=array('u'=>intval($data['uid']),'n'=>$_FILES['upload']['name'][$i],'ty'=>$type,'s'=>SESIMAGE,'w'=>$size[0],'h'=>$size[1],'si'=>filesize($f),'ip'=>$_SERVER['REMOTE_ADDR']);
				$arg['rd']=$_GET['redirect_uri'];
				
				if($p = $db->insert('image',$arg))
				{
					$fd = _::folder()->fd($p);
					$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
					$fd2=ltrim($fd,'0');
					
					$q = _::upload()->send('s2','image-post','@'.$f,array('folder'=>$folder,'type'=>$type));
					if($q['status']=='OK')
					{
						$db->update('image',array('_id'=>$p),array('$set'=>array('f'=>$fd2,'fd'=>$folder)));					
						if($format=='html')
						{
							$up.="\r\n".'<a href="http://image.boxza.com/v/'.$fd2.'.'.$type.'" title=""><img src="http://i.boxza.com/'.$folder.'/m.'.$type.'" border="0" alt=""></a>'."\r\n";
						}
						else
						{
							$up.="\r\n".'[url=http://image.boxza.com/v/'.$fd2.'.'.$type.'][img]http://i.boxza.com/'.$folder.'/m.'.$type.'[/img][/url]'."\r\n";
						}
					}
					else
					{
						$db->remove('image',array('_id'=>$p));
					}
				}
			}
		}
	}
	if($up)
	{
		_::move($_GET['redirect_uri'].'?'.rawurlencode($up));
	}
}
	?>