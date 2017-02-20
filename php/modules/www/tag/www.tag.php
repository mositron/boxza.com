<?php
_::$meta['profile']=false;
_::$meta['bootstrap']=true;

_::$meta['title']='ป้ายกำกับ / Tags';
_::$meta['description']='ป้ายกำกับ / Tags คำค้นยอดฮิตทั้งหมดหมายใน BoxZa.com';

if(_::$path[0])
{
	require_once(__DIR__.'/www.tag.view.php');
}
else
{
	require_once(__DIR__.'/www.tag.home.php');
}

?>