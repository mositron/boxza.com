<?php


list($f,$ty)=explode('.',_::$path[0],2);

$db=_::db();
if($image=$db->findone('image',array('f'=>$f,'dd'=>array('$exists'=>false))))
{
	if($ty!=$image['ty'])
	{
		_::move('/v/'.$image['f'].'.'.$image['ty'],true);
	}
	if(!_::$my && !_::$my['am'])
	{
		$db->update('image',array('_id'=>$image['_id']),array('$set'=>array('ds'=>new MongoDate()),'$inc'=>array('do'=>1)));
	}
	
_::$meta['title'] = 'รูปภาพ '.$image['n'].' - '._::$path[0].' - '._::$meta['title'];
_::$meta['description'] = 'รูปภาพ '.$image['n'].' - '._::$path[0].' - '._::$meta['description'];

	//_::time();
	$template->assign('image',$image);
	_::$content=$template->fetch('view');


#	$cache->set('ca1','boyz_home',_::$content,false,300);
#}
}
else
{
	_::move('/',true);
}
?>