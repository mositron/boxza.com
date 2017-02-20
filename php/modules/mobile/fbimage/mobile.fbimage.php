<?php

define('APP_VERSION','1.0');

$template=_::template();

$serv=array(
						''=>'home',
						'apps'=>'apps',
						'recent'=>'recent',
						'hit'=>'hit',
						'ref'=>'ref',
);


$ref=array(
						'160866484017913'=>'9GAG in Thai',
						'185668594895616'=>'คิดว่าดีก็ทำต่อไป',
						'377972818972771'=>'ความรู้ท่วมหัวเอาตัวไม่รอด',
						'119275421551380'=>'บ่นบ่น',
						'552419978152008'=>'กระดาษสีครีม',
						'276439945704187'=>'สมาคมกวนTEEN 18+',
						'215561678464052'=>'โสดแสนD',
						'558905540806815'=>'ว่าแล้ว\'',
						'145147339021153'=>'หน้ากลม',
						'332998630119285'=>'หมึกซึม',
						'390054464415577'=>'พอใจ',
						'294688280665847'=>'ลึกๆ',
						'418024494891447'=>'คมเกิ๊น',
						'206907329467617'=>'Minions thailand',
						'537003989706910'=>'The Smurfs Thailand',
						'313284625423348'=>'Dora GAG',
						'503977206328815'=>'Jaytherabbit',
						'425434517512362'=>'Eat All Day',
						'299590466830861'=>'Timixabie',
);

$template->assign('ref',$ref);
if(isset($serv[_::$path[0]]))
{
	require_once(__DIR__.'/mobile.fbimage.'.$serv[_::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.fbimage.home.php');
}


echo $template->fetch('fbimage');
exit;



function _getfile($i)
{
	return str_replace(array('_s.png','_s.jpg'),array('_o.png','_o.jpg'),$i);
}
?>