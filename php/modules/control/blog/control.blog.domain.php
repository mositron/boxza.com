<?php
$db=_::db();
$domain=$db->find('wpbg_domain',array(),array(),array('sort'=>array('_id'=>1)));
$template=_::template();
$template->assign('domain',$domain);
_::$content=$template->fetch('blog.domain');

?>