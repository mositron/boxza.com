<?php
_::session()->logged();
if(!_::$my['st'] || _::$my['st']<1)
{
	_::move('http://boxza.com/verify');
}

$db=_::db();
if($tmp=$db->findone('forum',array('_id'=>FORUM_ID),array('_id'=>1,'t'=>1,'lo'=>1,'u'=>1,'c'=>1,'d'=>1,'cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'cm.d'=>1)))
{
	if(!$tmp['lo'])
	{
		$forum=$db->findone('forum_cate',array('_id'=>$tmp['c']));
		if($forum['am']&&!_::$my['am'])
		{
			
		}
		elseif($forum)
		{
			
			if($_POST)
			{
				require_once(__DIR__.'/forum.new-reply.post.php');
			}
			else
			{
				$quote=false;
				if(_::$path[defined('FORUM_IN')?2:1]=='quote')
				{
					if($_rp=_::$path[defined('FORUM_IN')?3:2])
					{
						$cm = false;
						for($i=0;$i<count($tmp['cm']['d']);$i++)
						{
							if($tmp['cm']['d'][$i]['i'] == $_rp)
							{
								$cm = $tmp['cm']['d'][$i];
								$quote=array('u'=>_::user()->profile($cm['u']), 'detail'=>$cm['m']);
								break;
							}
						}
					}
					else
					{
						$quote=array('u'=>_::user()->profile($tmp['u']), 'detail'=>$tmp['d']);
					}
					if($quote)
					{
						$template->assign('quote','<div class="quote"><div class="quote_user">อ้างอิงจาก <a href="http://boxza.com/'.$quote['u']['link'].'" target="_blank"><span>'.$quote['u']['name'].'</span></a></div><div class="quote_detail">'.$quote['detail'].'</div></div><p>&nbsp;</p><p>&nbsp;</p>');
					}
				}
			}
			
			$template->assign('forum',$forum);
			$template->assign('topic',$tmp);
			_::$content=$template->fetch2(FORUM_TPL.'new-reply');
		}
	}
	else
	{
		_::move(FORUM_URL);
	}
}
else
{
	_::move(FORUM_URL);
}

?>