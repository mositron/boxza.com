<?php


_::move('http://www.boxzaracing.com'.URL,true);
exit;


# check session/login
_::session();

#_::$meta['file']='http://s0.boxza.com/files/global/logo-forum.png';
_::$meta['title'] = 'รถแต่ง รถแข่ง รถสวย บิ๊กไบค์ แต่งรถ ชุดแต่ง ล้อแม็ก ยางรถยนต์ อุปกรณ์แต่งรถ';
_::$meta['description'] = 'ศูนย์รวมรถแต่ง รถสวย รถแข่ง บิ๊กไบค์ แต่งรถ ชุดแต่ง ล้อแม็ก ยางรถยนต์ อุปกรณ์แต่งรถ อุปกรณ์ประดับยนต์ คลับรถ และอื่นๆเกี่ยวกับการแต่งรถ';
_::$meta['keywords'] = 'รถแต่ง, รถแข่ง, บิ๊กไบค์, แต่งรถ, รถสวย, ชุดแต่ง, ล้อแม็ก, ยางรถยนต์, อุปกรณ์แต่งรถ, ประดับยนต์';

define('CATE_NEWS',12);

$cate=array(
1=>array('t'=>'Alfa Romeo','l'=>'alfa-romeo'),
2=>array('t'=>'Aston Martin','l'=>'aston-martin'),
3=>array('t'=>'Audi','l'=>'audi'),
4=>array('t'=>'Bentley','l'=>'bentley'),
5=>array('t'=>'BMW','l'=>'bmw'),
6=>array('t'=>'Chery','l'=>'chery'),
7=>array('t'=>'Chevrolet','l'=>'chevrolet'),
8=>array('t'=>'Citroen','l'=>'citroen'),
9=>array('t'=>'Deva','l'=>'deva'),
10=>array('t'=>'DFSK','l'=>'dfsk'),
11=>array('t'=>'Ferrari','l'=>'ferrari'),
12=>array('t'=>'Fiat','l'=>'fiat'),
13=>array('t'=>'Ford','l'=>'ford'),
14=>array('t'=>'Honda','l'=>'honda'),
15=>array('t'=>'Hyundai','l'=>'hyundai'),
16=>array('t'=>'Isuzu','l'=>'isuzu'),
17=>array('t'=>'Jaguar','l'=>'jaguar'),
18=>array('t'=>'KIA','l'=>'kia'),
19=>array('t'=>'Lamborghini','l'=>'lamborghini'),
20=>array('t'=>'Land Rover','l'=>'land-rover'),
21=>array('t'=>'Lexus','l'=>'lexus'),
22=>array('t'=>'Lotus','l'=>'lotus'),
23=>array('t'=>'Maserati','l'=>'maserati'),
24=>array('t'=>'Mazda','l'=>'mazda'),
25=>array('t'=>'Mercedes-Benz','l'=>'mercedes-benz'),
26=>array('t'=>'Mini','l'=>'mini'),
27=>array('t'=>'Misubishi','l'=>'misubishi'),
28=>array('t'=>'Mitsuoka','l'=>'mitsuoka'),
29=>array('t'=>'Morgan','l'=>'morgan'),
30=>array('t'=>'Nissan','l'=>'nissan'),
31=>array('t'=>'Peugeot','l'=>'peugeot'),
32=>array('t'=>'Porsche','l'=>'porsche'),
33=>array('t'=>'Proton','l'=>'proton'),
34=>array('t'=>'Rolls-Royce','l'=>'rolls-royce'),
35=>array('t'=>'Skoda','l'=>'skoda'),
36=>array('t'=>'Spyker','l'=>'spyker'),
37=>array('t'=>'Ssangyong','l'=>'ssangyong'),
38=>array('t'=>'Subaru','l'=>'subaru'),
39=>array('t'=>'Suzuki','l'=>'suzuki'),
40=>array('t'=>'TATA','l'=>'tata'),
41=>array('t'=>'Thairung','l'=>'thairung'),
42=>array('t'=>'Toyota','l'=>'toyota'),
43=>array('t'=>'Volkswagen','l'=>'volkswagen'),
44=>array('t'=>'Volvo','l'=>'volvo'),
);



$db=_::db();

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	$data['_banner']=_::banner(_::$type);
	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}

$template=_::template();
$template->assign('_banner',$data['_banner']);


$route=array(
						'' => 'home',
						'forum'=>'forum',
						'team'=>'team',
						'chat'=>'chat',
						'admin'=>'admin',
);
require_once(
							_::run(
										array(
												'' => 'home'
										),
										true
						)
);

$template->display('content');

?>