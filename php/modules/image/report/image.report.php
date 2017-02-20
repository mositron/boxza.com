<?php

$db=_::db();
//_::time();




$template=_::template();
if($f=$db->findone('image',array('_id'=>intval(_::$path[0]))))
{
	$template->assign('image',$f);
}
echo $template->fetch('report');
exit;
?>