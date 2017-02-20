<?php

_::session()->logged();

_::ajax()->register('saveset');
#$cache=_::cache();

//_::time();
	$db=_::db();
	
$template->assign('user',$db->findone('user',array('_id'=>_::$my['_id']),array('_id'=>1,'sg'=>1,'da'=>1,'fr'=>1)));
_::$content=$template->fetch2(FORUM_TPL.'setting');





function saveset($arg)
{
	$ajax=_::ajax();
	$sig=trim($arg['detail']);
	$badword = '('.implode('|',require(HANDLERS.'boxza/badword.php')).')';
	
	if(preg_match('/'.$badword.'/i',$sig,$bw))
	{
		$error['title']='ไม่สามารถใช้คำว่า "'.$bw[1].'" ในลายเซ็นต์ได้';
	}
	elseif(preg_match('/\<(script|style|iframe|embed)([^\>]*)\>/i',$sig))
	{
		$error['title']='ไม่สามารถใช้งาน &lt;script&gt;, &lt;style&gt;, &lt;iframe&gt;, &lt;embed&gt;ได้';
	}
	elseif(mb_strlen($sig,'utf-8')>1000)
	{
		$ajax->alert('ลายเซ้นต์ของคุณยาวเกินไป (สุงสุด 1,000ตัวอักษร)');
	}
	else
	{
		_::user()->update(_::$my['_id'],array('$set'=>array('sg'=>$sig)));
		$ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
	}
}
?>