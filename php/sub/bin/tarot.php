<?php
require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');
_::session();
if(_::$my['_id']!=1)exit;

/*
//www.myhora.com/ดูดวง-ไพ่ยิปซี-รายวัน.aspx

$url='http://www.myhora.com/%E0%B8%94%E0%B8%B9%E0%B8%94%E0%B8%A7%E0%B8%87-%E0%B9%84%E0%B8%9E%E0%B9%88%E0%B8%A2%E0%B8%B4%E0%B8%9B%E0%B8%8B%E0%B8%B5-%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%A7%E0%B8%B1%E0%B8%99.aspx';

$postdata = http_build_query(
    array(
		'__EVENTTARGET'=>'',
		'__EVENTARGUMENT'=>'',
		'__VIEWSTATE'=>'hEeArEpE0NsjhIRFCQt0qrZ4pOk/aSdZ3FphNOhVQqFiFzQRmnwJfwWwplatJ/e+RkLctMocSVedy9pUNG6gH9snTZ+gcplmIIX5o9qMMUDsVFx2q9hAt1q8bvRDYL/KAdGRxoPszYR3dv8wW0DH/Svw/pqOFsKksEN9QvKeV3uZKIuYUwx+98PutJ9zzrbWrYrrmJdP+iy2tQ8ZMWbjNfEunl1a863mg6aDAqT8X7FGPlTGPLrmSmQqf/CHyFTFe51pZYcJtSMMbFTP1N1aO96ffZoLewl0A7LIhBZiGsPX3Vw8psS9GwvdhHH964tBaDf3o9s9kaeQnx1JM7WB2UrFT0Vv2f0sJ2LmueuVO1bVlGS+PviXDHysVGInBjMCiFwTy6D5GBY3iZSuPhEla8VOnW924v0sMR4yrlWqju9XjOe6uYMl5pqJ93xeKH0ORgSo30NiUUCQEPVrGgKoIqEb6OIrbBBPuHAB8DCBS6Y0uxNuN0BIbK9hdbVAHa8IH5aDtOoXnrwtksgEHUb7bV6q8d7UbT6xNVnQz+Ddn3FwxIxNg3JMW8S1oouLFTYmKgO571nPZZkuv+q6B5B3dzBPwJIWGlTW18HQjbGX3AWZyDNqEyG0pqiHoZ2Z/8pmcvgQxkOjUar2g9JDOTfFpWQCu2dPDKut8bdhI68FQK+NkkqaJm7H2o3RcHggv535yRosiMqoWCPQmH9lhv5hVNZunPeiQk5QBRyC5IODDH4VYc49xiY5lgxa8otb96p42wzXW4fe1Gs7FqalGFQ696mGzhASCqaEVr2Q4cRPXzi4/UBfcJzg1dEbHzvBV40FmlDF9F/PmC8ZF4WKdHuYBaWZz51aKZDk08Cg+A4u5XFygK3Lsg8gjKdy6ofaTCkPZxJ9P+cGH3V7ATBOBp8lltmlqh261Nj2/bchA1nSHiuKUvuh9Yq5QoJerS8pQrRrLHwzgUd2lggZ8Pru14l43q9JQzg/kcHmSmB+w0lp8gpOJ7y14DT74pBFt75WUoi+eiY+XUXqSxVoJYmTvp78m2LLQcjmQPMhVY/MKsAWWe5TrkjnSJFxCJ3r4sfisT7bo12h3M5oXtt9TkNu0dxiP59LK/2Ust2xyMJXZvqHQuDW/i7WyBsPnrPDPQYvNGVt2JAmKlviozRz5C7+jq5Q6rOL1tO4AG7MJDQO5JVHnqGKC/kRwksrYq1twGGx9hTVAgQnjLngmD2en3kAZWL3VfrdpHGYaed2btYzCVaCrK5rkDTf4OlhudebcIZbA5TqSJs3lbCHgBJKT1IS72xi/cJeDKNUBPxvoD4jPHWxcB5Ll0ZkVfcxC7g6rYPLD+1H5JQ6FxDOmAO0ilA7BGcGwckNL3KBJTjAl2eYxIzAMlX7irWwxRHduv7N9lPhvnWVbpBMhOsgkWmIE7I5PiyCdjUM++FF5pch8fXibH/jaiMzUO93qppl/XOhkAYbbzcbWR9/pin5x+OJtYF8iiG1Z+tuFl6bU/YBfrhYQsMaetusf3ZlscdFxcKcnz40i7MDC2NHMEGTcGGr32F2JK/Vxq2GnT/7CzMaQAn8wlJF0+3z1WAeHvTS3Vd8/WPq7ESNRUQcXhcnNlhsnAkbbupTCZFqt9qlTgZnAdrhcvACSpnUEPgg6n0YRY/8iKm3zn923LSbEwXmXrIDEtvo06zOy88nObFiZ/VqVP0kMvgSlgVFSawniknM7shUo0ne99EktAk38cH9tbOAlEXVnR5cWjAOHQR/x+kGy5Sk3YE6fVLVxsJan1uApI5JtlavHAwT4ljx4RutwJFeJnTcgspLnwLmZU5FjqXU6B6Dy7PyZoLtfa+Nl4LJsh6ryDFYRW5P6l+73t7e7fnRzzTSy48GYAbkVjte/669ZA4frIbq+8nFuWIf9PtXMf4t/7VRRG2taQTIMuNhJBPyqbfWAdmiGqnvcPNmKqb6zCJD28Srw8bXCWRpdkocuYttmLPrgA3k89EmSvIXy5BPMHiUlaeYFasiA2Q5e5VUlngACIpT68b90Y9noC+LUabhzYaSARUXNJaeTDKJsyIxrPRyVJIiAr384ktFPL/k2dxaomQykNnLO9Pn8+BfErTyIxgb0WdCSnSUgBAgHx13waamjbNehw1lSK0D+E0lqPrp0f4TQXPb69UbfHc8pNKnU/8LeT3C5+PlqFxf7O6D3oh1QbOrrzog+aKnYlDr/3YtxxUS3R609gue07giP1+SKdgnbAT1qbXSCQkpoXnNrtIQR795RfUmkbWiP0gIJVpvhMgWRlH5eT9+l9KTVBVCZVJjz1OsYmLLMEEK5oMPLj5T+c5TOWK0xaL3FXu2LY3+i63PTL40LR1z+EuxBnxAxbHRn/M6lKkD+3WYyciBs0pq35UqRHatdNla3u2HmlLze77tx1s1NFHuFVwDgK9NhSjV+y9RyLDynoi4fxTJt/wuierrODSGcjrdoe2q6qwaJPL9IYO1pCTjvpCMUnQgg0CnFFQXuJ2wQ9ppBlyO7eDqKiHuW4NzOJmh6XLnimy0dnl2PazvpB1RpPXl0SXXSr9W/8gcA9lQvo/Odpwe6HlZ0rSgnIE5geQ4d0gSCHBFmjbDJTdBWKnkdwuT6SuXZeXbDk12Szjm7RkCKpfQiCw55bSWuPYrzKSHFrkOtG9ITgDKX5hdMZ5pgJgoeKxfoWt70ES8muVVbVW+W0iK/FyJsX+967McYABQXF9DdpOv6SKqDBP1ZsewfmPk44ApuKW4biMi4YTIoMfAoqqFMhwL3bCFqmU9hoYuGcmtVyHvGkFSnW1gDi0hKM4NDaULJ/+gRsmT0KtXm3OQ/9ztVjyQ/wUdBQBBGVvXVu4Eng1NBX/7Uu0cqPGXmgz55KtRK8tDyLjZRE0V8Obeu504AxsApp6M0NHvrMv1mBeooKiVSmfBYpasq+xQxXkGRqkVqYv0HsFfGVd8NniXvpJsm4U6uCoTvtC5asPbewUBSrTVFSVkpeuxQsNmQCmmVvd/T4TbAt2S45mOovUGAgo+EmuJ+504fxh8DVEy2CKF06Of9qOKUjEGh0X1wCroRgxsFeYHWzNxe5o3t71epXjTfSV9wGVwcSEqPbX/EToiD6CleeIG79ViKXMzo9rIt2HWGG+YntQ4FAYxXeZI0RNkOZAjdMztVT66p1SiWYt1KeGmc4FBoO4FPZmvhGOcP8WdIUHxcLvbogFqYlJIKlijJa7ne/Z3/mgOTeYZmVL3GtVxJyJQFrfE4zKMc88bjiRxmtMYZzotuyhx6zrYl4ghEQbattZhCKMEBRrUtypHpn5DBANv0zMiXc32ko5TBv6A8TozWg1mWOk90DsLz6ZvMzMRxwDr8pIp+XIOOtDftleg5OPasXxGMubkbio7W1IOsCq9MIjst16WQfZLfnyPxxMP9OqTGg2wJDypffnLjU9hXbNLBM4eMRtR6UWUvDluh5bZ2m1M79iQ9oNzbR4EoU+sMRY28TTOlO5YZyA3aVTEL8uWsV4OGJ/OT+jmD/Jt961ISnIrNjWNz6XKA9qHsasFV31rVZfeRzKR4rOS1YOG53idPTgTvldeASv2YSC0tinJIU2iqYZQ46l0zrrclZIOKAIL55qimZtnbMtBgZwiiaUI/rexkfKf/zeb49Xm6MfmwSTq9yMDklIUm97GCO+zdhVbCtbcxDweOJMegZXbaQWYH2y5kJL7Z0JiHMEfBUmsLC3TptbXYc+yKNua+KZdGiAE7u3gYv7zIv4dL7oOO5abNmBSHnjDd1sf+EvNxDdvoVaTeEAPvhUiwwydOV1JkIeUvpXwnGAg5RhHGbW6Sanr7wU9U+TAAjfgNelv7B07R4WP',
		'__VIEWSTATEENCRYPTED'=>'',
        'my_top$txt_m_email'=>'',
		'my_top$txt_m_password'=>'',
		'card_title'=>'ท่านเลือกไพ่แล้ว คลิ๊กปุ่ม "ทำนาย"',
		'card_count'=>'1',
		'btn_submit'=>'ทำนาย'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

for($i=0;$i<30;$i++)
{
	$tmp = file_get_contents($url, false, $context);

	$arg=array();
	$s='<font style="font-size:1.23em">';
	$j=mb_strpos($tmp,$s,NULL,'utf-8');
	if($j>0)
	{
		$tmp2=mb_substr($tmp,$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
		$s='</font>';
		$j=mb_strpos($tmp2,$s,NULL,'utf-8');
		if($j>0)
		{
			$arg['n']=trim(mb_substr($tmp2,0,$j,'utf-8'));
		}
	}
	
	$s='<img src="astrology/tarot/image-tarot-card.aspx?id=';
	$j=mb_strpos($tmp,$s,NULL,'utf-8');
	if($j>0)
	{
		$tmp2=mb_substr($tmp,$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
		$s='"';
		$j=mb_strpos($tmp2,$s,NULL,'utf-8');
		if($j>0)
		{
			$arg['id']=trim(mb_substr($tmp2,0,$j,'utf-8'));
		}
	}
	if(!empty($arg['id'])&&!empty($arg['n']))
	{
		$file=__DIR__.'/tarot/'.$arg['id'].'.txt';	
		if(file_exists($file))
		{
			unlink($file);
		}
		file_put_contents($file,trim($arg['n']));
		print_r($arg);
	}
	else
	{
		echo '<br>- not found<br>';	
		print_r($arg);
		exit;
	}
	//echo $result;
}
echo '<script>setTimeout(function(){window.location.href="?"},30000);</script>';	
exit;
*/

