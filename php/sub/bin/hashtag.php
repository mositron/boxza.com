<?php


$text='#ทดสอบ#ลอง#เทส

#บอบบ
บบบบ

#ซื่อบื้อ #โรงเรียนเปิด #มากที่อยู่#รู้นะ

http://boxza.com/positron#last
http://boxza.com/positron/s?w=1#last
http://boxza.com/positron/#last
http://boxza.com/positron/?#last

#er[sdfo0-123#asd\';sd-"sdf#3####adasd

"#ทดสอบ นะครับ" #"เทส เฉยๆ"
#sfsdf เทส



';
/*
    //preg_match_all('/(^|[^0-9A-Z&\/\?]+)([#＃]+)([0-9A-Z_]*[A-Z_]+[a-z0-9_üÀ-ÖØ-öø-ÿ]*)/iu', $text, $matches, PREG_OFFSET_CAPTURE);
    preg_match_all('/([#＃]+)(?:"([^"]+)|([^\b]+?))\b/u', $text, $matches, PREG_OFFSET_CAPTURE);

	echo '<pre>';
	print_r($matches);
    $m = &$matches[3];
    for ($i = 0; $i < count($m); $i++) {
		 if(!$m[$i])
		 {
			 $m[$i]=$matches[2][$i];
		 }
      $m[$i] = array_combine(array('hashtag', 'indices'), $m[$i]);
      # XXX: Fix for PREG_OFFSET_CAPTURE returning byte offsets...
      $start = mb_strlen(substr($text, 0, $matches[1][$i][1]),'utf-8');
      $start += mb_strlen($matches[1][$i][0],'utf-8');
      $length = mb_strlen($m[$i]['hashtag'],'utf-8');
      $m[$i]['indices'] = array($start-1, $start + $length);
    }
    
	 
	 print_r($m);
	 
*/

$text=preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $text);
//print_r($matches);
//if(preg_match_all('/([#＃]+)(?:"([^"]+)|([^\b]+?))\b/u', $text, $matches))
/*

if(preg_match_all('/#([\p{L}\p{Mn}]+)/u', $text, $matches))
{
	$hash=array();
	$m = $matches[3];
	for ($i = 0; $i < count($m); $i++) 
	{
		if(!$m[$i])
		{
			$m[$i]=$matches[2][$i];
		}
		if($m[$i])
		{
			$hash[]=$m[$i];
		}
	}
	if(count($hash))
	{
		$hash=array_values(array_unique(array_filter($hash)));
		print_r($hash);
	}
}
*/

if(preg_match_all('/#([\p{L}\p{Mn}]+)/u', $text, $matches))
{
	$hash=array();
	$m = $matches[1];
	for ($i = 0; $i < count($m); $i++) 
	{
		if($m[$i])
		{
			$hash[]=$m[$i];
		}
	}
	if(count($hash))
	{
		$hash=array_values(array_unique(array_filter($hash)));
		print_r($hash);
	}
}

//print_r($matches);

?>