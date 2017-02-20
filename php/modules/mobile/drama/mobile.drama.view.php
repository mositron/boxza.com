<?php

if(!$tv=_::db()->findone('tvreturn',array('_id'=>intval(_::$path[1]))))
{
	_::move('/drama');
}
if($tv['type']=='drama')
{
	$template->assign('parent','/drama');	
}
else
{
	$template->assign('parent','/drama/'.$tv['type']);
}
$template->assign('tv',$tv);

_::$content=$template->fetch('drama.view');



?>