if(isset($_GET['id'])) 
{
	$id=$_GET['id'];
	$http=_::http();
	
	$arg=array();
	for($i=1;$i<=10;$i++)
	{
		$tmp=$http->get('www.myhora.com/astrology/tarot/prophesy.aspx?pos='.$i.'&card='.$id);
		//echo $tmp;
		if($i==1)
		{
			$s='<font style="font-size:1.08em; color:#800; font-weight:bold;">';
			$j=mb_strpos($tmp,$s,NULL,'utf-8');
			if($j>0)
			{
				$tmp2=mb_substr($tmp,$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
				$s='</font>';
				$j=mb_strpos($tmp2,$s,NULL,'utf-8');
				if($j>0)
				{
					$arg['n']=trim(mb_substr($tmp2,0,$j,'utf-8'));
				}
			}
		
			$s='<div style="padding-top:10px; margin-bottom:20px;color:#777777;">';
			$j=mb_strpos($tmp,$s,NULL,'utf-8');
			if($j>0)
			{
				$tmp2=mb_substr($tmp,$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
				$s='</div>';
				$j=mb_strpos($tmp2,$s,NULL,'utf-8');
				if($j>0)
				{
					$arg['d']=trim(mb_substr($tmp2,0,$j,'utf-8'));
				}
			}
		}
		//<font  style="font-size:1.08em;">
		
		
		$s='<font  style="font-size:1.08em;">';
		$j=mb_strpos($tmp,$s,NULL,'utf-8');
		if($j>0)
		{
			$tmp2=mb_substr($tmp,$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
			$s='</font>';
			$j=mb_strpos($tmp2,$s,NULL,'utf-8');
			if($j>0)
			{
				$arg['s'.$i]=trim(mb_substr($tmp2,0,$j,'utf-8'));
			}
		}
	}
	if($id>0&&$id<77)
	{
		$arg['s0']=file_get_contents(__DIR__.'/tarot/'.$id.'.txt');
	}
	file_put_contents(__DIR__.'/tarot/data.'.$id.'.js','card_data[\'c'.$id.'\']='.json_encode($arg).';');
	file_put_contents(__DIR__.'/tarot/'.$id.'.png',file_get_contents('http://www.myhora.com/astrology/tarot/image-tarot-card.aspx?id='.$id));
	if($id<77)
	{
		echo $id.'<script>setTimeout(function(){window.location.href="?id='.($id+1).'"},2000);</script>';	
	}
	print_r($arg);
}
else
{
	echo 'no';	
}

?>