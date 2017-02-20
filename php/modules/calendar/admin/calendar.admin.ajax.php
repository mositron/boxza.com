<?php
function delplace($i)
{
	$db=_::db();
	if($place=$db->findone('place',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		if(_::$my['am'])
		{
			$db->update('place',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
			_::cache()->delete('ca1','place_home',0);
			_::ajax()->redirect(URL);
		}
		else
		{
			_::ajax()->alert('คุณไม่มีสิทธ์ลบข่าวนี้');
		}
	}
	else
	{
		_::ajax()->redirect(URL);
	}
}



function newplace($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$fn=mb_strtolower(trim($arg['first']),'utf-8');
	$ln=mb_strtolower(trim($arg['last']),'utf-8');
	if(!$fn)
	{
		$ajax->alert('กรุณากรอกชื่อดารา');	
	}
	elseif(!$ln)
	{
		$ajax->alert('กรุณากรอกนามสกุลดารา');
	}
	elseif($place=$db->findone('place',array('fn'=>$fn,'ln'=>$ln)))
	{
		_::move('/admin/'.$place['_id']);
	}
	else
	{
		$_=array(
			'fn'=>$fn,
			'ln'=>$ln,
			'u'=>_::$my['_id'],
			'di'=>new mongodate()
		);
		
		if($id=$db->insert('place',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('place',array('_id'=>$id,array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2)))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>