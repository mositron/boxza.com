<?php
_::session()->logged();

$status =array('status'=>'FAIL','message'=>'not found');
if(_::$profile['_id']==_::$my['_id'])
{
	if($_POST['upload_bg'])
	{
		if(!is_array(_::$profile['pf']))_::$profile['pf']=array();
		if(!is_array(_::$profile['pf']['bg']))_::$profile['pf']['bg']=array();
			
		if($_POST['delete'] && _::$profile['pf']['bg']['url'])
		{
			_::upload()->send('s1','delete','profile/'._::$profile['if']['fd'].'/'._::$profile['pf']['bg']['url']);
			_::user()->update(_::$my['_id'],array('$set'=>array('pf.bg.url'=>'')));
		}
		_::user()->update(_::$my['_id'],array('$set'=>array(
																																'pf.bg.pos'=>mb_substr(trim($_POST['position']),0,20,'utf-8'),
																																'pf.bg.rep'=>mb_substr(trim($_POST['repeat']),0,20,'utf-8'),
																																'pf.bg.alp'=>intval(trim($_POST['alpha'])),
																																'pf.bg.fix'=>(strval($_POST['fixed'])?1:0),
																																'pf.bg.col'=>preg_match('/^([0-9a-f]{3,6})$/i',trim($_POST['color']),$c)?$c[1]:'',
																																)));
		if($_FILES['background']['tmp_name'])
		{
			if(_::$profile['pf']['bg']['url'])
			{
				_::upload()->send('s1','delete','profile/'._::$profile['if']['fd'].'/'._::$profile['pf']['bg']['url']);
				_::user()->update(_::$my['_id'],array('$set'=>array('pf.bg.url'=>'')));
			}
			$q=_::upload()->send('s1','upload','@'.$_FILES['background']['tmp_name'],array('name'=>'bg-'.rand(1,99),'folder'=>'profile/'._::$profile['if']['fd'],'width'=>5000,'height'=>5000,'fix'=>'width','type'=>'jpg'));
			if($q['status']=='OK')
			{
				_::user()->update(_::$my['_id'],array('$set'=>array('pf.bg.url'=>$q['data']['n'])));
			}
		}
		_::move(URL);
	}
	elseif($_FILES['header'])
	{
		if($_FILES['header']['tmp_name'])
		{
			$db=_::db();
			$f=$_FILES['header']['tmp_name'];
			if(!$album=$db->findOne('line',array('u'=>_::$my['_id'],'ty'=>'album','lo'=>2),array('tt'=>1,'_id'=>1)))
			{
				$album=array('_id'=>($db->insert('line',array('u'=>_::$my['_id'],'tt'=>'รูปภาพหน้าปก','ty'=>'album','lo'=>2,'hi'=>1,'in'=>array(0)))));
			}
		
			if($p = $db->insert('line',array('u'=>_::$my['_id'])))
			{
				$fd = _::folder()->fd($p);
				$folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
				$q=_::upload()->send('s1','line-photo','@'.$f,array('folder'=>$folder,'width'=>840,'height'=>400,'fix'=>'width','type'=>'jpg'));
				if($q['status']=='OK')
				{
					$q2=_::upload()->send('s1','upload','@'.$f,array('name'=>'hd','folder'=>'profile/'._::$profile['if']['fd'],'width'=>840,'height'=>400,'fix'=>'width','type'=>'jpg'));
					
					$db->update('line',array('_id'=>$p),array('$set'=>array('ty'=>'cover','pt'=>array('a'=>$album['_id'],'e'=>'jpg','fd'=>$fd,'f'=>$folder,'n'=>$q['data']['n'],'w'=>$q['data']['w'],'h'=>$q['data']['h'],'s'=>$q['data']['s']))));
					$db->update('line',array('u'=>_::$my['_id'],'_id'=>array('$ne'=>$p),'ty'=>'cover','pt.a'=>$album['_id']),array('$set'=>array('hi'=>1)),array('multiple'=>true));
					
					if(!is_array(_::$profile['pf']))_::$profile['pf']=array();
					_::$profile['pf']['hd']=$q2['data']['n'];
					_::user()->update(_::$my['_id'],array('$set'=>array('pf'=>_::$profile['pf'])));
					$status['status']='OK';
					$status['pic']='http://s1.boxza.com/profile/'._::$profile['if']['fd'].'/'.$q2['data']['n'].'?'.rand(1,999);
					$status['update']='header';
					
				}
				else
				{
					$db->remove('line',array('_id'=>$p));
					$status['message']=$q['message'];
				}
			}
			else
			{
				$status['message']='ชนิดไฟล์ไม่ถูกต้อง';
			}
		}
	}
	elseif($_FILES['avatar'])
	{
		if($_FILES['avatar']['tmp_name'])
		{
			$size=@getimagesize($_FILES['avatar']['tmp_name']);
			$t='jpg';			
			switch (strtolower($size['mime']))
			{
				case 'image/gif':
					$t='gif';
					break;
				case 'image/jpg':
				case 'image/jpeg':
				case 'image/bmp':
				case 'image/wbmp':
				case 'image/png':
				case 'image/x-png':
			}
		
			if($size[0]<1||$size[1]<1)
			{
				$status['message']='ขนาดไฟล์ไม่ถูกต้อง';
			}
			elseif($t=='gif')
			{
				if(!is_array(_::$my['pf']))_::$my['pf']=array();
				_::$my['pf']['av']='gif';
				
				$q=_::upload()->send('s1','profile-gif','@'.$_FILES['avatar']['tmp_name'],array('folder'=>_::$my['if']['fd']));
				if($q['status']=='OK')
				{
					_::user()->update(_::$my['_id'],array('$set'=>array('pf'=>_::$my['pf'])));
					$status['status']='OK';
					$status['pics']='http://s1.boxza.com/profile/'._::$profile['if']['fd'].'/s.gif?v='.rand(1,9999);
					$status['picn']='http://s1.boxza.com/profile/'._::$profile['if']['fd'].'/n.gif?v='.rand(1,9999);
					$status['update']='avatar-gif';
				}
				else
				{
					$status['message']='การอัพโหลด gifไม่ถูกต้อง';
				}
			}
			else
			{
				$q=_::upload()->send('s1','upload','@'.$_FILES['avatar']['tmp_name'],array('name'=>'o','folder'=>'profile/'._::$profile['if']['fd'],'width'=>500,'height'=>500,'fix'=>'width','type'=>'jpg'));
				if($q['status']=='OK')
				{
					if(!is_array(_::$my['pf']))_::$my['pf']=array();
					_::$my['pf']['av']='jpg';
					_::user()->update(_::$my['_id'],array('$set'=>array('pf'=>_::$my['pf'])));
					$status['status']='OK';
					$status['pic']='http://s1.boxza.com/profile/'._::$profile['if']['fd'].'/'.$q['data']['n'].'?'.rand(1,999);
					$status['update']='avatar';
				}
				else 
				{
					$status['message']='ชนิดไฟล์ไม่ถูกต้อง';
				}
			}
		}
	}
}
echo json_encode($status);
exit;

?>