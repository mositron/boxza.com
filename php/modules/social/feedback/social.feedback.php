<?php

_::ajax()->register('newfeedback');



_::$meta['title'] = 'แจ้งปัญหา แนะนำ เสนอแนะ - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'แจ้งปัญหา แนะนำ เสนอแนะ - สังคมออนไลน์ของคนไทย';

$template=_::template();
$template->assign('service',_::sidebar()->service(array('line'=>1)));
_::$content=$template->fetch('feedback');
	

function newfeedback($arg)
{
	if(_::$my)
	{
		$db=_::db();
		$t=trim(strip_tags($arg['title']));
		$m=trim(strip_tags($arg['detail']));
		$c=trim(strip_tags($arg['cate']));
		if(!$t || !$m || !$c)
		{
			_::ajax()->alert('กรุณากรอกข้อมูลให้ครบถ้วน');
		}
		else
		{
			$m=array(
									't'=>mb_substr($t,0,40,'utf-8'),
									'm'=>mb_substr($m,0,3000,'utf-8'),
									'c'=>mb_substr($c,0,100,'utf-8'),
									'u'=>_::$my['_id'],
									);
			if($id=$db->insert('feedback',$m))
			{
			$user=_::user();
			$mail=_::mail();
			$u = $user->profile(_::$my['_id']);
			$mail->to='support@boxza.com';
			$mail->subject = '(แนะนำ/ติชม/แจ้งปัญหา) - '.$m['t'];
			$mail->message = nl2br('สมาชิก: <a href="http://boxza.com/'.$u['link'].'">'.$u['name'].'</a>'."\n\n".'ประเภทปัญหา: '.$c."\n\n".'หัวข้อ: '.$t."\n\n".'รายละเอียด: '.$m);
			$mail->send();
			
				_::ajax()->script('$("#feedback")[0].reset();$("#completed").css("display","block");_.hash.top()');
			}
			else
			{
				_::ajax()->alert('ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้ กรุณาลองใหม่ภายหลัง');
			}
		}
	}
	else
	{
		_::ajax()->alert('กรุณาล็อคอินก่อนใช้งานส่วนนี้');
	}
}
?>