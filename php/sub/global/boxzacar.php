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
							'oauth'=>'about',
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