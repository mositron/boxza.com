<?php
function delpeople($i)
{
	$db=_::db();
	if($people=$db->findone('people',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		if(_::$my['am'])
		{
			$db->update('people',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
			_::tags()->remove('people', $people['_id']);
			_::cache()->delete('ca1','people_home',0);
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



function newpeople($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$fn=trim($arg['first']);
	$ln=trim($arg['last']);
	if(!$fn)
	{
		$ajax->alert('กรุณากรอกชื่อดารา');	
	}
	elseif(!$ln)
	{
		$ajax->alert('กรุณากรอกนามสกุลดารา');
	}
	elseif($people=$db->findone('people',array('fn'=>$fn,'ln'=>$ln)))
	{
		_::move('/admin/'.$people['_id']);
	}
	else
	{
		$_=array(
			'fn'=>$fn,
			'ln'=>$ln,
			'u'=>_::$my['_id'],
			'di'=>new mongodate()
		);
		
		if($id=$db->insert('people',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('people',array('_id'=>$id,array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2)))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>