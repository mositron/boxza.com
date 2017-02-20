<?php
/*
+ ----------------------------------------------------------------------------+
|     BoxZa - for PHP 5.4
|
|     © 2013 iNet Revolutions Co.,Tld.
|     http://boxza.com
|     positron@boxza.com
|
|     $Revision: 1.3.0 $
|     $Date: 2013/05/02 3:43:00 $
|     $Author: Positron $
+-----------------------------------------------------------------------------+
*/
# start.


require_once('../../handlers/boxza.php');



# Initialization Application
$cf=array(
							'about'=>'about',
							'album'=>'album',
							'api'=>'api',
							'asiangames'=>'asiangames',
							'baby'=>'baby',
							'beauty'=>'beauty',
							'blog'=>'blog',
							'boyz'=>'boyz',
							'calendar'=>'calendar',
							'car'=>'car',
							'chat'=>'chat',
							'control'=>'control',
							'cron'=>'cron',
							'drama'=>'drama',
							'education'=>'education',
							'entertain'=>'entertain',
							'event'=>'event',
							'feed'=>'feed',
							'football'=>'football',
							'forum'=>'forum',
							'friend'=>'friend',
							'game'=>'game',
							'gif'=>'gif',
							'glitter'=>'glitter',
							'gold'=>'gold',
							'guess'=>'guess',
							'health'=>'health',
							'home'=>'home',
							'horo'=>'horo',
							'image'=>'image',
							'it'=>'it',
							'korea'=>'korea',
							'lesbian'=>'lesbian',
							'lotto'=>'lotto',
							'm'=>'m',
							'market'=>'market',
							'mobile'=>'mobile',
							'movie'=>'movie',
							'music'=>'music',
							'news'=>'news',
							'oauth'=>'oauth',
							'oil'=>'oil',
							'people'=>'people',
							'pet'=>'pet',
						//	'place'=>'place',
							'poem'=>'poem',
							'politic'=>'politic',
							'out'=>'out',
							'racing'=>'racing',
							'radio'=>'radio',
							'search'=>'search',
							'social'=>'social',
							'star'=>'star',
							'sticker'=>'sticker',
							'tech'=>'tech',
							'today'=>'today',
							'travel'=>'travel',
							'tv'=>'tv',
							'upload'=>'upload',
							'url'=>'url',
							'video'=>'video',
							'weather'=>'weather',
							'wedding'=>'wedding',
							'www'=>'www',
							
							/*
							'thailand'=>'province',
							'bangkok'=>'province',
							'samutprakan'=>'province',
							'nonthaburi'=>'province',
							'pathumthani'=>'province',
							'phranakhonsiayutthaya'=>'province',
							'angthong'=>'province',
							'lopburi'=>'province',
							'singburi'=>'province',
							'chainat'=>'province',
							'saraburi'=>'province',
							'chonburi'=>'province',
							'rayong'=>'province',
							'chanthaburi'=>'province',
							'trat'=>'province',
							'chachoengsao'=>'province',
							'prachinburi'=>'province',
							'nakhonnayok'=>'province',
							'sakaeo'=>'province',
							'nakhonratchasima'=>'province',
							'buriram'=>'province',
							'surin'=>'province',
							'sisaket'=>'province',
							'ubonratchathani'=>'province',
							'yasothon'=>'province',
							'chaiyaphum'=>'province',
							'amnatcharoen'=>'province',
							'nongbualamphu'=>'province',
							'khonkaen'=>'province',
							'udonthani'=>'province',
							'loei'=>'province',
							'nongkhai'=>'province',
							'mahasarakham'=>'province',
							'roiet'=>'province',
							'kalasin'=>'province',
							'sakonnakhon'=>'province',
							'nakhonphanom'=>'province',
							'mukdahan'=>'province',
							'chiangmai'=>'province',
							'lamphun'=>'province',
							'lampang'=>'province',
							'uttaradit'=>'province',
							'phrae'=>'province',
							'nan'=>'province',
							'phayao'=>'province',
							'chiangrai'=>'province',
							'maehongson'=>'province',
							'nakhonsawan'=>'province',
							'uthaithani'=>'province',
							'kamphaengphet'=>'province',
							'tak'=>'province',
							'sukhothai'=>'province',
							'phitsanulok'=>'province',
							'phichit'=>'province',
							'phetchabun'=>'province',
							'ratchaburi'=>'province',
							'kanchanaburi'=>'province',
							'suphanburi'=>'province',
							'nakhonpathom'=>'province',
							'samutsakhon'=>'province',
							'samutsongkhram'=>'province',
							'phetchaburi'=>'province',
							'prachuapkhirikhan'=>'province',
							'nakhonsithammarat'=>'province',
							'krabi'=>'province',
							'phangnga'=>'province',
							'phuket'=>'province',
							'suratthani'=>'province',
							'ranong'=>'province',
							'chumphon'=>'province',
							'songkhla'=>'province',
							'satun'=>'province',
							'trang'=>'province',
							'phatthalung'=>'province',
							'pattani'=>'province',
							'yala'=>'province',
							'narathiwat'=>'province',
							'buengkan'=>'province',
							*/
);


$d=strtolower(preg_replace('/^www./is','',$_SERVER['HTTP_HOST']));
//if(preg_match('/^([a-z0-9]+)(\.[a-z0-9]+)?\.boxza\.com$/',$d,$c))
if(preg_match('/^([a-z0-9\.]+)?boxza\.com/',$d,$c))
{
	if($c[1])
	{
		$d=explode('.',$c[1]);
		if(isset($cf[$d[0]]))
		{
			if(count($d)>2&&$d[1])
			{
				if($_SERVER['QUERY_STRING']!='debug')
				 {
					_::move('http://'.$d[0].'.boxza.com'.urldecode(parse_url(strtolower($_SERVER['REQUEST_URI']),PHP_URL_PATH)),true);
				 }
			}
			define('SUBDOMAIN',$d[0]);
			$sub=$cf[$d[0]];
		}
		else
		{
			_::move('http://boxza.com/',true);
		}
	}
	else
	{
		$sub='www';
	}
}
else
{
	_::move('http://boxza.com/',true);
}
unset($c,$d,$cf);

_::load($sub);

require_once(ROOT_MODULES.$sub.'.php');

?>