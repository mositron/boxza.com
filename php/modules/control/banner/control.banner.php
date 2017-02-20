<?php


$access=check_perm('banner');

$position=array(
	'www'=>array('t'=>'boxza.com - หน้าแรกเว็บไซต์','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'album'=>array('t'=>'album.boxza.com - Album','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'beauty'=>array('t'=>'beauty.boxza.com - Beauty','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'boyz'=>array('t'=>'boyz.boxza.com - Boyz','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'car'=>array('t'=>'boxzacar.com - Car','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'chat'=>array('t'=>'chat.boxza.com - Chat','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'drama'=>array('t'=>'drama.boxza.com - ละคร','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'entertain'=>array('t'=>'entertain.boxza.com - Entertain','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),	
	'football'=>array('t'=>'www.teededball.com - Football','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'friend'=>array('t'=>'friend.boxza.com - Friend','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'forum'=>array('t'=>'forum.boxza.com - Forum','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'game'=>array('t'=>'game.boxza.com - Game','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'glitter'=>array('t'=>'glitter.boxza.com - Glitter','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'guess'=>array('t'=>'guess.boxza.com - Glitter','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'horo'=>array('t'=>'horo.boxza.com - Horo','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'lotto'=>array('t'=>'image.boxza.com - Image','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'lesbian'=>array('t'=>'lesbian.boxza.com - Lesbian','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'lotto'=>array('t'=>'lotto.boxza.com - Lotto','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'market'=>array('t'=>'market.boxza.com - Market','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'movie'=>array('t'=>'movie.boxza.com - Movie','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'music'=>array('t'=>'music.boxza.com - Music','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'news'=>array('t'=>'news.boxza.com - News','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'politic'=>array('t'=>'politic.boxza.com - Politic','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'racing'=>array('t'=>'racing.boxza.com - Racing','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'radio'=>array('t'=>'radio.boxza.com - Radio','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'tv'=>array('t'=>'tv.boxza.com - ทีวี','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
	'video'=>array('t'=>'video.boxza.com - Video','l'=>array('a','b','c','d','e','f','g','h','i','b1','b2')),
);
$template->assign('position',$position);

if(is_numeric(_::$path[0]))
{
	if($access)
	{
		require_once(__DIR__.'/control.banner.update.php');
	}
	else
	{
		_::move('/banner');	
	}
}
elseif(in_array(_::$path[0],array('stats')))
{
		require_once(__DIR__.'/control.banner.'._::$path[0].'.php');
}
else
{
	require_once(__DIR__.'/control.banner.home.php');
}

?>