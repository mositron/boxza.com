<?php
define('LIONICA','lionica');
define('LIONICA_PATH','/'.LIONICA);
define('PET_PRICE',50);

define('CONFIG_PATH',__DIR__.'/config/');
define('SOCKET_PATH',__DIR__.'/socket/');


_::$meta['title'] = 'Lionica - เกมสัตว์เลี้ยง เกม Lionica สัตว์เลี้ยง เลี้ยงสัตว์บนเว็บ';
_::$meta['description'] = 'เกมสัตว์เลี้ยง เลี้ยงสัตว์บนเว็บบ๊อกซ่า เกม Lionica';
_::$meta['keywords'] = 'เกมสัตว์เลี้ยง, เกมส์เล่นบนเว็บ, สัตว์เลี้ยง, เกมส์, เกม';


if(_::$path[0])
{
	if(in_array(_::$path[0],array('map-edit','play','rank','topper','info')))
	{
		require_once(__DIR__.'/game.'.LIONICA.'.'._::$path[0].'.php');
	}
	else
	{
		_::move(LIONICA_PATH);
	}
}
else
{
	require_once(__DIR__.'/game.'.LIONICA.'.home.php');
}

?>