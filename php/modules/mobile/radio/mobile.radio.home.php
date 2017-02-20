<?php


$tmp=require(HANDLERS.'boxza/radio.php');

$radio=array();
foreach($tmp as $k=>$v)
{
	if($v['py']['streamer'])
	{
		$v['file']=$v['py']['streamer'].'/'.$v['py']['file'];
	}
	else
	{
		$v['file']=$v['py']['file'];
	}
	$v['swf']=($v['py']['swf']?$v['py']['swf']:'');
	unset($v['ty'],$v['py']);
	$radio[$k]=$v;
}


$template->assign('radio',$radio);



_::$content=$template->fetch('radio.home');



?>
