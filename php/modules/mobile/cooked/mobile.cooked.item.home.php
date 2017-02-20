<?php


$db=_::db();

if(!_::$path[1] || !$user=$db->findone('cooked_user',array('_id'=>intval(_::$path[1]))))
{
	_::move('/cooked');	
}

_::ajax()->register(array('delitem'));


$pp=50;
extract(_::split()->get('/cooked/item',1,array('page')));

if(!$page || $page<1)$page=1;

$db=_::db();
if($count=$db->count('cooked',array('dd'=>array('$exists'=>false))))
{
	list($pg,$skip)=_::pager()->bootstrap($pp,$count,array($url,'page-'),$page);
	$cooked=$db->find('cooked',array('dd'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>$pp));
}

$template=_::template();
$template->assign('parent','/cooked');
$template->assign('page',$page);
$template->assign('maxpage',ceil($count/$pp));
$template->assign('cooked',$cooked);
$template->assign('cur','?parent='.urlencode(URL));

_::$content=$template->fetch('cooked.item.home');



function delitem($id)
{
	global $user;
	$db=_::db();
	$ajax=_::ajax();
	if($cooked=$db->findone('cooked',array('_id'=>intval($id))))
	{
		$db->update('cooked',array('_id'=>$cooked['_id']),array('$set'=>array('dd'=>new mongodate())));
	}
	$ajax->redirect(URL);
}

?>