<?php

$db=_::db();
if(!$news=$db->findone('news',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	_::move('/admin');
}

if($news['u']==_::$my['_id'] || _::$my['am'])
{

}
else
{
	_::move('/admin');
}


$error=array();

if($_POST)
{
	if(_::$my['am'] || (($news['u']==_::$my['_id']) && ((!$news['ds']) || ($news['ds']->sec > time()-(3600*24)))))
	{
		require_once(__DIR__.'/news.admin.update.post.php');
	}
}

$template->assign('news',$news);
$template->assign('error',$error);
_::$content=$template->fetch('admin.update');
?>