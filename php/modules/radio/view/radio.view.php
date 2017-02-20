<?php
if(preg_match('/(\d+)\.html$/',_::$path[0],$url))
{
	$r = intval($url[1]);
	if(isset($radio[$r]))
	{
		_::move('/'.$radio[$r]['l'],true);
	}
	else
	{
		_::move('/',true);
	}
}
if(!isset($rlink[_::$path[0]]))
{
	_::move('/',true);
}
$r=$rlink[_::$path[0]];

//_::$meta['google']=array('id'=>'112235668332689047152');


_::$meta['title'] = $radio[$r]['t'].' ฟังเพลง'.$radio[$r]['t'].' ฟังเพลงออนไลน์'.$radio[$r]['t'].' ฟังวิทยุออนไลน์'.$radio[$r]['t'].' วิทยุออนไลน์ ฟังเพลง24ชม';
_::$meta['description'] = $radio[$r]['t'].' ฟังเพลงออนไลน์'.$radio[$r]['t'].' ฟังเพลง'.$radio[$r]['t'].' ฟังวิทยุออนไลน์'.$radio[$r]['t'].' ฟังวิทยุออนไลน์ทุกคลื่นทั่วไทย ฟังเพลงรัก ฟังเพลงอกหัก ฟังเพลงใหม่ ทั้งไทยและสากลได้ที่นี่';
_::$meta['keywords'] = $radio[$r]['t'].', ฟังเพลง, วิทยุออนไลน์, ฟังวิทยุออนไลน์, ฟังเพลงออนไลน์, วิทยุออนไลน์, วิทยุ';


_::$meta['type']='article';
$template->assign('id',$r);
_::$content=$template->fetch('view');

?>