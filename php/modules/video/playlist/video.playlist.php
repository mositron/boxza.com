<?php


$url=explode('-',_::$path[0]);
if(is_numeric($url[0]))
{
	require_once(__DIR__.'/video.playlist.view.php');
}
else
{
	require_once(__DIR__.'/video.playlist.list.php');
}

?>