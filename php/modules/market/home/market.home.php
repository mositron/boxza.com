<?php


//_::$meta['google']=array('id'=>'112235668332689047152');

$cache=_::cache();
#if(!_::$content=$cache->get('ca1','deal_home'))
#{
	//_::time();
	$db=_::db();
	$template=_::template();

	$pc=array();
	foreach($zone as $k=>$v)
	{
		if($k!=4)$pc[$k]=$db->find('deal_province',array('z'=>intval($k)),array('t'=>1,'c'=>1),array('sort'=>array('c'=>-1),'limit'=>5),false);
	}
	$template->assign('pc',$pc);
	
	
	$last=$db->find('deal',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('ds'=>-1),'limit'=>25));
	$rec=$db->find('deal',array('dd'=>array('$exists'=>false),'pl'=>1,'rc'=>array('$gte'=>1)),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('rc'=>1),'limit'=>5));
	$template->assign('last',$last);
	$template->assign('rec',$rec);
//	$template->assign('profile',$db->find('user',array('st'=>array('$gte'=>0)),array('if'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>25)));
	_::$content=$template->fetch('home');


	#$cache->set('ca1','deal_home',_::$content,false,3600);
#}
/*

//_::time();
$db=_::db();
$template=_::template();

$tmp = $db->find('deal_province',array('c'=>array('$gt'=>0),'_id'=>array('$in'=>array(2,24,19,29,60,62,13,14,23,38,53,6,21,28,74,77,18,33,64,66,67,7,8,9,16,50,1,22,42,58,68))));
$pc=array();
for($i=0;$i<count($tmp);$i++)
{
	$pc[$tmp[$i]['_id']]=$tmp[$i]['c'];
}
$last=$db->find('deal',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1),array('sort'=>array('da'=>-1),'limit'=>10));

$template->assign('pc',$pc);
$template->assign('last',$last);
_::$content=$template->fetch('home');
*/

/*
# เหนือ
							'5','13','14','23','26','34','37','38','40','41','45','53','54','75','76'
# ออก
							'7','8','9','16','31','50',
# อีสาน
							'4','6','11','20','21','27','28','43','44','46','48','55','56','57','63','69','70','71','73','74','77',
# ตก
							'3','17','30','39','51',
# กลาง
							'2','10','18','19','24','29','33','52','60','61','62','64','65','66','67','72',
# ใต้
							'1','12','15','22','25','32','35','36','42','47','49','58','59','68',

$zone = array(
						'1'=>array('n'=>'กรุงเทพและปริมลฑล','l'=>array(2,19,24,29,60,62)),
						'2'=>array('n'=>'ภาคเหนือ','l'=>array(5,13,14,23,26,34,37,38,40,41,45,53,54,75,76)),
						'3'=>array('n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>array(4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77)),
						'4'=>array('n'=>'ภาคตะวันตก','l'=>array(3,17,30,39,51)),
						'5'=>array('n'=>'ภาคตะวันออก','l'=>array(7,8,9,16,31,50)),
						'6'=>array('n'=>'ภาคกลาง','l'=>array(2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72)),
						'7'=>array('n'=>'ภาคใต้','l'=>array(1,12,15,22,25,32,35,36,42,47,49,58,59,68))
);
*/

?>