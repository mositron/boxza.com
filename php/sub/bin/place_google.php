<?php

require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');



$db=_::db();



$p=$db->find('place',array('gg'=>array('$exists'=>true),'ty'=>5),array(),array('sort'=>array('_id'=>1),'limit'=>10));

for($i=0;$i<count($p);$i++)
{
	$v=$p[$i];
	$g=$v['gg'];
	$gt=array();
	$arg=array();
	//
	if($y=$g['bus_station'])
	{
		if($t=trim($y['long_name']))
		{
			$gt[]=$t;
			$arg['txt_bus']=$t;
		}
	}
	if($y=$g['establishment'])
	{
		if($t=trim($y['long_name']))
		{
			$gt[]=$t;
			$arg['txt_est']=$t;
		}
	}
	
	if($y=$g['route'])
	{
		if($t=trim($y['long_name']))
		{
			$gt[]=$t;
			$arg['txt_soi']=$t;
		}
	}
	if($y=$g['locality'])
	{
		if($t=trim($y['long_name']))
		{
			if($t!='กรุงเทพมหานคร')
			{
				$gt[]=$t;
				$arg['txt_district']=$t;
				if(mb_substr($t,0,4,'utf-8')=='ตำบล')
				{
					$arg['txt_district']=trim(mb_substr($t,4,NULL,'utf-8'));
				}
			}
			else
			{
				$arg['txt_province']='กรุงเทพมหานคร';
			}
		}
	}
	if($y=$g['administrative_area_level_2'])
	{
		if($t=trim($y['long_name']))
		{
			$gt[]=$t;
			$arg['txt_amphor']=$t;
			if(mb_substr($t,0,5,'utf-8')=='อำเภอ')
			{
				$arg['txt_amphor']=trim(mb_substr($t,5,NULL,'utf-8'));
			}
		}
	}
	if($y=$g['sublocality'])
	{
		if($t=trim($y['long_name']))
		{
			$gt[]=$t;
			$arg['txt_amphor']=$t;
			if(mb_substr($t,0,5,'utf-8')=='เขต')
			{
				$arg['txt_amphor']=trim(mb_substr($t,3,NULL,'utf-8'));
			}
		}
	}
	
	
	if($y=$g['administrative_area_level_1'])
	{
		if($t=trim($y['long_name']))
		{
			$gt[]=$t;
			$arg['txt_province']=$t;
			if(mb_substr($t,0,7,'utf-8')=='จังหวัด')
			{
				$arg['txt_province']=trim(mb_substr($t,7,NULL,'utf-8'));
			}
		}
	}
	if($y=$g['postal_code'])
	{
		if($t=trim($y['long_name']))
		{
			$gt[]=$t;
			$arg['txt_zip']=$t;
		}
	}
	print_r($v);
	print_r($gt);
	print_r($arg);
}

?>
<html>
<head></head>
<body>
<?php
if($p)
{
	//echo '<script>setTimeout(function(){window.location.href="?start='.($get+1).'";},5000);</script>';
}
print_r($v);
?>
</body>
</html>


