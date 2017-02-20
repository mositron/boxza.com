<?php
function dellotto($i)
{
	$db=_::db();
	if($lotto=$db->findone('lotto',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		$db->update('lotto',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
		_::cache()->delete('ca1','lotto_home',0);
			
	}
	_::ajax()->redirect(URL);
}



function newlotto($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	if(!$arg['day']||!$arg['month']||!$arg['year'])
	{
		$ajax->alert('กรุณากรอกข้อมูลให้ครบถ้วน');	
	}
	else
	{
		$t='ตรวจหวย งวดที่ '.$arg['day'].' '.(time::$month[$arg['month']-1]).' '.($arg['year']+543);
		$_=array(
			'tm'=>new MongoDate(strtotime($arg['year'].'-'.$arg['month'].'-'.$arg['day'])),
			'l'=>_::format()->link($t,false),
			'u'=>_::$my['_id'],
		);
		
		if($id=$db->insert('lotto',$_))
		{
			$ajax->redirect('/admin/'.$id);
		}
		else
		{
			$ajax->show('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}
?>