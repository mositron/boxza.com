<?php
list($type,$line)=explode('-',_::$path[0]);
$_ = array('photo'=>'photo','album'=>'album');
if(isset($_[$type]))
{
	require_once(__DIR__.'/social.photos.'.$type.'.php');
}
elseif(!$type)
{
	require_once(__DIR__.'/social.photos.list.php');
}
else
{
	_::move('/photos');
}

_::$meta['title'] = 'รูปภาพ - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'รูปภาพ - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'รูปภาพ, สังคมออนไลน์';
?>