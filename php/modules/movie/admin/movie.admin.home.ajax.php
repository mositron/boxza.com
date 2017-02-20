<?php
function delmovie($id)
{
	$db=_::db();
	if($movie=$db->findone('movie',array('_id'=>intval($id),'dd'=>array('$exists'=>false))))
	{
		_::upload()->send('s3','delete','movie/'.$movie['fd'].'/s.jpg');
		_::upload()->send('s3','delete','movie/'.$movie['fd'].'/m.jpg');
		_::upload()->send('s3','delete','movie/'.$movie['fd'].'/l.jpg');
		for($i=1;$i<=5;$i++)
		{
			_::upload()->send('s3','delete','movie/'.$movie['fd'].'/'.$movie['o'.$i]);
		}
		for($i=1;$i<=10;$i++)
		{
			_::upload()->send('s3','delete','movie/'.$movie['fd'].'/s-'.$movie['w'.$i]);
			_::upload()->send('s3','delete','movie/'.$movie['fd'].'/'.$movie['w'.$i]);
		}
		$db->update('movie',array('_id'=>$movie['_id']),array('$set'=>array('dd'=>new MongoDate())));
		_::cache()->delete('ca1','movie_home',0);
			
	}
	_::ajax()->redirect(URL);
}



function newmovie($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อหนัง');	
	}
	elseif(!$arg['type'])
	{
		$ajax->alert('กรุณาเลือกชนิดของหนัง');	
	}
	else
	{
		$_=array(
			't'=>mb_substr(trim($arg['title']),0,100),
			'ty'=>mb_substr(trim($arg['type']),0,50),
			'u'=>_::$my['_id'],
			'cs'=>1,
		);
		$_['l']=_::format()->link($_['t'],false);
		
		if($id=$db->insert('movie',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('movie',array('_id'=>$id,array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2)))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->show('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>