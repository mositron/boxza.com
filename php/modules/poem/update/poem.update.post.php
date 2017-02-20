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


$u=_::user()->profile($poem['u']);
$q=_::upload()->send('s3','poem-post','@'.$f,array('id'=>intval(_::$path[0]),'folder'=>$poem['fd'],'name'=>$u['name'],'time'=>time::show(new MongoDate(),'datetime')));
if($q['status']=='OK')
{
	$db->update('poem',array('_id'=>intval(_::$path[0])),array('$set'=>array('ty'=>$type,'zp'=>'poem.boxza.com-'.intval(_::$path[0]).'.zip')));
	_::cache()->delete('ca1','poem_home',0);
}

?>