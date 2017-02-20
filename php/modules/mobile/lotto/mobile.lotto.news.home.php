<?php

//_::time();
//_::link();
$db=_::db();
$news=$db->find('news',array('dd'=>array('$exists'=>false),'pl'=>1,'c'=>22,'exl'=>0),array('_id'=>1,'t'=>1,'fd'=>1,'s'=>1,'ds'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1),array('sort'=>array('_id'=>-1),'skip'=>0,'limit'=>30));

$template->assign('news',$news);
$template->assign('parent','/lotto');
_::$content=$template->fetch('lotto.news.home');

?>