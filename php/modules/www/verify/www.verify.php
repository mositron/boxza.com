<?php


$template=_::template();
$template->assign('service',_::sidebar()->service(array('line'=>1)));
_::$content=$template->fetch('verify');


_::$meta['title'] = 'กรุณายืนยันการสมัครสมาชิก - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'กรุณายืนยันการสมัครสมาชิก - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'กรุณายืนยันการสมัครสมาชิก, สังคมออนไลน์';
?>