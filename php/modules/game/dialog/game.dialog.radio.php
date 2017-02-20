<?php

_::ajax()->register(array('kickdj'));

$cache=_::cache();
if(!$ct=$cache->get('ca1','chat_radio_pj_1'))
{
	//_::time();
	/*
	$pj=array(
						array('u'=>18121,'t'=>'05.00 - 07.00'),
						array('u'=>53167,'t'=>'14.00 - 16.00<br>(จันทร์กับเสาร์ 17.00 - 18.00)'),
				//		array('u'=>55555,'t'=>'18.00 - 20.00'),
						array('u'=>54724,'t'=>'20.00 - 22.00'),
						array('u'=>26970,'t'=>'22.00 - 00.00'),
	
	);
	*/
	$template=_::template();
	$template->assign('user',_::user());
	$template->assign('kick',_::db()->find('chat_radio',array(),array(),array('sort'=>array('_id'=>-1),'limit'=>20)));
	//$template->assign('pj',$pj);
	$ct = $template->fetch2('game.dialog.radio');
	$cache->set('ca1','chat_radio_pj_1',$ct,false,60);
}
echo $ct;
exit;




function kickdj()
{
	$ajax=_::ajax();
	$pj=array(1,66426,55555,163745,99999);
	if(_::$my && in_array(_::$my['_id'],$pj))
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://115.178.60.121:8000/admin.cgi?mode=kicksrc');
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.11) Gecko/2009060215 Firefox/3.0.11 (.NET CLR 3.5.30729)');
		curl_setopt($ch, CURLOPT_USERPWD, 'admin:4kick2autodj');
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		$ajax->alert('เตะ Auto DJ / PJ เรียบร้อยแล้ว - '.$data);
		_::db()->insert('chat_radio',array('u'=>_::$my['_id']));
	}
	else
	{
		$ajax->alert('คุณไม่มีสิทธิ์เตะ Auto DJ / PJ');
	}
}
?>