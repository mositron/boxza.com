<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						'' => 'place',
						'place'=>'place',
						'news'=>'news',
						'apps'=>'apps',
);

$zone=array(
							1=>'ภาคเหนือ',
							2=>'ภาคตะวันออกเฉียงเหนือ (อีสาน)',
							3=>'ภาคกลาง',
							4=>'ภาคตะวันออก',
							5=>'ภาคใต้(ฝั่งตะวันออก)',
							6=>'ภาคใต้(ฝั่งตะวันตก)'
							);
$template->assign('zone',$zone);

if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.weather.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.weather.place.php');
}


echo $template->fetch('weather');
exit;
?>