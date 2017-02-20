<?php
_::session()->logged();
$db=_::db();

$error=array();


$size=@getimagesize($f);
$type='jpg';
switch (strtolower($size['mime']))
{
	case 'image/gif':
		$type='gif';
		break;
	case 'image/jpg':
	case 'image/jpeg':
	case 'image/bmp':
	case 'image/wbmp':
	case 'image/png':
	case 'image/x-png':
		break;
}


$u=_::user()->profile($glitter['u']);
$q=_::upload()->send('s3','glitter-post','@'.$f,array('id'=>intval(_::$path[0]),'folder'=>$glitter['fd'],'name'=>$u['name'],'time'=>time::show(new MongoDate(),'datetime')));
if($q['status']=='OK')
{
	$db->update('glitter',array('_id'=>intval(_::$path[0])),array('$set'=>array('ty'=>$type,'zp'=>'glitter.boxza.com-'.intval(_::$path[0]).'.zip')));
	_::cache()->delete('ca1','glitter_home',0);
}

?>