<?php

$db=_::db();


if(isset($_GET['delete']))
{
	list($id,$code)=explode('.',$_GET['delete'],2);
	if($f=$db->findone('msn',array('_id'=>intval($id),'dd'=>array('$exists'=>false))))
	{
		if($code==md5($f['_id'].'+d+'.$f['em']))
		{
			$db->update('msn',array('_id'=>$f['_id']),array('$set'=>array('dd'=>new MongoDate())));
			_::upload()->send('s3','delete','msn/'.$f['fd'].'/'.$f['pt']);
			_::cache()->delete('ca1','friend_home',0);
			_::move('/friend/?deleted');
		}
	}
	_::move('/friend');
}



$template=_::template();
if($f=$db->findone('msn',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false))))
{
	$template->assign('friend',$f);
}
echo $template->fetch('report');
exit;
?>


