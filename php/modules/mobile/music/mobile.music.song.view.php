<?php

$db=_::db();
//_::time();


if(!$music=$db->findone('music',array('_id'=>intval(_::$path[1]),'dd'=>array('$exists'=>false))))
{
	_::move('/music/song');
}
_::ajax()->register('setvdo');

$db->update('music',array('_id'=>$music['_id']),array('$inc'=>array('do'=>1)));

$music['sn2']=$music['sn'];
$z=mb_strpos($music['sn'],'(',0,'utf-8');
if($z>3)
{
	$music['sn2']=trim(mb_substr($music['sn'],0,$z,'utf-8'));
}

$music['ly']=nl2br($music['ly']);

$relate=$db->find('music',array('_id'=>array('$ne'=>$music['_id']),'ar'=>$music['ar'],'al'=>$music['al'],'dd'=>array('$exists'=>false)),array('_id'=>1,'sn'=>1),array('sort'=>array('_id'=>-1),'limit'=>20));


$template->assign('type',array('rs'=>'RS','gm'=>'GMM','yp'=>''));
$template->assign('c',$music['c']);
$template->assign('music',$music);
$template->assign('relate',$relate);


$template->assign('parent','/music/song');
$template->assign('cur','?parent='.urlencode(URL));

_::$content=$template->fetch('music.song.view');

?>