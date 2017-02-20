<?php

//_::time();
$template=_::template();


$allby=array('desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง');
$all=array('order','by','search','page','day','month','year','position','category');
extract(_::split()->get('/',0,array('z','p','t','page','order','by'),array('ds'=>'อัพเดทล่าสุด'),$allby));

if(isset($z) && !isset($zone[$z]))
{
	unset($z);
}
if(isset($p) && !isset($province[$p]))
{
	unset($p);
}
if(isset($t) && !isset($type[$t]))
{
	unset($t);
}

$_=array('dd'=>array('$exists'=>false));
$rc=array('dd'=>array('$exists'=>false),'fd'=>array('$exists'=>true));
if($z)
{
	$_['pr']=array('$in'=>$zone[$z]['l']);
}
elseif($p)
{
	$_['pr']=intval($p);
}
if($t)
{
	$_['ty']=$t;
	$rc['ty']=$t;
}
else
{
	$_['ty']=array('$nin'=>array('gay','lesbian'));
	$rc['ty']=array('$nin'=>array('gay','lesbian'));	
}

if(isset($p))
{
	$p=intval($p);
	#$tm=$db->findone('msn_province',array('_id'=>intval($p)));
	#$z=$tm['z'];
	foreach($zone as $k=>$v)
	{
		if(in_array($p,$v['l']))
		{
			$z=$k;
			break;
		}
	}
}

if($p)
{
	_::$meta['title']='หาเพื่อน'.($t?$type[$t]:'ทั้งหมด').'ในจังหวัด'.$province[$p]['name_th'].($page?' หน้า '.$page:'').' - '._::$meta['title'];
}
elseif($z)
{
	_::$meta['title']='หาเพื่อน'.($t?$type[$t]:'ทั้งหมด').'ใน'.$zone[$z]['n'].($page?' หน้า '.$page:'').' - '._::$meta['title'];
}
else
{
	_::$meta['title']='หาเพื่อน'.($t?$type[$t]:'ทั้งหมด').($page?' หน้า '.$page:'').' - '._::$meta['title'];
}
_::$meta['description']=_::$meta['title'].', '._::$meta['description'];

if($t=='gay')
{
	_::move('http://boyz.boxza.com/friend'.($p?'/p-'.$p:($z?'/z-'.$z:'')).($page && $page>1?'/page-'.$page:''),true);
}
elseif($t=='lesbian')
{
	_::move('http://lesbian.boxza.com/friend'.($p?'/p-'.$p:($z?'/z-'.$z:'')).($page && $page>1?'/page-'.$page:''),true);
}
$ckey='friend_'.$z.'_'.$p.'_'.$t.'_'.intval($page);
$cache=_::cache();
if(!_::$content=$cache->get('ca1',$ckey))
{
	$db=_::db();
	if($count=$db->count('msn',$_))
	{
		list($pg,$skip)=_::pager()->bootstrap(100,$count,array($url,'page-'),$page);
		$msn=$db->find('msn',$_,array(),array('sort'=>array('au'=>1,'da'=>-1),'skip'=>$skip,'limit'=>100),false);
	}
	$template->assign('rec',$db->find('msn_rec',$rc,array(),array('sort'=>array('_id'=>-1),'limit'=>8),false));
	$template->assign('z',$z);
	$template->assign('p',$p);
	$template->assign('t',$t);
	
	$template->assign('pc',$pc);
	$template->assign('pager',$pg);
	$template->assign('error',$error);
	$template->assign('msn',$msn);
	_::$content=$template->fetch('list');
	$cache->set('ca1',$ckey,_::$content,false,600);

}

_::$yengo=array(53880,54000);

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