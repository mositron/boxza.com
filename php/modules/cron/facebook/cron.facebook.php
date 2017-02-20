<?php

$cf=false;

$config=array(
							'doodroid'=>array('type'=>'image','fbid'=>'128324113988612'),
							'worldcup'=>array('type'=>'image','fbid'=>'655621941135734'),
							'only'=>array('type'=>'image','fbid'=>'352321994845886'),
							'only2'=>array('type'=>'image','fbid'=>'149529361851965'),
							'beauty'=>array('type'=>'image','fbid'=>'436369953082195'),
							'chokdee'=>array('type'=>'image','fbid'=>'226497464220379'),
							
							
);

if(isset($config[_::$path[0]]))
{
	$c=$config[_::$path[0]];
	$db=_::db();
	echo 'ค้นหา fb id : '.$c['fbid'].'<br>';
		
	if($c['type']=='me')
	{
		require_once(__DIR__.'/cron.facebook.me.php');
	}
	else
	{
		if(!$cf=$db->findone('cron_fb',array('_id'=>$c['fbid'])))
		{
			echo 'ไม่มี fb id นี้';
			exit;
		}
		$cf['id']=$cf['_id'];
		
		
		if($c['type']=='image')
		{
			require_once(__DIR__.'/cron.facebook.image.php');
		}
		else
		{
			if($cf['last_type']=='image')
			{
				require_once(__DIR__.'/cron.facebook.news.php');
			}
			else
			{
				require_once(__DIR__.'/cron.facebook.image.php');
			}
		}
	}
}
elseif(_::$path[0]=='update')
{
	require_once(__DIR__.'/cron.facebook.'._::$path[0].'.php');
}





function gen_link($i)
{
	$a = array(
	'0', '1', '2', '3','4', '5', '6', '7', '8', '9',
	'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
	'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
	'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
	'y', 'z',
	'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
	'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
	'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
	'Y', 'Z',
	);
	$s = '';
	$c = count($a);
	while($i > 0)
	{
		$s = (string)$a[$i % $c] . $s;
		$i = floor($i / $c);
	}
	return $s;
}
?>