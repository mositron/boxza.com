<?php
function delnews($i)
{
	$db=_::db();
	if($news=$db->findone('news',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		if(_::$my['am'])
		{
			$db->update('news',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
			_::cache()->delete('ca1','news_home',0);
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



function newnews($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อข่าว');	
	}
	elseif(!$arg['type'])
	{
		$ajax->alert('กรุณาเลือกประเภทข่าว');	
	}
	else
	{
		$_=array(
			't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
			'c'=>intval($arg['type']),
			'u'=>_::$my['_id'],
		);
		
		if($id=$db->insert('news',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('news',array('_id'=>$id,array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2)))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>