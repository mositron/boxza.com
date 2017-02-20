<?
function submit($frm,$attachments=false)
{
	$ajax=_::ajax();	
	if(!trim($frm['subject']))
	{
		$ajax->script('plus.load.show("กรุณากรอกหัวเรื่อง")');
	}
	elseif(!trim($frm['message']))
	{
		$ajax->script('plus.load.show("กรุณากรอกข้อความ")');
	}
	elseif(!_::$my&&!trim($frm['name']))
	{
		$ajax->script('plus.load.show("กรุณากรอกชื่อ")');
	}
	else
	{
		$db=_::db();
		$format=_::format();
		if(!$topic=$db->GetRow('select id,name,user,link from forum_topic where title=? and forum=?',array(trim($frm['subject']),FORUM_ID)))
		{
			if(_::$my['_id'])
			{
				$db->Execute("insert forum_topic set title=?,detail=?,time=now(),lastupdate=now(),user=?,forum=?,icon=?,ip=?".(defined('MY_ADMIN')?",sticky='".((int)$frm['sticky'])."'":""),array(trim($frm['subject']),trim($frm['message']),MY_ID,FORUM_ID,$frm['icon'],$_SERVER['REMOTE_ADDR']));
			}
			elseif($frm['name'])
			{
				$db->Execute("insert forum_topic set title=?,detail=?,time=NOW(),lastupdate=now(),name=?,forum=?,icon=?,ip=?",array(trim($frm['subject']),trim($frm['message']),trim($frm['name']),FORUM_ID,$frm['icon'],$_SERVER['REMOTE_ADDR']));
			}
			if($id=$db->Insert_ID())
			{
				$link=$format->link($id.'-'.$frm['subject']);
				$db->Execute("update forum_topic set link=? where id=?",array($link,$id));
				$forum=FORUM_ID;
				while($forum)
				{
					$db->Execute("update forum set lasttopic=? where id=?",array($id,$forum));
					$forum=$db->GetOne('select parent from forum where id=?',array($forum));
				}
				if(defined('MY_ID'))
				{
					$db->Execute('update user set point=point+2,total_topic=total_topic+1 where id=?',array(MY_ID));
				}
				$cache=_::cache();
				$cache->clean('forum/home');
			}
			if($attachments)
			{
				$ajax->redirect(QUERY.'forum/edit-topic/'.$link.'/attachments');
			}
			else
			{
				$ajax->redirect(QUERY.'forum/'.FORUM_LINK.'/'.$link);
			}
		}
		else
		{
			if($topic['user']==MY_ID)
			{
				$ajax->redirect(QUERY.'forum/'.FORUM_LINK.'/'.$topic['link']);
			}
			else
			{
				$ajax->script('plus.load.show("ไม่สามารถตั้งกระทู้ซ้ำได้")');
			}
		}
	}
}

function update($frm)
{
	$ajax =_::ajax();	
	if(!trim($frm['subject']))
	{
		$ajax->script('plus.load.show("กรุณากรอกหัวเรื่อง")');
	}
	elseif(!trim($frm['message']))
	{
		$ajax->script('plus.load.show("กรุณากรอกข้อความ")');
	}
	else
	{
		$db=_::db();
		$frm['detail']=stripslashes($frm['detail']);	
		$format=fz::h('format');
		$link=$format->link(TOPIC_ID.'-'.$frm['subject']);
		if(_::$path[2]=='attachments'||defined('MY_ADMIN'))
		{
			$db->Execute("update forum_topic set title=?, link=?, detail=?,icon=? where id=?",array(trim($frm['subject']),$link,trim($frm['message']),$frm['icon'],TOPIC_ID));
			if(defined('MY_ADMIN'))
			{
				$db->Execute("update forum_topic set sticky=?, locked=? where id=?",array((int)$frm['sticky'],($frm['locked']?'yes':'no'),TOPIC_ID));
				if($frm['dig'])
				{
					$forum=FORUM_ID;
					while($forum)
					{
						$db->Execute("update forum set lasttopic=? where id=?",array(TOPIC_ID,$forum));
						$forum=$db->GetOne('select parent from forum where id=?',array($forum));
					}
				}
			}
		}
		else
		{
			$db->Execute("update forum_topic set title=?, link=?, detail=?,icon=?,lastuser=?,lastedit=now(),countedit=countedit+1  where id=?",array(trim($frm['subject']),$link,trim($frm['message']),$frm['icon'],MY_ID,TOPIC_ID));
		}
		if(defined('MY_ADMIN')&&$frm['moveforum'])
		{
			$db->Execute("update forum_topic set forum=? where id=?",array($frm['moveforum'],TOPIC_ID));		
		}
		$ajax->redirect(QUERY.'forum/'.FORUM_LINK.'/'.$link);
		$cache=_::cache();
		$cache->clean('forum/home');
		$cache->delete('view_'.TOPIC_ID.'_1','forum/view');
		$cache->delete('view_'.TOPIC_ID.'_last','forum/view');
	}
}

