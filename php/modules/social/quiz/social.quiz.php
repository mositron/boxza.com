<?php
//_::session()->logged();

$template=_::template();
if(_::$my['am'] && _::$my['am']>=9)
{
	_::ajax()->register('newquiz');
	_::$content=$template->fetch('quiz.post');
}
else
{
	_::move('/line');
}
echo $template->display();






function newquiz($arg)
{
	$point=intval($arg['point']);
	$question=trim($arg['quiz']);
	$answer=trim($arg['answer']);
	if($point && $question && $answer)
	{
		if($point > 25)
		{
			_::ajax()->alert('จำนวนบ๊อกมากเกินไป');
		}
		else
		{
			$insert=array(
												'u'=>0,
												'in'=>array(0),
												'tt'=>array('a'=>$answer,'p'=>$point),
												'ty'=>'quiz',
												'ms'=>trim(mb_substr(htmlspecialchars(stripslashes($question),ENT_QUOTES,'utf-8'),0,2048,'utf-8'))
												);
																		
			$update=_::db()->insert('line',$insert);
			_::move('/line/'.$update);
		}
	}
	else
	{
		_::ajax()->alert('ข้อมูลไม่ครบถ้วน');
	}
}

exit;
?>