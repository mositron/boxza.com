<?php
_::session()->logged();
$db=_::db();


if($topic = $db->findone('forum',array('_id'=>FORUM_ID),array('_id'=>1,'t'=>1,'c'=>1,'d'=>1,'fd'=>1,'f'=>1,'o'=>1,'s'=>1,'dd'=>1,'e'=>1,'u'=>1,'ic'=>1,'cm.c'=>1,'sk'=>1,'lo'=>1,'rc'=>1,'da'=>1,'tags'=>1,'place'=>1,'people'=>1)))
{
	$forum=$db->findone('forum_cate',array('_id'=>$topic['c']));
	if($topic['u']==_::$my['_id'] || intval(_::$my['am'])>=6)
	{
		_::ajax()->register(array('getpeople'));

		if($_POST)
		{
			require_once(__DIR__.'/forum.edit-topic.post.php');
		}

		$place=array();
		if($topic['place'])
		{
			for($i=0;$i<count($topic['place']);$i++)
			{
				if($s=$db->findone('place',array('_id'=>intval($topic['place'][$i])),array('_id'=>1,'n'=>1,'lk'=>1)))
				{
					$place[]=$s;
				}
			}
		}
		$people=array();
		if($topic['people'])
		{
			for($i=0;$i<count($topic['people']);$i++)
			{
				if($s=$db->findone('people',array('_id'=>intval($topic['people'][$i])),array('_id'=>1,'n'=>1,'nn'=>1,'fn'=>1,'ln'=>1,'lk'=>1)))
				{
					$people[]=$s;
				}
			}
		}
		$template->assign('place',$place);
		$template->assign('people',$people);
		$template->assign('topic',$topic);
		_::$content=$template->fetch2(FORUM_TPL.'edit-topic');
	}
	else
	{
		_::move(FORUM_URL.'topic/'.FORUM_ID);
	}
}

if(!_::$content)
{
	_::move(FORUM_URL);
}

?>