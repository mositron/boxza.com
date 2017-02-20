<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'ข่าว ข่าววันนี้ ข่าวเด่น ข่าวสังคมออนไลน์ ข่าวเกมส์ ข่าวเทคโนโลยี ข่าวภาพยนตร์ ข่าวกีฬา ข่าวไลฟ์สไตล์ ข่าวหวย';
_::$meta['description'] = 'ข่าว ข่าววันนี้ ข่าวเด่น ข่าวสังคมออนไลน์ ข่าวติดกระแส  เกาะติด ข่าวเด็ดประเด็นข่าวร้อน ใหม่ สด ทันเหตุการณ์ จากทุกสำนักข่าว ถูกรวบรวมไว้ที่นี่';
_::$meta['keywords'] = 'ข่าว, ข่าววันนี้, ข่าวเด่น, ข่าวสังคมออนไลน์, ข่าวติดกระแส, การเมือง, เศรษฐกิจ, อาชญากรรม, เทศโนโลยี, สังคม, กีฬา, ท่องเที่ยว';

$clink=array('entertain'=>4,'game'=>2,'technology'=>3,'movie'=>5,'lifestyle'=>6,'secret'=>7,'sport'=>1,'football'=>11,'private'=>8,'politic'=>9,'general'=>10,'social'=>13,'car'=>12,'home'=>14,'travel'=>15,'baby'=>16,'wedding'=>17,'pet'=>18,'education'=>19,'horo'=>20,'weather'=>21,'lotto'=>22,'health'=>23,'music'=>24,'asiangames'=>25,'korea'=>26,'beauty'=>27);
$rlink=array_flip($clink);
$cate=array(
'10'=>array('t'=>'ทั่วไป','l'=>$rlink[10]),
'9'=>array('t'=>'การเมือง','l'=>$rlink[9],'s'=>array(
																												1=>array('t'=>'ข่าวการเมือง'),
																											),
																											'sl'=>'http://politic.boxza.com/'
),
'1'=>array('t'=>'กีฬา','l'=>$rlink[1]),
'11'=>array('t'=>'ฟุตบอล','l'=>$rlink[11],'s'=>array(							
																												1=>array('t'=>'ไทย'),
																												2=>array('t'=>'อังกฤษ'),
																												3=>array('t'=>'สเปน'),
																												4=>array('t'=>'อิตาลี่'),
																												5=>array('t'=>'เยอรมนี'),
																												6=>array('t'=>'ฝรั่งเศษ'),
																												7=>array('t'=>'อื่นๆ'),
																												8=>array('t'=>'โลก'),
																												9=>array('t'=>'วิเคราะห์บอล'),
																											),
																											'sl'=>'http://www.teededball.com/'
),
'2'=>array('t'=>'เกมส์','l'=>$rlink[2],'s'=>array(
																												1=>array('t'=>'เกมส์ออนไลน์'),
																												2=>array('t'=>'เกมส์บนเว็บ'),
																												3=>array('t'=>'เกมส์ PC'),
																												4=>array('t'=>'เกมส์ Console'),
																												5=>array('t'=>'เกมส์มือถือ แท็บเล็ต'),
																											),
																											'sl'=>'http://game.boxza.com/'
),
'3'=>array('t'=>'เทคโนโลยี','l'=>$rlink[3],'s'=>array(
																												1=>array('t'=>'ข่าวไอที'),
																												2=>array('t'=>'ทิป-เทคนิค'),
																												3=>array('t'=>'บทความน่ารู้'),
																												4=>array('t'=>'Gadget'),
																												5=>array('t'=>'แอพแนะนำ'),
																											),
																											'sl'=>'http://tech.boxza.com/'
),
'4'=>array('t'=>'บันเทิง','l'=>$rlink[4],'s'=>array(
																												1=>array('t'=>'ซุบซิบดารา'),
																												2=>array('t'=>'ข่าวติดกระแส'),
																												3=>array('t'=>'คลิปดารา'),
																												4=>array('t'=>'ข่าวกิจกรรม'),
																												5=>array('t'=>'ข่าวบันเทิงอินเตอร์/ฮอลลีวู้ด'),
																												6=>array('t'=>'ข่าวบันเทิงเอเชีย/เกาหลี/ญี่ปุ่น'),
																												7=>array('t'=>'เรื่องย่อละคร','s'=>array(
																																																			1=>array('t'=>'ละครช่อง 3'),
																																																			2=>array('t'=>'ละครช่อง 5'),
																																																			3=>array('t'=>'ละครช่อง 7'),
																																																			4=>array('t'=>'ละครช่อง 9'),
																																																			5=>array('t'=>'ละครช่อง ThaiPBS'),
																												)),
																											),
																											'sl'=>'http://entertain.boxza.com/'
),
'5'=>array('t'=>'ภาพยนตร์','l'=>$rlink[5],'s'=>array(
																												1=>array('t'=>'ข่าวหนัง')
																						)
																						,'sl'=>'http://movie.boxza.com/'
),
'24'=>array('t'=>'เพลง','l'=>$rlink[24],'s'=>array(
																												1=>array('t'=>'ข่าวเพลง')
																						)
																						,'sl'=>'http://music.boxza.com/'
),
'6'=>array('t'=>'ไลฟ์สไตล์','l'=>$rlink[6]),
'8'=>array('t'=>'โดนๆ','l'=>$rlink[8]),
'13'=>array('t'=>'สังคมออนไลน์','l'=>$rlink[13]),
'7'=>array('t'=>'ลึกลับ','l'=>$rlink[7]),
'22'=>array('t'=>'ตรวจหวย','l'=>$rlink[22],'s'=>array(
																											1=>array('t'=>'เลขเด็ด'),
																											),
																											'sl'=>'http://lotto.boxza.com/'
),

'20'=>array('t'=>'ดูดวง','l'=>$rlink[20],'s'=>array(
																												1=>array('t'=>'ดูดวงรายวัน'),
																												4=>array('t'=>'ดูดวงรายเดือน'),
																												7=>array('t'=>'ดูดวงรายปี'),
																												2=>array('t'=>'ดูดวงความรัก'),
																												3=>array('t'=>'ดูดวงไพ่ยิบซี'),
																												5=>array('t'=>'ทายนิสัย'),
																												6=>array('t'=>'ทำนายฝัน'),
																											),
																											'sl'=>'http://horo.boxza.com/'
),

'21'=>array('t'=>'พยากรณ์อากาศ','l'=>$rlink[21],'s'=>array(
																												1=>array('t'=>'สภาพอากาศ'),
																												2=>array('t'=>'เตือนภัย'),
																											),
																											'sl'=>'http://weather.boxza.com/'
),

'14'=>array('t'=>'แบบบ้าน','l'=>$rlink[14],'s'=>array(
																												1=>array('t'=>'ห้องนอน'),
																												2=>array('t'=>'ห้องนอนเด็ก'),
																												3=>array('t'=>'ห้องรับแขก'),
																												4=>array('t'=>'ห้องน้ำ'),
																												5=>array('t'=>'ห้องครัว'),
																												6=>array('t'=>'ของใช้ในบ้าน'),
																												7=>array('t'=>'คอนโด'),
																												8=>array('t'=>'ออฟฟิค'),
																												9=>array('t'=>'ไอเดียแต่งบ้าน'),
																												10=>array('t'=>'การจัดสวน'),
																												11=>array('t'=>'ฮวงจุ้ยบ้าน'),
																									//			12=>array('t'=>'ตัวอย่างบ้าน'),
																												13=>array('t'=>'สินเชื่อบ้าน'),
																												14=>array('t'=>'แบบบ้านชั้นเดียว'),
																												15=>array('t'=>'แบบบ้านสองชั้น'),
																												16=>array('t'=>'แบบบ้านสวย'),
																											),
																											'sl'=>'http://home.boxza.com/'
),
'15'=>array('t'=>'กิน/เที่ยว','l'=>$rlink[15],'s'=>array(
																												1=>array('t'=>'พาชิม'),
																												2=>array('t'=>'เที่ยงกลางคืน'),
																												3=>array('t'=>'เที่ยวทะเล'),
																												4=>array('t'=>'เที่ยวภูเขา'),
																												5=>array('t'=>'เที่ยวเทศกาล ประเพณี'),
																												6=>array('t'=>'ท่องเที่ยวไทย'),
																												7=>array('t'=>'เที่ยวกรุงเทพ'),
																												8=>array('t'=>'เที่ยวต่างประเทศ'),
																												9=>array('t'=>'Tips ท่องเที่ยว'),
																											),
																											'sl'=>'http://travel.boxza.com/',
),
'16'=>array('t'=>'แม่และเด็ก','l'=>$rlink[16],'s'=>array(
																												1=>array('t'=>'เรื่องน่ารู้คุณแม่'),
																												2=>array('t'=>'เรื่องน่ารู้คุณลูก'),
																												3=>array('t'=>'อาหารเด็ก'),
																												4=>array('t'=>'นิทานสำหรับเด็ก'),
																												5=>array('t'=>'ตั้งชื่อลูก'),
																												6=>array('t'=>'ลูกดารา'),
																											),
																											'sl'=>'http://baby.boxza.com/',
),
'17'=>array('t'=>'แต่งงาน','l'=>$rlink[17],'s'=>array(
																												1=>array('t'=>'วางแผนแต่งงาน'),
																												2=>array('t'=>'พิธีแต่งงาน'),
																												3=>array('t'=>'ชุดแต่งงาน'),
																												4=>array('t'=>'แหวนแต่งงาน'),
																												5=>array('t'=>'การ์ดแต่งงาน'),
																												6=>array('t'=>'ซุ้มดอกไม้'),
																												7=>array('t'=>'บทความความรัก'),
																												8=>array('t'=>'ของชำร่วย'),
																												9=>array('t'=>'งานแต่งดารา'),
																											),
																											'sl'=>'http://wedding.boxza.com/',
),
'18'=>array('t'=>'สัตว์เลี้ยง','l'=>$rlink[18],'s'=>array(
																												1=>array('t'=>'สุนัข'),
																												2=>array('t'=>'แมว'),
																												3=>array('t'=>'ปลา สัตว์น้ำ'),
																												4=>array('t'=>'นก สัตว์ปีก'),
																												5=>array('t'=>'สัตว์เลี้ยงทั่วไป'),
																											),
																											'sl'=>'http://pet.boxza.com/',
),
'19'=>array('t'=>'การศึกษา','l'=>$rlink[19],'s'=>array(
																												1=>array('t'=>'Admission'),
																												2=>array('t'=>'คลังข้อสอบ'),
																												3=>array('t'=>'แนะนำคณะ'),
																												4=>array('t'=>'ข่าวการศึกษา'),
																												5=>array('t'=>'เรียนต่อ'),
																												6=>array('t'=>'ทุนการศึกษา'),
																												7=>array('t'=>'หนุมสาว ดาวเด่น'),
																											),
																											'sl'=>'http://education.boxza.com/',
),
'23'=>array('t'=>'สุขภาพ','l'=>$rlink[23],'s'=>array(
																												1=>array('t'=>'สุขภาพน่ารู้'),
																												2=>array('t'=>'โรคภัยไข้เจ็บ'),
																												3=>array('t'=>'ออกกำลังกาย'),
																												4=>array('t'=>'สมุนไพร'),
																												5=>array('t'=>'อาหาร')
																											),
																											'sl'=>'http://health.boxza.com/',
),
'12'=>array('t'=>'รถใหม่','l'=>$rlink[12],'s'=>array(
																				//		-1=>array('t'=>'โปรโมชั่นรถใหม่'),
																						-2=>array('t'=>'วิธีบำรุงรักษา'),
																						-3=>array('t'=>'ศูนย์บริการ'),
																						-4=>array('t'=>'ข่าวรถยนต์'),
																						-5=>array('t'=>'ข่าวมอเตอร์ไซค์'),
																						-6=>array('t'=>'Motor Expo / Motor Show'),
																						3=>array('t'=>'Audi'),
																						5=>array('t'=>'BMW'),
																						7=>array('t'=>'Chevrolet'),
																						8=>array('t'=>'Citroen'),
																						57=>array('t'=>'Daihatsu'),
																						12=>array('t'=>'Fiat'),
																						13=>array('t'=>'Ford'),
																						14=>array('t'=>'Honda'),
																						15=>array('t'=>'Hyundai'),
																						16=>array('t'=>'Isuzu'),
																						17=>array('t'=>'Jaguar'),
																						69=>array('t'=>'Jeep'),
																						18=>array('t'=>'KIA'),
																						20=>array('t'=>'Land Rover'),
																						21=>array('t'=>'Lexus'),
																						24=>array('t'=>'Mazda'),
																						25=>array('t'=>'Mercedes-Benz'),
																						26=>array('t'=>'Mini'),
																						27=>array('t'=>'Mitsubishi'),
																						30=>array('t'=>'Nissan'),
																						31=>array('t'=>'Peugeot'),
																						32=>array('t'=>'Porsche'),
																						33=>array('t'=>'Proton'),
																						88=>array('t'=>'Rover'),
																						89=>array('t'=>'Saab'),
																						90=>array('t'=>'Seat'),
																						37=>array('t'=>'Ssangyong'),
																						38=>array('t'=>'Subaru'),
																						39=>array('t'=>'Suzuki'),
																						40=>array('t'=>'TATA'),
																						42=>array('t'=>'Toyota'),
																						43=>array('t'=>'Volkswagen'),
																						44=>array('t'=>'Volvo'),
																						),
																						'sl'=>'http://www.autocar.in.th/'
	),
	'25'=>array('t'=>'เอเชี่ยนเกมส์','l'=>$rlink[25],'s'=>array(
																												1=>array('t'=>'ข่าว'),
																												2=>array('t'=>'โปรแกรมการแข่งขัน'),
																												5=>array('t'=>'คลิปเอเชียนเกมส์')
																											),
																											'sl'=>'http://asiangames.boxza.com/',
),
	'26'=>array('t'=>'เกาหลี','l'=>$rlink[26],'s'=>array(
																												1=>array('t'=>'ข่าวเกาหลี'),
																												2=>array('t'=>'ซีรีย์เกาหลี'),
																												3=>array('t'=>'คลิปเกาหลี'),
																												4=>array('t'=>'รูปภาพ'),
																												5=>array('t'=>'เนื้อเพลง')
																											),
																											'sl'=>'http://korea.boxza.com/',
),
	'27'=>array('t'=>'ผู้หญิง','l'=>$rlink[27],'s'=>array(
																												1=>array('t'=>'รีวิว','s'=>array(
																																																			1=>array('t'=>'แต่งหน้า'),
																																																			2=>array('t'=>'ศัลยกรรม'),
																																																			3=>array('t'=>'เครื่องสำอาง'),
																																																			4=>array('t'=>'บำรุงผิว'),
																																																			5=>array('t'=>'เพ้นท์เล็บ'),
																																																			6=>array('t'=>'ของใช้'),
																																																			7=>array('t'=>'ทรงผม'),
																																																			8=>array('t'=>'เสื้อผ้า'),
																												)),
																												2=>array('t'=>'แต่งงาน','s'=>array(
																																																			1=>array('t'=>'ทรงผม'),
																																																			2=>array('t'=>'แต่งหน้า'),
																																																			3=>array('t'=>'ชุดเจ้าสาว'),
																																																			4=>array('t'=>'อื่นๆ'),
																												)),
																												3=>array('t'=>'สุขภาพ','s'=>array(
																																																			1=>array('t'=>'อาหารการกิน'),
																																																			2=>array('t'=>'สุขภาพร่างกาย'),
																																																			3=>array('t'=>'ลดน้ำหนัก'),
																																																			4=>array('t'=>'โรคภัยไข้เจ็บ'),
																																																			5=>array('t'=>'แม่และเด็ก'),
																												)),
																												4=>array('t'=>'สาธิต','s'=>array(
																																																			1=>array('t'=>'แต่งหน้า'),
																																																			2=>array('t'=>'บำรุงผิว'),
																																																			3=>array('t'=>'งานประดิษฐ์'),
																																																			4=>array('t'=>'ทำผม'),
																																																			5=>array('t'=>'อื่นๆ'),
																												)),
																												5=>array('t'=>'แฟชั่น','s'=>array(
																																																			1=>array('t'=>'เทรนด์แฟชั่น'),
																																																			2=>array('t'=>'แฟชั่นดารา'),
																																																			3=>array('t'=>'กระแสฮิต'),
																																																			4=>array('t'=>'ชุดออกงาน'),
																																																			5=>array('t'=>'สตรีทแฟชั่น'),
																												)),
																												6=>array('t'=>'รู้หรือไม่')
																											),
																											'sl'=>'http://beauty.boxza.com/',
),
);

//'1'=>array('t'=>'กีฬา','l'=>'sport'),
//'8'=>array('t'=>'อัพเดทเรื่องอินเทรนด์'),
//'9'=>array('t'=>'รวมเรื่องซ่า'),
//'11'=>array('t'=>'ฟุตบอล','sub'=>'football')
//12=>array('t'=>'รถแต่ง','sub'=>'racing')
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
																	'post'=>'post',
																	'admin'=>'admin',
																	'update'=>'update',
																	'view'=>'view',
																	'people'=>'people',
													),
													true,
													function()
													{
														define('MODULE','list');
													}
									)
);


$template->display('content');

?>