<?php
define('HIDE_SIDEBAR',1);

if(!is_numeric(_::$path[1]))
{
	_::move('/sticker',true);	
}


$db=_::db();
if(!$app=$db->findOne('sticker',array('_id'=>intval(_::$path[1]),'pl'=>1,'dd'=>array('$exists'=>false))))
{
	_::move('/sticker',true);
}

$template=_::template();
$template->assign('parent',$_GET['parent']?$_GET['parent']:'/sticker/recent');
$template->assign('app',$app);
$template->assign('icon',$db->find('sticker_icon',array('p'=>$app['_id'],'dd'=>array('$exists'=>false))));
_::$content=$template->fetch('sticker.view');


?>