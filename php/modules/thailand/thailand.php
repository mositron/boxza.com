<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'สถานที่ โรงแรม ร้านอาหาร ห้างสรรพสินค้า ร้านค้า โรงเรียน สถานศึกษา ชายทะเล น้ำตก ภูเขา ทั่วประเทศ';
_::$meta['description'] = 'ศูนย์รวมข้อมูลสถานที่ โรงแรม ร้านอาหาร ห้างสรรพสินค้า ร้านค้า โรงเรียน มหาวิทยาลัย สถานศึกษา ชายทะเล น้ำตก ภูเขา  ตำบล อำเภอ จังหวัด ทั่วทั้งประเทศไทย';
_::$meta['keywords'] = 'สถานที่, โรงแรม, โรงพยาบาล, โรงเรียน, มหาวิทยาลัย, ห้าง, ร้านอาหาร, ร้านค้า, ตำบล, อำเภอ, จังหวัด, ทั่วประเทศ';

$cate=array(
						'restaurant'=>'ร้านอาหาร',
						'pub'=>'ผับ',
						'sea'=>'ชายทะเล',
						'waterfall'=>'น้ำตก',
						'mountain'=>'ภูเขา',
						'mall'=>'ห้างสรรพสินค้า',
						'market'=>'ตลาด',
						'school'=>'สถานศึกษา',
						'hotel'=>'โรงแรม'
);

$clink=array('ท่องเที่ยว'=>1,'ที่พัก'=>2,'อาหาร'=>3,'บันเทิง'=>4,'ศึกษา'=>5,'หน่วยงาน'=>6,'ซื้อ-ขาย'=>7,'เดินทาง'=>8,'กีฬา'=>9,'สุขภาพ'=>10,'การเงิน'=>11,'เชื้อเพลิง'=>12,'ศาสนา'=>13,'อาสาสมัคร'=>14,'อื่น'=>15);
$rlink=array_flip($clink);
$cate=array(
	'1'=>array('t'=>'สถานที่ท่องเที่ยว','l'=>$rlink[1]),
	'2'=>array('t'=>'ที่พัก','l'=>$rlink[2]),
	'3'=>array('t'=>'อาหารและเครื่องดื่ม','l'=>$rlink[3]),
	'4'=>array('t'=>'สถานบริการด้านความบันเทิง','l'=>$rlink[4]),
	'5'=>array('t'=>'สถานศึกษา','l'=>$rlink[5]),
	'6'=>array('t'=>'หน่วยงานราชการ รัฐวิสาหกิจ','l'=>$rlink[6]),
	'7'=>array('t'=>'ศูนย์รวมการซื้อ-ขาย','l'=>$rlink[7]),
	'8'=>array('t'=>'การเดินทาง การคมนาคม','l'=>$rlink[8]),
	'9'=>array('t'=>'กีฬา','l'=>$rlink[9]),
	'10'=>array('t'=>'สถานบริการด้านสุขภาพ','l'=>$rlink[10]),
	'11'=>array('t'=>'การเงิน การลงทุน','l'=>$rlink[11]),
	'12'=>array('t'=>'สถานีบริการเชื้อเพลิง','l'=>$rlink[12]),
	'13'=>array('t'=>'ศาสนสถาน','l'=>$rlink[13]),
	'14'=>array('t'=>'อาสาสมัคร','l'=>$rlink[14]),
	'15'=>array('t'=>'อื่นๆ','l'=>$rlink[15]),
);

$pro=array(
					'thailand'=>-1,
					'bangkok'=>10,
					'samutprakan'=>11,
					'nonthaburi'=>12,
					'pathumthani'=>13,
					'phranakhonsiayutthaya'=>14,
					'angthong'=>15,
					'lopburi'=>16,
					'singburi'=>17,
					'chainat'=>18,
					'saraburi'=>19,
					'chonburi'=>20,
					'rayong'=>21,
					'chanthaburi'=>22,
					'trat'=>23,
					'chachoengsao'=>24,
					'prachinburi'=>25,
					'nakhonnayok'=>26,
					'sakaeo'=>27,
					'nakhonratchasima'=>28,
					'buriram'=>29,
					'surin'=>30,
					'sisaket'=>31,
					'ubonratchathani'=>32,
					'yasothon'=>33,
					'chaiyaphum'=>34,
					'amnatcharoen'=>35,
					'nongbualamphu'=>36,
					'khonkaen'=>37,
					'udonthani'=>38,
					'loei'=>39,
					'nongkhai'=>40,
					'mahasarakham'=>41,
					'roiet'=>42,
					'kalasin'=>43,
					'sakonnakhon'=>44,
					'nakhonphanom'=>45,
					'mukdahan'=>46,
					'chiangmai'=>47,
					'lamphun'=>48,
					'lampang'=>49,
					'uttaradit'=>50,
					'phrae'=>51,
					'nan'=>52,
					'phayao'=>53,
					'chiangrai'=>54,
					'maehongson'=>55,
					'nakhonsawan'=>56,
					'uthaithani'=>57,
					'kamphaengphet'=>58,
					'tak'=>59,
					'sukhothai'=>60,
					'phitsanulok'=>61,
					'phichit'=>62,
					'phetchabun'=>63,
					'ratchaburi'=>64,
					'kanchanaburi'=>65,
					'suphanburi'=>66,
					'nakhonpathom'=>67,
					'samutsakhon'=>68,
					'samutsongkhram'=>69,
					'phetchaburi'=>70,
					'prachuapkhirikhan'=>71,
					'nakhonsithammarat'=>72,
					'krabi'=>73,
					'phangnga'=>74,
					'phuket'=>75,
					'suratthani'=>76,
					'ranong'=>77,
					'chumphon'=>78,
					'songkhla'=>79,
					'satun'=>80,
					'trang'=>81,
					'phatthalung'=>82,
					'pattani'=>83,
					'yala'=>84,
					'narathiwat'=>85,
					'buengkan'=>86
);

define('PROV_ID',$pro[_::$type]);
				
$template=_::template();

$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner(_::$type);
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto']=$lotto[0];
	
	
	$province=$db->findone('place',array('sl'=>_::$type));
	$data['province']=$province;
	if($province['_ky']==1)
	{
		$data['isbkk']=true;
	}
	else
	{
		$data['isbkk']=false;
	}
	if($province['prv'])
	{
		$data['weather']=$db->findone('weather',array('prv'=>$province['prv']));
	}
	$data['amp']=$db->find('place',array('ty'=>3,'pl'=>1,'p2'=>$province['_ky']),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1));


	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);
$template->assign('lotto',$data['lotto']);
$template->assign('cate',$cate);
$template->assign('province',$data['province']);
$template->assign('isbkk',$data['isbkk']);
$template->assign('weather',$data['weather']);


print_r($data);
require_once(
									_::run(
													array(
																	'' => 'home',
																	'admin'=>'admin',
													),
													true,
													function()
													{
														$type=-1;
														if(preg_match('/^([a-z0-9]+)$/',_::$path[0]))
														{
															$type=-2;
														}
														else
														{
															for($i=0;$i<count(_::$path);$i++)	
															{
																if(preg_match('/^\(([^)]+)\)$/',_::$path[$i],$w))
																{
																	define('WORD_SPLIT',$w[1]);
																	define('PLACE_SPLIT',$i);
																	break;	
																}
																else
																{
																	$type=$i;	
																}
															}
														}
														define('PLACE_TYPE',$type);
														define('MODULE',$type==-1?'list':'profile');
													}
									)
);


$template->display('content');

?>