<?php





$db=_::db();


$g=date('G');
$night=($g>=6&&$g<=19)?false:true;

$now='day';
if($g>4&&$g<=10)
{
	$now='morn';
}
elseif($g>10&&$g<=14)
{
	$now='day';
}
elseif($g>14&&$g<=18)
{
	$now='day';
}
else
{
	$now='night';	
}
	
	

if($wt=$db->find('weather',array(),array(),array('sort'=>array('du'=>1),'limit'=>5)))
{
	foreach($wt as $weather)
	{
		echo 'http://www.tmd.go.th/province.php?id='.$weather['tmd'].'<br>';
		$tmp=_::http()->get('http://www.tmd.go.th/province.php?id='.$weather['tmd']);
	
		$s='FONT-SIZE:22px;FONT-FAMILY:Tahoma;padding-left:25px;\'>';
		$i=strpos($tmp,$s);
		if($i>-1)
		{
			$tmp=substr($tmp,$i+strlen($s));	
			$s='&deg;C';
			$i=strpos($tmp,$s);
			$tmp2=trim(substr($tmp,0,$i));	
			
			$var=array($tmp2);
			
			$s="<td class='PM'>";
			$i=strpos($tmp,$s);
			if($i>-1)
			{
				$tmp=substr($tmp,$i+strlen($s));	
				
				//<tr style='height:1px;'>
				
				
				$s="<tr style='height:1px;'>";
				$i=strpos($tmp,$s);
				if($i>-1)
				{
					$tmp=iconv('tis-620','utf-8',trim(substr($tmp,0,$i-12)));	
					
					$tmp=str_replace(array('<TABLE','<TR','<TD','</TD','</TR','</TABLE','\''),array('<table','<tr','<td','</td','</tr','</table','"'),$tmp);
					
				//	echo $tmp;
					
					$c=explode('<td>',$tmp);
					for($i=1;$i<count($c);$i++)
					{
						$j=mb_strpos($c[$i],'</td>',0,'utf-8');
						if($j>-1)
						{
							$var[]=trim(mb_substr($c[$i],0,$j,'utf-8'));
						}
					}
					//exit;
					//$html=str_get_html($tmp);
					//$c=$html->find('td',0);
					//print_r($var);
					$icon=0;
					switch($var[7])
					{
						case 'ท้องฟ้าแจ่มใส':
						case 'ท้องฟ้าโปร่ง':
							$icon=1;
						break;
						case 'มีเมฆเต็มท้องฟ้า':
						case 'ท้องฟ้ามืดมิด':
							$icon=2;
						break;
						case 'มีเมฆมาก':
						case 'มีเมฆเป็นส่วนมาก':
						case 'มีเมฆบางส่วน':
							$icon=3;
						break;
					}
					$arg=array(
											't1'=>$var[0],
											't2'=>($m=mb_strpos($var[1],'&',0,'utf-8'))>-1?mb_substr($var[1],0,$m,'utf-8'):$var[1],
											't3'=>$var[3],
											't4'=>$var[5],
											't5'=>$var[7],
											't6'=>$var[9],
											't7'=>$var[11],
											't8'=>$var[13],
											't9'=>$var[19],
											't10'=>$var[21],
											't11'=>($m=mb_strpos($var[23],'&',0,'utf-8'))>-1?mb_substr($var[23],0,$m,'utf-8'):$var[23],
											't12'=>($m=mb_strpos($var[25],'&',0,'utf-8'))>-1?mb_substr($var[25],0,$m,'utf-8'):$var[25],
											't13'=>$var[27],
											'icon'=>$icon
										);
					$db->update('weather',array('_id'=>$weather['_id']),array('$set'=>array('today'=>$arg,'du'=>new mongodate())));
					print_r($arg);
					continue;
				}
			}
		}
		$db->update('weather',array('_id'=>$weather['_id']),array('$set'=>array('du'=>new mongodate())));
	}
}


if($wt=$db->find('weather',array('loc'=>array('$exists'=>true)),array(),array('sort'=>array('dtm'=>1,'_id'=>1),'limit'=>1)))
{
	foreach($wt as $weather)
	{
		echo '<br><br>'.$weather['_id'].'<br>';
		$tmp=json_decode(_::http()->get('http://api.openweathermap.org/data/2.5/forecast/daily?lat='.$weather['loc'][0].'&lon='.$weather['loc'][1].'&cnt=10&units=metric&mode=json'),true);
		
		$tm=array();
		foreach((array)$tmp['list'] as $v)
		{
			$icon=0;
			switch($v['weather'][0]['main'])
			{
				case 'Clear':
					$icon=1;
				break;
				case 'Clouds':
					$icon=2;
				break;
				case 'Rain':
					$icon=5;
				break;
			}
			
			//Clouds
			$tm[]=array(
									'dt'=>new mongodate($v['dt']),
									'temp'=>array(
																'day'=>$v['temp']['day'],
																'min'=>$v['temp']['min'],
																'max'=>$v['temp']['max'],
																'night'=>$v['temp']['night'],
																'eve'=>$v['temp']['eve'],
																'morn'=>$v['temp']['morn'],
													),
									'weather'=>$v['weather'][0],
									'icon'=>$icon
								);
		}
		$db->update('weather',array('_id'=>$weather['_id']),array('$set'=>array('list'=>$tm,'dtm'=>new mongodate())));
		
		if(!$weather['today'])
		{
			$temp=$tmp['list'][0]['temp'][$now];
			$icon=0;
			switch($tmp['list'][0]['weather'][0]['main'])
			{
				case 'Clear':
					$icon=1;
				break;
				case 'Clouds':
					$icon=2;
				break;
				case 'Rain':
					$icon=5;
				break;
			}
			$db->update('weather',array('_id'=>$weather['_id']),array('$set'=>array('today'=>array('icon'=>$icon,'t1'=>$temp))));
		}
		print_r($tmp);
	}
}

// ºC =ºF - 32 ______  1.8000


//_::db()->update('music_request',array(),array('$set'=>array('du'=>new MongoDate())),array('multiple'=>true));


?>