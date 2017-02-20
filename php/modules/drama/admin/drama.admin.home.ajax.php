<?php
function deldrama($i)
{
	$db=_::db();
	if($drama=$db->findone('drama',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		$db->update('drama',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
		_::cache()->delete('ca1','drama_home',0);
		_::ajax()->redirect(URL);
	}
	else
	{
		_::ajax()->redirect(URL);
	}
}



function newdrama($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อเรื่อง');	
	}
	elseif(!$arg['type'])
	{
		$ajax->alert('กรุณาเลือกช่อง');	
	}
	else
	{
		$_=array(
			't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
			'u'=>_::$my['_id'],
		);
		
		$_['c']=intval($arg['type']);
		if($id=$db->insert('drama',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('drama',array('_id'=>$id,array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2)))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>