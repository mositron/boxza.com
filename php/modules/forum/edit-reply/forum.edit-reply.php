<?php
unset($content);
$db=_::db();
if($tmp = $db->findOne('forum',array('_id'=>FORUM_ID,'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'c'=>1,'cm.d'=>1,'cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'u'=>1)))
{
	$cm = false;
	$_reply=_::$path[defined('FORUM_IN')?2:1];
	for($i=0;$i<count($tmp['cm']['d']);$i++)
	{
		if($tmp['cm']['d'][$i]['i'] == $_reply)
		{
			$cm = $tmp['cm']['d'][$i];
			break;
		}
	}
	if($cm)
	{
		if($cm['u']==_::$my['_id'] || intval(_::$my['am'])>=6)
		{
			
			if($_POST)
			{
				require_once(__DIR__.'/forum.edit-reply.post.php');
			}
			
			#$c = max(0,intval($tmp['cm']['c'])-1);
			#$db->update('line',array('_id'=>$line),array('$set'=>array('cm.c'=>$c),'$pull'=>array('cm.d'=>array('i'=>_::$path[1])),'$push'=>array('cm.e'=>$cm)));
			$template->assign('reply',$cm);
			$template->assign('topic',$tmp);
			_::$content=$template->fetch2(FORUM_TPL.'edit-reply');
		}
		else
		{
			_::move(FORUM_URL.'topic/'.$tmp['_id']);
		}
	}
	else
	{
		_::move(FORUM_URL.'topic/'.$tmp['_id']);
	}
}
else
{
	_::move(FORUM_URL);
}
?>