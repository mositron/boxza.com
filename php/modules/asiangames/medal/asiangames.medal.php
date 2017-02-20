<?php

			
_::$meta['title'] = 'สรุปเหรียญเอเชียนเกมส์ 2014 - '._::$meta['title'];
_::$meta['description'] = 'สรุปเหรียญเอเชียนเกมส์ 2014 - '._::$meta['description'];
_::$meta['keywords'] = 'สรุปเหรียญเอเชียนเกมส์ 2014, สรุปเหรียญเอเชียนเกมส์, '._::$meta['keywords'];




$cache=_::cache();
if(!_::$content=$cache->get('ca1','asiangames_medal'))
{
	$db=_::db();
	$msg=$db->findone('msg',['_id'=>'asiangames_medal'],['msg'=>1]);
	$template->assign('medal',$msg['msg']);
	
	
	_::$content=$template->fetch('medal');
	$cache->set('ca1','asiangames_medal',_::$content,false,3600);
}


_::$yengo=array(53880,53999,54000);
?>