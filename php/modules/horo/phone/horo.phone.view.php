<?php

$db=_::db();
if(!$phone=$db->findone('horo_phone',array('_id'=>intval($url[1]))))
{
	_::move('/phone');
}

_::$meta['title'] = 'ดูดวงเบอร์มือถือ ผลรวมเลข '.$url[1].' - '._::$meta['title'];
_::$meta['description'] = _::$meta['title'].' - '._::$meta['description'];

if(count($phone['mb']))
{
	$mb=array();
	for($i=0;$i<count($phone['mb']);$i++)
	{
		$mb[$phone['mb'][$i]['t'].$phone['mb'][$i]['no']]=$phone['mb'][$i];
	}
	ksort($mb);
	$phone['mb']=$mb;
}


$a=range(11, 100);
shuffle($a);
shuffle($a);
$a=array_slice($a,0,30);
$template->assign('mhit',$db->find('horo_phone',array('_id'=>array('$in'=>$a,'$ne'=>53)),array('_id'=>1,'d'=>1)));

$template->assign('phone',$phone);
_::$content=$template->fetch('phone.view');



function getno($no,$t=8)
{
	$no=str_replace(array('[','{',']','}'),array('<span class="n1">','<span class="n2">','</span>','</span>'),$no);
	if(strpos($no,')')>-1)
	{
		$no='0<span class="n3">'.$t.str_replace(')', '</span>', $no);
	}	
	else 
	{
		$no='0'.$t.$no;
	}
	return $no;
}
?>