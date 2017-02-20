<?php

$db=_::db();


if(!$tags=$db->findone('tags',array('_id'=>_::$path[0],'amount'=>array('$gte'=>1))))
{
	_::move('/tag');
}



_::$meta['title']=$tags['_id'].' -'._::$meta['title'];
_::$meta['description']=$tags['_id'].' -'._::$meta['description'];

$link=$db->find('tags_link',array('tags'=>_::$path[0]),array(),array('sort'=>array('da'=>-1),'limit'=>100));


$template->assign('tags',$tags);
$template->assign('link',$link);

_::$content=_::template()->fetch('tag.view');


?>