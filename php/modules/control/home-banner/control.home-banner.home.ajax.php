<?php
function delbanner($i)
{
	$db=_::db();
	if($banner=$db->findone('banner',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		$db->update('banner',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
		_::ajax()->redirect('/home-banner');
	}
	else
	{
		_::ajax()->redirect(URL);
	}
}



function newbanner($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อข่าว');	
	}
	elseif(!$arg['position'])
	{
		$ajax->alert('กรุณาเลือกตำแหน่งการแสดงผล');	
	}
	else
	{
		$_=array(
			't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
			'ty'=>'home',
			'p'=>$arg['position'],
			'u'=>_::$my['_id'],
			'so'=>99
		);
		
		if($id=$db->insert('banner',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('banner',array('_id'=>$id),array('$set'=>array('fd'=>substr($fd,2,2).'/'.substr($fd,4,2))));
			$ajax->redirect('/home-banner/'.$id);
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>