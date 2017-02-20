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

ob_start();
//session_start();
header('Content-type: text/html; charset=utf-8');
define('START',microtime(true));

# set error
ini_set('html_errors',0);
ini_set('display_errors',E_ALL & ~E_NOTICE);
error_reporting(E_ALL & ~E_NOTICE);
set_error_handler('_::error',E_ALL & ~E_NOTICE);

define('iNet','<?PHP echo "iNet Revolutions Co.,Ltd."; ?>');
define('VERSION','1.4.0');
date_default_timezone_set('Asia/Bangkok');
//setlocale(LC_ALL, 'th_TH.UTF8');

#path on server
define('ROOT',dirname(__DIR__).'/');
define('HANDLERS',ROOT.'handlers/');
define('FILES',dirname(ROOT).'/files/');

# autoload for handler file
spl_autoload_register(function($class)
{
	require_once(HANDLERS.''.$class.'.php');
});

class _
{
	private static $h;
	public static $ses;
	public static $path;
	public static $config;
	public static $type='www';
	public static $content;
	public static $my;
	public static $site;
	public static $profile;
	public static $meta=array();
	public static $p=array();
	public static $yengo=array();
	public static $banner=array();
	public static $dbclick=false;
	
	public static function __callStatic($c,$n)
	{
		$_ = !empty($n)?md5(serialize($n)):'default';
		if(empty(self::$h[$c.'.'.$_]))
		{
			require_once(HANDLERS.str_replace('_','/',$c).'.php');
			try
			{
				self::$h[$c.'.'.$_] = (new ReflectionClass($c))->newInstanceArgs($n);
			}
			catch(Exception $e)
			{
				var_dump($e->getMessage());
				exit;
			}
		}
		return self::$h[$c.'.'.$_];
	}
	
	public static function load($type)
	{
		self::$type = $type;
		self::$config = require(HANDLERS.'boxza/global.php');
		define('HOST',$_SERVER['HTTP_HOST']);
		define('DOMAIN',preg_replace('/^www./is','',HOST));
		define('ROOT_MODULES',ROOT.'modules/'.self::$type.'/');
		define('PROTOCOL','http://');
		define('URL',urldecode(parse_url(strtolower($_SERVER['REQUEST_URI']),PHP_URL_PATH)));
		define('URI','http://'.HOST.URL);
		self::$path=array_values(array_filter(explode('/',substr(URL,strlen('/')))));
		
		
		if(isset($_COOKIE['bz_ses'])&&substr($_COOKIE['bz_ses'],0,5)=='bz201')
		{
			self::$ses=$_COOKIE['bz_ses'];
		}
		else
		{
			$_COOKIE['bz_ses'] = self::$ses = 'bz'.date('YmdHis').rand(10000,99999);
			setcookie('bz_ses',self::$ses,time()+31104000,'/','boxza.com',false,true);
		}
		
		if(!empty(self::$path[0]))
		{
			$mod=array(
								'sitemap.xml'=>'sitemap',
								'robots.txt'=>'robots',
								'crossdomain.xml'=>'crossdomain',
								'favicon.ico'=>'favicon'
							);
			if(isset($mod[self::$path[0]]))
			{
				require_once(ROOT.'modules/www/system/www.system.'.$mod[self::$path[0]].'.php');
				exit;
			}
		}
	}
	
	public static function banner($type)
	{
		if($banner=_::db()->find('banner',array('dd'=>array('$exists'=>false),'pl'=>1,'ty'=>'ads','p.'.$type=>array('$exists'=>true),'dt1'=>array('$lte'=>new MongoDate()),'dt2'=>array('$gte'=>new MongoDate())),array(),array('sort'=>array('so'=>1,'_id'=>1))))
		{
			_::$banner=array();
			$ads=_::ads();
			foreach($banner as $v)
			{
				if(is_array($v['p'][$type]))
				{
					$j=$v['p'][$type];
					foreach($j as $k)
					{
						if(!is_array(_::$banner[$k]))
						{
							_::$banner[$k]=array();	
						}
						if($v['tyc']=='1')
						{
							_::$banner[$k][]=$v['code'];
						}
						else
						{
							if($v['ex']=='swf')
							{
								_::$banner[$k][]='<object width="'.$v['w'].'" height="'.$v['h'].'"><param name="movie" value="http://s3.boxza.com/banner/'.$v['fd'].'/'.$v['s'].'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"><embed src="http://s3.boxza.com/banner/'.$v['fd'].'/'.$v['s'].'" type="application/x-shockwave-flash" width="'.$v['w'].'" height="'.$v['h'].'" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed></object>';
							}
							else
							{
								_::$banner[$k][]='<a href="'.$ads->fetch($v,$k).'" target="_blank" title="'.$v['d'].'" rel="nofollow" style="display:block;line-height:0px;"><img src="http://s3.boxza.com/banner/'.$v['fd'].'/'.$v['s'].'" alt="'.$v['d'].'"></a>';
							}
						}
					}
				}
			}
		}
		return _::$banner;
	}
	
	public static function run($mods,$shift=true,$func=NULL)
	{
		if(isset($mods[self::$path[0]]))
		{
			define('MODULE',$mods[self::$path[0]]);
			define('MODULE_LINK',self::$path[0]);
			if($shift)
			{
				array_shift(self::$path);
			}
		}
		elseif(!is_null($func))
		{
			$func();
		}
		elseif(!empty(self::$path[0]) && isset($mods['']))
		{
			self::move('/');
		}
		else
		{
			define('MODULE','home');
		}
		return ROOT_MODULES.MODULE.'/'._::$type.'.'.MODULE.'.php';
	}
	
	public static function move($u,$m=false)
	{
		while(@ob_end_clean());
		if(is_array($u))
		{
			$u=self::uri($u);
		}
		if(isset($_POST['ajax']))
		{
			header('Content-type: application/json');
			echo json_encode(array('f'=>array(array("a"=>"js",'v' => 'window.location.href="'.$u.'";'))));
		}
		elseif(defined('IS_AJAX'))
		{		
			echo '<html><body><script type="text/javascript">parent.location.href=\''.$u.'\';</script></body></html>';
			exit;
		}
		else
		{
			if($m)header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$u);
		}
		exit;
	}
	
	public static function error($t,$m,$f,$l,$c)
	{
		while(@ob_end_clean());
		if(isset($_POST['ajax']))
		{			
			echo json_encode(array('f'=>array(array("a"=>"al",'v' => 'ERROR '.$t.': '.$m.', Line '.$l.' of '.$f))));
		}
		else
		{
			require_once(ROOT.'modules/www/system/www.system.error.php');
		}
		exit;
	}
	
	public static function uri($arg=array())
	{
		$sub=($arg['sub']?$arg['sub']:self::$type).'.';
		if($sub=='www.' && !$arg['domain'])$sub='';
		return ($arg['protocol']?$arg['protocol']:PROTOCOL).$sub.($arg['domain']?$arg['domain']:'boxza.com').($arg['path']?$arg['path']:'/');
	}
}
?>