function reply($frm)
{
	$ajax=_::ajax();	
	if(!trim($frm['message']))
	{
		$ajax->script('plus.load.show("กรุณากรอกข้อความ")');
	}
	elseif(!defined('MY_ID')&&!trim($frm['name']))
	{
		$ajax->script('plus.load.show("กรุณากรอกชื่อ")');
	}
	else
	{
		$db=_::db();
		if(!$reply=$db->GetOne('select id from forum_topic where id=? and reply_user=?',array(TOPIC_ID,MY_ID)))
		{
			if(defined('MY_ID'))
			{
				$db->Execute("insert forum_reply set topic=?,detail=?, user=?,ip=?,time=NOW()",array(TOPIC_ID,$frm['message'],MY_ID,$_SERVER['REMOTE_ADDR']));
			}
			elseif($frm['name'])
			{
				$db->Execute("insert forum_reply set topic=?,detail=?, name=?,ip=?,time=NOW()",array(TOPIC_ID,$frm['message'],trim($frm['name']),$_SERVER['REMOTE_ADDR']));
			}
			if($id=$db->Insert_ID())
			{
				$db->Execute('update forum_topic set reply_id=?, reply_user=?, reply_time=now(),lastupdate=now() where id=?',array($id,MY_ID,TOPIC_ID));
				$forum=FORUM_ID;
				while($forum)
				{
					$db->Execute("update forum set lasttopic=? where id=?",array(TOPIC_ID,$forum));
					$forum=$db->GetOne('select parent from forum where id=?',array($forum));
				}
				$ajax->redirect(QUERY.'forum/'.FORUM_LINK.'/'.TOPIC_LINK.'/page-last');
				if(defined('MY_ID'))
				{
					$db->Execute('update user set point=point+1,total_reply=total_reply+1 where id=?',array(MY_ID));
				}
				$cache=_::cache();
				$cache->clean('forum/home');
				$cache->delete('view_'.TOPIC_ID.'_last','forum/view');
				$count=max(1,$db->GetOne('select count(id) from forum_reply where topic=? and status=?',array(TOPIC_ID,'publish')));
				for($i=1;$i<=ceil($count/20);$i++)
				{
					$cache->delete('view_'.TOPIC_ID.'_'.$i,'forum/view');
				}
			}
			else
			{
				$ajax->script('plus.load.show("ไม่สามารถตอบกระทู้ได้ในขณะนี้")');
			}
		}
		else
		{
			$ajax->script('plus.load.show("ไม่สามารถตอบกระทู้ซ้ำได้")');
		}
	}
}
function updatereply($frm)
{
	$ajax=_::ajax();	
	if(!trim($frm['message']))
	{
		$ajax->script('plus.load.show("กรุณากรอกข้อความ")');
	}
	else
	{
		$db=_::db();
		$db->Execute("update forum_reply set detail=?, lastuser=?,lastedit=now(),countedit=countedit+1,ip=? where id=?",array($frm['message'],MY_ID,$_SERVER['REMOTE_ADDR'],REPLY_ID));
		$ajax->redirect(QUERY.'forum/'.FORUM_LINK.'/'.TOPIC_LINK);
		$cache=_::cache();
		if($count=$db->GetOne('select count(id) from forum_reply where topic=? and status=?',array(TOPIC_ID,'publish')))
		{
			$cache->delete('view_'.TOPIC_ID.'_last','forum/view');
			for($i=1;$i<=ceil($count/20);$i++)
			{
				$cache->delete('view_'.TOPIC_ID.'_'.$i,'forum/view');
			}
		}
	}
}

function banuser($id,$reason)
{
	$ajax=_::ajax();
	if(defined('MY_ADMIN'))
	{
		$db=_::db();
		$db->Execute("update user set user.status=?,
		user.sig=CONCAT_WS(' ','Email:',user.email,' - IP:',user.ip,' At time:',user.lasttime,?)
		where id=?",array('ban',$reason,$id));
		$ajax->redirect(URL);
		$cache=_::cache();
		$cache->clean('forum/home');
		$cache->clean('forum/view');
		$cache->clean('user/login');
	}
}

function updateattach()
{
	$ajax=_::ajax();
	$ajax->assign('forumattach','innerHTML',forumattach());
}

function delattach($id)
{
	$ajax=_::ajax();
	$db=_::db();
	if($attach=$db->GetRow('select * from forum_attach where topic=? and id=?',array(TOPIC_ID,$id)))
	{
		@unlink(FILES.'forum/attach/'.$attach['folder'].'/'.$attach['id'].'.txt');
		$db->Execute('delete from forum_attach where topic=? and id=?',array(TOPIC_ID,$id));
	}
	$ajax->assign('forumattach','innerHTML',forumattach());
}
?>