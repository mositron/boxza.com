<?php


_::ajax()->register(array('newbrand'),'admin.car');

$db=_::db();
$brand=$db->find('car_brand',array(),array(),array('sort'=>array('en'=>1)));
/*
foreach($brand as $v)
{
	$db->update('car_brand',array('_id'=>$v['_id']),array('$set'=>array('en'=>$v['name'],'th'=>$v['name'])));	
}
*/



$a='audi
bmw
chevrolet
citroen
daihatsu
fiat
ford
honda
hyundai
isuzu
jaguar
jeep
kia
land-rover
lexus
mazda
mercedes-benz
mini
misubishi
nissan
peugeot
porsche
proton
rover
saab
seat
ssangyong
subaru
suzuki
tata
toyota
volkswagen
volvo';

$v=array_map('strtolower',array_map('trim',explode("\n",$a)));


$b=$db->find('car_brand',array('link'=>array('$in'=>$v)),array(),array('sort'=>array('en'=>1)));
for($i=0;$i<count($b);$i++)
{
	//echo $b[$i]['_id'].'=>array(\'t\'=>\''.$b[$i]['en'].'\'),'."\r\n";
	echo '\''.$b[$i]['link'].'\'=>'.$b[$i]['_id'].',';
}



$template=_::template();

$template->assign('brand',$brand);
_::$content=$template->fetch('admin.car.home');
?>