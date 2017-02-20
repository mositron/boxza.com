<?php

_::ajax()->register('saveprogram');


$msg=_::db()->findone('msg',['_id'=>'asiangames_medal'],['msg'=>1]);
$template->assign('medal',$msg['msg']);
_::$content=$template->fetch('admin.medal');



function saveprogram($txt)
{
	_::db()->update('msg',['_id'=>'asiangames_medal'],['$set'=>['msg'=>stripslashes(trim($txt))]]);
	_::cache()->delete('ca1','asiangames_medal',0);
	_::ajax()->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
	_::ajax()->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
}
?>