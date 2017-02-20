<?php
function delnews($i)
{
	$db=_::db();
	if($news=$db->findone('news',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		if($news['da']->sec<time()-(3600*24*EXPIRE_NEWS))
		{
			_::ajax()->alert('ข่าวนี้หมดอายุสำหรับการลบหรือแก้ไขแล้ว');
			return;	
		}
		if(_::$my['am'])
		{
			$db->update('news',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
			_::tags()->remove('news', $news['_id']);
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
			'u'=>_::$my['_id'],
		);
		
		
		$_cs=explode('-',trim($arg['type']));
		$_['c']=intval($_cs[0]);
		$_['cs']=intval($_cs[1]);
		$_['cs2']=intval($_cs[2]);
		
		if($id=$db->insert('news',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('news',array('_id'=>$id),array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>