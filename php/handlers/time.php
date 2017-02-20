<?php


class time
{
	public static $lang;
	public static $today=false;
	public static $ytd=false;
	
	public static $month=array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	public static $day=array('อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์');
	public function __construct()
	{
		time::$lang=(defined('LANG_ADMIN')?LANG_ADMIN:LANG);
	}
	public static function ago($s)
	{
		$s = time()-$s->sec;
		if ($s<0)$s=0;
		foreach (array("60:วินาที","60:นาที","24:ชั่วโมง","30:วัน","12:เดือน","0:ปี") as $x)
		{
			$y=explode(":",$x);
			if($y[0]>1){$v=$s%$y[0];$s=floor($s/$y[0]);}else{$v=$s;}
			$t[$y[1]]=$v;
		}
		foreach (array('ปี','เดือน','วัน','ชั่วโมง','นาที') as $x)
		{
			if($t[$x]) return $t[$x]." ".$x;
		}
		return '>1 นาที';
	}
	public static function show($s,$time='',$txt=false)
	{
		switch($time)
		{
			case 'date':
				if(!$s)return '';
				if(time::$lang=='en')
				{
					return date('F j, Y', $s->sec);
				}
				else
				{
					$t=date('j',$s->sec).' '.time::$month[date('n',$s->sec)-1].' '.(date('Y',$s->sec)+543);
					if($txt)
					{
						if(!self::$today)
						{
							self::$today=date('j').' '.time::$month[date('n')-1].' '.(date('Y')+543);
							$d=strtotime('-1 day');
							self::$ytd=date('j',$d).' '.time::$month[date('n',$d)-1].' '.(date('Y',$d)+543);
						}
						if($t==self::$today)
						{
							return 'วันนี้';
						}
						elseif($t==self::$ytd)
						{
							return 'เมื่อวาน';
						}
						else
						{
							return $t;
						}
					}
					else
					{
						return $t;
					}
				}
			case 'time':
				return $s?date('H:i', $s->sec):'';
			case 'datetime':
				return time::show($s,'date',$txt).' - '.time::show($s,'time');
		}
	}
}
?>