<?php

_::move('http://www.autocar.in.th'.URL,true);
exit;

# check session/login
_::session();


define('NEWS_CATE',12);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'รถ ราคารถใหม่ รถใหม่ป้าย ราคารถ 2013-2014 -  รถ Honda Toyota Nissan Chevrolet Isuzu Mitsubishi';
_::$meta['description'] = 'ศูนย์รวมข้อมูลเกี่ยวกับรถ รถยนต์ ราคารถใหม่ รถใหม่ป้าย ราคา ฮอนด้า โตโยต้า นิสสัน เชฟโรเลต อีซูสุ มิตซูบิชิ  honda toyota nissan chevrolet isuzu mitsubishi';
_::$meta['keywords'] = 'รถ, ราคารถใหม่, รถใหม่ป้าย, ราคา, honda, toyota, nissan, chevrolet, isuzu, mitsubishi, ฮอนด้า, โตโยต้า, นิสสัน, เชฟโรเลต, อีซูสุ, มิตซูบิชิ ';
			

$clink=array('promotion'=>-1,'maintenance'=>-2,'center'=>-3,'auto'=>-4,'motorcycle'=>-5,'motorexpo'=>-6,'audi'=>3,'bmw'=>5,'chevrolet'=>7,'citroen'=>8,'daihatsu'=>57,'fiat'=>12,'ford'=>13,'honda'=>14,'hyundai'=>15,'isuzu'=>16,'jaguar'=>17,'jeep'=>69,'kia'=>18,'land-rover'=>20,'lexus'=>21,'mazda'=>24,'mercedes-benz'=>25,'mini'=>26,'mitsubishi'=>27,'nissan'=>30,'peugeot'=>31,'porsche'=>32,'proton'=>33,'rover'=>88,'saab'=>89,'seat'=>90,'ssangyong'=>37,'subaru'=>38,'suzuki'=>39,'tata'=>40,'toyota'=>42,'volkswagen'=>43,'volvo'=>44);
$rlink=array_flip($clink);
$cate=array(

						-1=>array('t'=>'โปรโมชั่นรถใหม่','l'=>$rlink[-1]),
						-2=>array('t'=>'วิธีบำรุงรักษา','l'=>$rlink[-2]),
						-3=>array('t'=>'ศูนย์บริการ','l'=>$rlink[-3]),
						-4=>array('t'=>'รถยนต์','l'=>$rlink[-4]),
						-5=>array('t'=>'มอเตอร์ไซค์','l'=>$rlink[-5]),
						-6=>array('t'=>'Motor Expo 2013 ','l'=>$rlink[-6]),
						3=>array('t'=>'Audi','l'=>$rlink[3]),
						5=>array('t'=>'BMW','l'=>$rlink[5]),
						7=>array('t'=>'Chevrolet','l'=>$rlink[7]),
						8=>array('t'=>'Citroen','l'=>$rlink[8]),
						57=>array('t'=>'Daihatsu','l'=>$rlink[57]),
						12=>array('t'=>'Fiat','l'=>$rlink[12]),
						13=>array('t'=>'Ford','l'=>$rlink[13]),
						14=>array('t'=>'Honda','l'=>$rlink[14]),
						15=>array('t'=>'Hyundai','l'=>$rlink[15]),
						16=>array('t'=>'Isuzu','l'=>$rlink[16]),
						17=>array('t'=>'Jaguar','l'=>$rlink[17]),
						69=>array('t'=>'Jeep','l'=>$rlink[69]),
						18=>array('t'=>'KIA','l'=>$rlink[18]),
						20=>array('t'=>'Land Rover'),
						21=>array('t'=>'Lexus','l'=>$rlink[21]),
						24=>array('t'=>'Mazda','l'=>$rlink[24]),
						25=>array('t'=>'Mercedes-Benz','l'=>$rlink[25]),
						26=>array('t'=>'Mini','l'=>$rlink[26]),
						27=>array('t'=>'Mitsubishi','l'=>$rlink[27]),
						30=>array('t'=>'Nissan','l'=>$rlink[30]),
						31=>array('t'=>'Peugeot','l'=>$rlink[31]),
						32=>array('t'=>'Porsche','l'=>$rlink[32]),
						33=>array('t'=>'Proton','l'=>$rlink[33]),
						88=>array('t'=>'Rover','l'=>$rlink[88]),
						89=>array('t'=>'Saab','l'=>$rlink[89]),
						90=>array('t'=>'Seat','l'=>$rlink[90]),
						37=>array('t'=>'Ssangyong','l'=>$rlink[37]),
						38=>array('t'=>'Subaru','l'=>$rlink[38]),
						39=>array('t'=>'Suzuki','l'=>$rlink[39]),
						40=>array('t'=>'TATA','l'=>$rlink[40]),
						42=>array('t'=>'Toyota','l'=>$rlink[42]),
						43=>array('t'=>'Volkswagen','l'=>$rlink[43]),
						44=>array('t'=>'Volvo','l'=>$rlink[44]),
);


$template=_::template();
$template->assign('cate',$cate);

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner(_::$type);
	
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto']=$lotto[0];

	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);
$template->assign('lotto',$data['lotto']);


require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'news'=>'news',
																	'forum'=>'forum',
													),
													true,
													function()
													{
														global $clink;
														if(isset($clink[_::$path[0]]))
														{	
															define('MODULE','news');
															define('MODULE_LINK',_::$path[0]);
															array_shift(_::$path);
														}
														else
														{
															_::move('/');	
														}
													}
									)
);


$template->display('content');


?>