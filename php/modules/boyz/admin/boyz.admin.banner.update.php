<?php

$db=_::db();
if(!$banner=$db->findone('boyz_banner',array('_id'=>intval(_::$path[1]))))
{
	_::move('/');
}

if(isset($_FILES) && isset($_FILES['thumb']))
{
	$s=array('status'=>'FAIL','message'=>'ไฟล์ไม่ถูกต้อง');
	if($m=$_FILES['thumb']['tmp_name'])
	{
		$q=_::upload()->send('s3','upload','@'.$m,array('name'=>_::$path[1],'folder'=>'boyz/banner','width'=>650,'height'=>385,'fix'=>'both','type'=>'jpg'));
		//if($p=$photo->thumb(_::$path[1],$m,'boyz/banner',650,385,'both','jpg'))
		if($q['status']=='OK')
		{
			$s['status']='OK';
			$s['pic']='http://s3.boxza.com/boyz/banner/'.$q['data']['n'].'?'.rand(1,999);
		}
	}
	echo json_encode($s);
	exit;
}
_::ajax()->register(array('update','setbanner'),'admin.banner');

$error=array();

//if($_POST)require_once(__DIR__.'/boyz.admin.news.update.post.php');


$template->assign('banner',$banner);
$template->assign('html',_::html());
_::$content=$template->fetch('admin.banner.update');

?>