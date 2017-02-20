<?php



_::$meta['title']=$place['n'].' ประเทศไทย ศูนย์ข้อมูลประเทศไทย';
_::$meta['description']=$place['n'].' ประเทศไทย ศูนย์ข้อมูลประเทศไทย - หน่วยงานราชการ รัฐวิสาหกิจ สถานศึกษา สถานที่ท่องเที่ยว ที่พัก ร้านอาหาร';


$prov=$db->find('place',array('ty'=>2,'pl'=>1,'p1'=>$place['_ky']),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1));
$template->assign('prov',$prov);

/*
if($place['loc'][0])
{
	$near=$db->find('place',array('ty'=>5,'loc'=>array('$near'=>array('$geometry'=>array('type'=>'Point','coordinates'=>$place['loc'])),'$maxDistance'=>100)),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1));
	
	$template->assign('near',$near);
}
*/
$near=$db->find('place',array('ty'=>5,'p1'=>$place['p1'],'p2'=>$place['p2'],'p3'=>$place['p3'],'p4'=>$place['p4']),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1),array('limit'=>15));
$template->assign('near',$near);

/*
db.places.find( { loc : { $near :
                           { $geometry :
                               { type : "Point" ,
                                 coordinates: [ 40 , 5 ] } },
                             $maxDistance : 500
                } } )
				*/
?>