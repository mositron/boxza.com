<?php


$twconfig=array(
										'news'=>array(
																				'oauth'=>array(
																													  'consumer_key' => 'xxxxxxxxxxxxxxxxxxx',
																													  'consumer_secret' => 'xxxxxxxxxxxxxxxxxxx',
																													  'user_token' => 'xxxxxxxxxxxxxxxxxxx',
																													  'user_secret' => 'xxxxxxxxxxxxxxxxxxx',
																													  'curl_connecttimeout' => 60,
																													  'curl_timeout' => 60,
																				),
																			  'format' => '{:TITLE:} {:LINK:} #BoxZa #BoxZaNews'
																			),
										'video'=>array(
																				'oauth'=>array(
																													  'consumer_key' => 'xxxxxxxxxxxxxxxxxxx',
																													  'consumer_secret' => 'xxxxxxxxxxxxxxxxxxx',
																													  'user_token' => 'xxxxxxxxxxxxxxxxxxx',
																													  'user_secret' => 'xxxxxxxxxxxxxxxxxxx',
																													  'curl_connecttimeout' => 60,
																													  'curl_timeout' => 60,
																				),
																			  'format' => '{:TITLE:} {:LINK:} #BoxZa #BoxZaVideo'
																			),
);

$type='';


// NEWS

$db = _::db();
if($news=$db->find('news',array('pl'=>1,'dd'=>array('$exists'=>false),'tw'=>array('$exists'=>false),'da'=>array('$gte'=>new MongoDate(time()-(3600*12)))),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>1),'limit'=>1)))
{
	$n = $news[0];
	$db->update('news',array('_id'=>$n['_id']),array('$set'=>array('tw'=>new MongoDate())));

	$type='news';
	$title = $n['t'];
	$img = 'http://s3.boxza.com/news/'.$n['fd'].'/s.jpg';
	$url = 'http://news.boxza.com/view/'.$n['_id'];
}
elseif($video=$db->find('video',array('dd'=>array('$exists'=>false),'tw'=>array('$exists'=>false),'da'=>array('$gte'=>new MongoDate(time()-(3600*12)))),array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'n'=>1),array('sort'=>array('_id'=>1),'limit'=>1)))
{
	// $video_rec=$db->find('video',array('dd'=>array('$exists'=>false),'rc'=>array('$gt'=>0)),array('_id'=>1,'t'=>1,'l'=>1,'f'=>1,'c'=>1,'cs'=>1,'n'=>1,'dr'=>1,'yt'=>1),array('sort'=>array('_id'=>-1),'limit'=>12));
	$n = $video[0];
	$db->update('video',array('_id'=>$n['_id']),array('$set'=>array('tw'=>new MongoDate())));

	$type='video';
	$title = $n['t'];
	$img = 'http://s3.boxza.com/video/'.$n['f'].'/'.$n['n'];
	$url = 'http://video.boxza.com/'.$n['_id'].'-'.$n['l'].'.html';
}
else
{
	echo 'ยังไม่มีเนื้อหาใหม่';
}




#################################          TWITTER         ####################################

if($type&&isset($twconfig[$type]))
{

	if(!$autourl=$db->findone('autourl',array('l'=>$url),array('_id'=>1,'g'=>1)))
	{
		if($id=$db->insert('autourl',array('t'=>$title,'i'=>$img,'l'=>$url,'ty'=>$type)))
		{
			$g = gen_link($id);
			$db->update('autourl',array('_id'=>$id),array('$set'=>array('g'=>$g)));
			$link='http://boxz.co/'.$g;
		}
	}
	else
	{
		$link='http://boxz.co/'.$autourl['g'];
	}

	if(!$link)
	{
		$link=$url;
	}

	require_once(__DIR__.'/tmhOAuth/tmhOAuth.php');
	require_once(__DIR__.'/tmhOAuth/tmhUtilities.php');

	$message=str_replace('{:LINK:}',$link,$twconfig[$type]['format']);
	$len=140-mb_strlen($message,'utf-8')+mb_strlen('{:TITLE:}','utf-8');
	if(mb_strlen($title,'utf-8')>$len)
	{
		$message=str_replace('{:TITLE:}',mb_substr($title,0,$len-3,'utf-8').'...',$message);
	}
	else
	{
		$message=str_replace('{:TITLE:}',$title,$message);
	}

	$tmhOAuth = new tmhOAuth($twconfig[$type]['oauth']);
	$response = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update'), array('status' => $message));
	print_r($twconfig[$type]['oauth']);
	echo '<br>message: '.$message.'<br>';
	if ($response != 200)
	{
		echo 'ข้อมูลการโพส twitter ไม่ถูกต้อง <br><br><br><br>';
	}
}

################################################################################################






#######################################          FACEBOOK         ########################################

$cf=array(
						'id'=>'375840282500280', // album id ,     '375840282500280',
						'album'=>'400075373410104',
						'name'=>'BoxZa.com',
						'token'=>'BAABxFS1EdZA0BAFf1ZCJfwYu3VtlCRVOI7i5IxpAGIxGHv6lIml89sONlRZBzxdFEpbps1JIATY0gdZCR09ziPOaA0lpXm2KoSydeSDjqHcx0DIziXOx5aS32lzB6TyPqGOZAqXQGIu64t8sE9TeXDXiv5KKh9lJBUGM3BZCZAZCHXBk9dB2JxZAizMNGoZA86fAAXslygwTZBawL9U5WqhRNs3x7q6ys5gfX1sBwFZAHGZAu6AZDZD',
						'like'=>false,
						'delay'=>array(
																		'start'=>9,
																		'hour'=>6*3600,
																		'delete'=>3*3600,
																		'post'=>1200,
																		'min_score'=>500,
																		'after'=>24*3600,
																		'key'=>'fb'
						),
);

require_once(dirname(__DIR__).'/facebook/cron.facebook.process.php');



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
