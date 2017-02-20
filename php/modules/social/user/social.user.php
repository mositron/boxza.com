<?php

if($_FILES['photo'])
{
	require_once ROOT_MODULES.'line/social.line.post.php';
}
elseif($_FILES['header']||$_FILES['avatar']||$_POST['upload_bg'])
{
	require_once(__DIR__.'/social.user.post.php');
}

_::ajax()->register(array('vote','setrec','sendgift','addpoint','setban','resetavatar','setblock','hackbywut','setverify','sethideall','buypet','sellpet'),'user');




$open=array('al'=>false,'fr'=>false,'pt'=>false,'ms'=>false,'ln'=>false);
$friend = false;

$template=_::template();

# Show All
//if((!_::$profile['op']['pf']['al']) || ((_::$my) && ((_::$my['_id']==_::$profile['_id'])|| (_::$profile['op']['pf']['al']==1))))
//{
	$open['al']=true;
//}
if((_::$my) && (in_array(_::$my['_id'],(array)_::$profile['ct']['fl'])))
{
	$open['al']=true;
	$friend=1;
	define('IS_FRIEND',1);
}

# Post to line
if((_::$my && ((_::$my['_id']==_::$profile['_id']) || !_::$profile['op']['pf']['ln'])))
{
	$open['ln']=true;
}


$pf=array(array(),array());
$gd=intval(_::$profile['op']['pf']['gd']);
$pf[0]['gd']=_::$config['gender'][_::$profile['if']['gd']];
$pf[1]['gd']='<span>'.$pf[0]['gd'].'</span>';

$gd=intval(_::$profile['op']['pf']['rl']);
if($rl2=_::$config['relate'][intval(_::$profile['if']['rl'])])
{
	$pf[0]['rl']=$rl2;
	$pf[1]['rl']='<span>'.$pf[0]['rl'].'</span>'; 
}

$gd=intval(_::$profile['op']['pf']['bd']);
$month=array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
$d = explode('-',date('d-m-Y',_::$profile['if']['bd']->sec));
$pf[0]['bd']=$d[0].' '.$month[intval($d[1])-1].(_::$profile['op']['pf']['yr']?'':' '.intval($d[2]+543));
$pf[1]['bd']='วันเกิด <span>'.$pf[0]['bd'].'</span>';

$gd=intval(_::$profile['op']['pf']['pr']);

$prov = require(HANDLERS.'boxza/province.php');
$pf[0]['pr']=(_::$profile['if']['pr']?'จังหวัด ':'').$prov[_::$profile['if']['pr']]['name_th'];
$pf[1]['pr']='<span>'.$pf[0]['pr'].'</span>';

$template->assign('user',_::user());
$template->assign('open',$open);
$template->assign('friend',$friend);
$template->assign('pf',$pf);
$template->assign('is_profile', 1);

if(_::$path[0]  && (in_array(_::$path[0],array('friends','photos','line','about'))))
{
	require_once(__DIR__.'/social.user.'._::$path[0].'.php');
}
elseif(_::$path[0])
{
	_::move('/'._::$profile['link']);
}
else
{
	_::$path[0]='about';
	require_once(__DIR__.'/social.user.about.php');
}

if(_::$profile['google'])
{
	_::$meta['google']=_::$profile['google'];
}

$template->assign('user',_::user());
$template->assign('open',$open);
$template->assign('service',_::sidebar()->service(array('line'=>1)));


_::$content=$template->fetch('user');
?>