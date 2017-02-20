<?php
function delgame($i)
{
	$db=_::db();
	if($game=$db->findone('game',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		$db->update('game',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
		
		_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/s.jpg');
		_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/t.jpg');
		_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/m.jpg');
		_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/l.jpg');
		for($i=1;$i<=5;$i++)
		{
			if($game['o'.$i])
			{
				_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/'.$game['o'.$i]);
			}
		}
		_::upload()->send('s3','delete','game/flash/'.$game['fd'].'/'.$game['swf']['n']);
				
		_::cache()->delete('ca1','game_home',0);
			
	}
	_::ajax()->redirect(URL);
}



function newgame($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อเกมส์');	
	}
	else
	{
		$_=array(
			't'=>mb_substr(trim($arg['title']),0,100),
			'u'=>_::$my['_id'],
		);
		$_['l']=_::format()->link($_['t'],false);
		if($id=$db->insert('game',$_))
		{
			$fd = _::folder()->fd($id);
			$db->update('game',array('_id'=>$id,array('$set'=>array('fd'=>substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2)))));
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->show('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>