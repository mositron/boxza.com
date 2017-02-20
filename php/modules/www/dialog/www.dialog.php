
<?php
_::session()->logged();

//_::time();

$template=_::template();
if(_::$path[0]=='photos')
{
	$ct = $template->fetch('dialog.photos');
}
elseif(_::$path[0]=='album')
{
	$template->assign('album',_::db()->findOne('line',array('_id'=>intval(_::$path[1]),'ty'=>'album','u'=>_::$my['_id'],'dd'=>array('$exists'=>false))));
	$ct = $template->fetch('dialog.album');
}
elseif(_::$path[0]=='upload')
{
	$template->assign('profile',_::db()->findOne('user',array('_id'=>_::$my['_id']),array('pf'=>1)));
	$ct = $template->fetch('dialog.upload');
}
elseif(_::$path[0]=='gift')
{
	$template->assign('user',_::user()->profile(intval(_::$path[1])));
	
	$gift=array();
	$_g=_::db()->find('lionica_item_shop',array('ty'=>'gift','pl'=>1),array(),array('sort'=>array('da'=>-1)));
	foreach($_g as $g)
	{
		$gift[$g['_id']]=$g;	
	}
	$template->assign('gift',$gift);
	$ct = $template->fetch('dialog.gift');
}
elseif(_::$path[0]=='point')
{
	if(_::$my['am']>=9)
	{
		$template->assign('user',_::user()->get(intval(_::$path[1]),true));
		$ct = $template->fetch('dialog.point');
	}
}
elseif(_::$path[0]=='announced')
{
	if(_::$my['am']>=9)
	{
		$template->assign('announced',_::db()->findone('msg',['_id'=>'announced'],['msg'=>1]));
		$ct = $template->fetch('dialog.announced');
	}
}
elseif(_::$path[0]=='avatar')
{
	$w=$h=500;
	//$file = FILES.'profile/'._::$my['if']['fd'].'/o.jpg';
	$q=_::upload()->send('s1','getsize','profile/'._::$my['if']['fd'].'/o.jpg');
	if($q['status']=='OK')
	{
		if($q['data']['w']>0)$w=$q['data']['w'];
		if($q['data']['h']>0)$h=$q['data']['h'];
	}
	$template->assign(array('w'=>$w,'h'=>$h));
	$template->assign('picture','http://s1.boxza.com/profile/'._::$my['if']['fd'].'/o.jpg?v='.rand(1,9999));
	$ct = $template->fetch('dialog.avatar');
}
elseif(_::$path[0]=='report')
{
	$template->assign('reason',require(HANDLERS.'boxza/reason.php'));
	$template->assign('line',_::db()->findOne('line',array('_id'=>intval(_::$path[1]),'dd'=>array('$exists'=>false))));
	$ct = $template->fetch('dialog.report');
}
elseif(_::$path[0]=='line')
{
	$ct = $template->fetch('dialog.line');
}
elseif(_::$path[0]=='list')
{
	$ct = $template->fetch('dialog.list');
}
elseif(_::$path[0]=='email')
{
	$ct = $template->fetch('dialog.email');
}
$template->assign('ct',$ct);
echo $template->fetch('dialog');
exit;

?>