<?php
if($id=intval($line))
{
	$db = _::db();
	if($photo=$db->findOne('line',array('_id'=>$id,'ty'=>'photo','dd'=>array('$exists'=>false),'ex'=>array('$gte'=>new mongodate())),array('_id'=>1,'u'=>1,'pt'=>1,'ms'=>1,'sh'=>1,'lk'=>1,'ds'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-30))))
	{
		$u=_::user();
		$photo['pt']['a']=$db->findOne('line',array('_id'=>$photo['pt']['a'],'ty'=>'album'),array('_id'=>1,'tt'=>1));
		$photo['ds']=$photo['ds']->sec;
		$photo['u']=$u->profile($photo['u']);
		if($photo['cm'])
		{
			for($j=0;$j<count($photo['cm']['d']);$j++)
			{
				$photo['cm']['d'][$j]['u'] = $u->profile($photo['cm']['d'][$j]['u']);
				$photo['cm']['d'][$j]['t'] = $photo['cm']['d'][$j]['t']->sec;
			}
		}
		$template=_::template();
		$template->assign('photo',$photo);
		_::$content = $template->fetch('photos.photo');
	}
}
if(!$photo)
{
	_::move('/photos',true);
}
?>