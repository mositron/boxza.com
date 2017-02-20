<?php
function delabout($i)
{
	$db=_::db();
	if($about=$db->findone('about',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		if(_::$my['am'])
		{
			$db->update('about',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
			_::tags()->remove('about', $about['_id']);
			_::cache()->delete('ca1','about_home',0);
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



function newabout($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$t=trim($arg['title']);
	if(!$t)
	{
		$ajax->alert('กรุณาชื่อหัวข้อ');	
	}
	elseif($about=$db->findone('about',array('t'=>$t)))
	{
		_::move('/admin/'.$about['_id']);
	}
	else
	{
		$_=array(
			't'=>$t,
			'u'=>_::$my['_id'],
			'di'=>new mongodate()
		);
		
		if($id=$db->insert('about',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('about',array('_id'=>$id,array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2)))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>