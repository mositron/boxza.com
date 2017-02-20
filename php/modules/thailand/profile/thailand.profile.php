<?php

define('HIDE_SIDEBAR',1);

$db=_::db();

/*
print_r(_::$path);

echo '--- ( PLACE_SPLIT='.PLACE_SPLIT.' )---';
echo '--- ( PLACE_TYPE='.PLACE_TYPE.' )---';
*/

$arg=array('pl'=>1,'dd'=>array('$exists'=>false));
if(PLACE_TYPE==0)
{
	// อำเภอ
	$arg['ty']=3;
	$arg['lk']=_::$path[0];
	$arg['p2']=$data['province']['_ky'];
}
elseif(PLACE_TYPE==1)
{
	// ตำบล
	$arg['ty']=4;
	$arg['lk']=_::$path[1];
	$arg['tt.t3.lk']=_::$path[0];
	$arg['p2']=$data['province']['_ky'];
}
elseif(PLACE_TYPE==-2)
{
	// ตำบล
	$arg['ty']=5;
	$arg['lk']=_::$path[0];
	$arg['p2']=$data['province']['_ky'];
}

if(!$place=$db->findone('place',$arg))
{		
	//exit;
	if(PLACE_TYPE>1)
	{
		_::move('/'._::$path[0].'/'._::$path[1]);
	}
	elseif(PLACE_TYPE>0)
	{
		_::move('/'._::$path[0]);
	}
	else
	{
		_::move('/');	
	}
}

if($place['ty']==1)
{
	_::$meta['title']=$place['n'].' ประเทศไทย ศูนย์ข้อมูลประเทศไทย';
	_::$meta['description']=$place['n'].' ประเทศไทย ศูนย์ข้อมูลประเทศไทย - หน่วยงานราชการ รัฐวิสาหกิจ สถานศึกษา สถานที่ท่องเที่ยว ที่พัก ร้านอาหาร';
}
elseif($place['ty']==2)
{
	$tt=' จังหวัด'.$place['n'].' '.$place['tt']['t1']['n'];
	_::$meta['title']=$place['n'].$tt.' ข้อมูลจังหวัด ประเทศไทย ศูนย์ข้อมูลประเทศไทย';
	_::$meta['description']=$place['n'].' '.$place['q'].$tt.' ประเทศไทย ศูนย์ข้อมูลประเทศไทย - หน่วยงานราชการ รัฐวิสาหกิจ สถานศึกษา สถานที่ท่องเที่ยว ที่พัก ร้านอาหาร';
}
elseif($place['ty']==3)
{
	if($place['p2']>1)
	{
		$tt=' '.$place['q'].' จังหวัด'.$place['tt']['t2']['n'].' '.$place['tt']['t1']['n'].' ข้อมูลแขวง';
	}
	else
	{
		$tt=' '.$place['q'].' '.$place['tt']['t2']['n'].' '.$place['tt']['t1']['n'].' ข้อมูลเขต';
	}
	_::$meta['title']=$place['n'].$tt.' ประเทศไทย ศูนย์ข้อมูลประเทศไทย';
	_::$meta['description']=$place['n'].' '.$place['q'].$tt.' ประเทศไทย ศูนย์ข้อมูลประเทศไทย - หน่วยงานราชการ รัฐวิสาหกิจ สถานศึกษา สถานที่ท่องเที่ยว ที่พัก ร้านอาหาร';
}
elseif($place['ty']==4)
{
	if($place['p2']>1)
	{
		$tt=' '.$place['q'].' อำเภอ'.$place['tt']['t3']['n'].' จังหวัด'.$place['tt']['t2']['n'].' '.$place['tt']['t1']['n'];
	}
	else
	{
		$tt=' '.$place['q'].' '.$place['tt']['t3']['n'].' '.$place['tt']['t2']['n'].' '.$place['tt']['t1']['n'];
	}	
	_::$meta['title']=$place['n'].$tt.' ข้อมูลตำบล ศูนย์ข้อมูลตำบลประเทศไทย ศูนย์ข้อมูลประเทศไทย';
	_::$meta['description']=$place['n'].' '.$place['q'].$tt.' ประเทศไทย ศูนย์ข้อมูลประเทศไทย - หน่วยงานราชการ รัฐวิสาหกิจ สถานศึกษา สถานที่ท่องเที่ยว ที่พัก ร้านอาหาร';
	_::$meta['image']='http://s3.boxza.com/place/'.$place['fd'].'/t.jpg';
}

_::$meta['image']='http://s3.boxza.com/place/'.$place['fd'].'/t.jpg';

if($place['ty']!=5&&!isset($place['cc']))
{
	$place['cc']=array();
	foreach($cate as $k=>$v)
	{
		$place['cc'][$k]=$db->count('place',array('ty'=>5,'pl'=>1,'p'.$place['ty']=>$place['_ky'],'c'=>intval($k)));	
	}
	$db->update('place',array('_id'=>$place['_id']),array('$set'=>array('cc'=>$place['cc'],'du'=>new mongodate())));
}

$file=array(1=>'zone',2=>'province',3=>'amphor',4=>'district','5'=>'place');


$template->assign('place',$place);
	
if(isset($file[$place['ty']]))
{
	if(defined('PLACE_SPLIT'))
	{
		$p='/'.implode('/',array_slice(_::$path,0,PLACE_SPLIT));
		
		//print_r(_::$path);
		//echo '-- '.$p.' -- '.PLACE_TYPE.' -- '.WORD_SPLIT.' -- '.PLACE_SPLIT;
		
		if(isset($clink[WORD_SPLIT])||WORD_SPLIT=='ทั้งหมด')
		{
			require_once(__DIR__.'/thailand.profile.list.php');
		}
		else
		{
			_::move($p);
		}
		//$arg['c']=
	}
	else
	{
		require_once(__DIR__.'/thailand.profile.'.$file[$place['ty']].'.php');
	}
	
	_::$content=$template->fetch('profile.'.$file[$place['ty']]);
}
else
{
	_::move('/');	
}





//$template->assign('news',$db->find('news',array('place'=>$place['_id'],'pl'=>1,'dd'=>array('$exists'=>false)),array('_id'=>1,'c'=>1,'cs'=>1,'t'=>1,'fd'=>1,'lk'=>1),array('sort'=>array('_id'=>-1,'limit'=>10))));

?>