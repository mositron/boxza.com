<?php
define('HIDE_REQUEST',1);

extract(_::split()->get('/cate-'.MODULE_LINK,0,array('page')));


_::$meta['title'] = $cate[MODULE_LINK]['t'].' - สติกเกอร์ Line ฟรี สติกเกอร์สำหรับไลน์ วอทแอพ วีแชท ';
_::$meta['description'] = $cate[MODULE_LINK]['t'].' - สติกเกอร์ Line ฟรี สติกเกอร์สำหรับไลน์ วอทแอพ วีแชท';
_::$meta['keywords'] = $cate[MODULE_LINK]['t'].', สติกเกอร์, Line, ไลน์, ฟรี';


$db=_::db();
if($count=$db->count('sticker',array('pl'=>1,'c'=>intval(MODULE_LINK),'dd'=>array('$exists'=>false))))
{
	list($pg,$skip)=_::pager()->bootstrap(100,$count,array($url,'page-'),$page);
	$app=$db->find('sticker',array('pl'=>1,'c'=>intval(MODULE_LINK),'dd'=>array('$exists'=>false)),array('t'=>1,'d'=>1,'l'=>1,'fd'=>1,'u'=>1,'p'=>1,'do'=>1,'f'=>1),array('sort'=>array('_id'=>-1),'skip'=>$skip,'limit'=>100));
}

$template=_::template();
$template->assign('c',MODULE_LINK);
$template->assign('pager',$pg);
$template->assign('user',_::user());
$template->assign('app',$app);
_::$content=$template->fetch('category');

?>