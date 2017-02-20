<?php


$db=_::db();
if(!$album=$db->findone('line',array('_id'=>intval(_::$path[0]),'ty'=>'album','dd'=>array('$exists'=>false),'lo'=>array('$exists'=>false)),array('_id'=>1,'da'=>1,'du'=>1,'tt'=>1,'ms'=>1,'pt'=>1,'vt'=>1,'u'=>1,'cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'cm.d'=>array('$slice'=>-100))))
{
	_::move('/');
}

//_::time();



_::$meta['title']='อัลบั้ม '.$album['tt'].' - '._::$meta['title'];
_::$meta['image']='http://s1.boxza.com/line/'.$album['pt']['cv']['f'].'/o.'.$album['pt']['cv']['e'];


_::ajax()->register(array('vote','sendcommend'));

$photo = $db->find('line',array('ty'=>'photo','pt.a'=>intval(_::$path[0]),'dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'ms'=>1,'in'=>1,'pt'=>1),array('sort'=>array('_id'=>-1),'limit'=>100));

if(!$album['pt']['cv'])
{
	$album['pt']['cv']=array('i'=>$photo[0]['_id'],'f'=>$photo[0]['pt']['f'],'n'=>$photo[0]['pt']['n']);
}
$template->assign('album',$album);
$template->assign('comment',getcomment($album));
$template->assign('photo',$photo);
$template->assign('user',_::user()->profile($album['u']));
_::$content=$template->fetch('view');

function getcomment($album=false)
{
	if(!$album)
	{
		$album=_::db()->findone('line',array('_id'=>intval(_::$path[0]),'ty'=>'album','dd'=>array('$exists'=>false),'lo'=>array('$exists'=>false)),array('_id'=>1,'da'=>1,'du'=>1,'tt'=>1,'ms'=>1,'pt'=>1,'vt'=>1,'u'=>1,'cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'cm.d'=>array('$slice'=>-100)));
	}
	$template=_::template();
	$template->assign('album',$album);
	return $template->fetch('view.comment');
}

function vote()
{
	if($_SERVER['HTTP_USER_AGENT'])
	{
		$ip=$_SERVER['REMOTE_ADDR'];
		if($ip)
		{
			$db=_::db();
			$ajax=_::ajax();
			if($f=$db->findOne('album_vote',array('a'=>intval(_::$path[0]),'ip'=>$ip,'tm'=>array('$gt'=>new MongoDate(time()-3600)))))
			{
				$ajax->alert('IP นี้ทำการโหวตอัลบั้มนี้ไปแล้ว คุณสามารถโหวตได้อีกครั้งในชมถัดไป');
			}
			elseif($album=$db->findone('line',array('_id'=>intval(_::$path[0]),'ty'=>'album','dd'=>array('$exists'=>false),'lo'=>array('$exists'=>false)),array('_id'=>1,'pt'=>1)))
			{
				$vote=intval($album['pt']['vt']);
				$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt.vt'=>($vote+1))));
				$db->insert('album_vote',array('a'=>$album['_id'],'ip'=>$ip,'tm'=>new MongoDate(),'ua'=>$_SERVER['HTTP_USER_AGENT']));
				$ajax->alert('โหวตเรียบร้อยแล้ว');
				$ajax->jquery('#voten','html',$vote+1);
			}
		}
	}
}


function sendcommend($arg)
{
	$ajax=_::ajax();
	if(_::$my['_id'])
	{
		$msg = htmlspecialchars(trim(mb_substr($arg['ms'],0,1024,'utf-8')), ENT_QUOTES,'utf-8');
		if(($id=intval(trim(_::$path[0]))) && $msg)
		{
			$db = _::db();
			if($tmp = $db->findOne('line',array('_id'=>$id,'dd'=>array('$exists'=>false)),array('cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'u'=>1,'p'=>1,'s'=>1)))
			{
				$push = true;
				if(!is_array($tmp['cm']))
				{
					$tmp['cm']=array('c'=>0,'i'=>0,'u'=>array(),'l'=>array());
					$push = false;
				}
				$cm_u= (array)$tmp['cm']['u'];
				$cm_i = intval($tmp['cm']['i'])+1;
				$cm_c = intval($tmp['cm']['c'])+1;
				if(!in_array(_::$my['_id'],$cm_u) && _::$my['_id']!=$tmp['u'] && _::$my['_id']!=$tmp['p'])
				{
					array_push($cm_u,_::$my['_id']);
				}
				if($push)
				{
					$arg = array('$set'=>array('cm.c'=>$cm_c,'cm.i'=>$cm_i,'cm.u'=>$cm_u),'$push'=>array('cm.d'=>array('i'=>$cm_i,'m'=>$msg,'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])));
				}
				else
				{
					$arg = array('$set'=>array('cm'=>array('c'=>$cm_c,'i'=>$cm_i,'u'=>$cm_u,'d'=>array(array('i'=>$cm_i,'m'=>$msg,'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])))));
				}
				$db->update('line',array('_id'=>$id),$arg);
				
				$notify = _::notify();
				$user = _::user();
				array_push($cm_u,$tmp['u'],$tmp['p']);
				for($i=0;$i<count($cm_u);$i++)
				{
					if((_::$my['_id']!=$cm_u[$i]) && $cm_u[$i])
					{
						if($c=$db->findOne('notify',array('u'=>_::$my['_id'],'p'=>$cm_u[$i],'rl'=>$id,'ty'=>'cm'),array('_id'=>1,'dr'=>1)))
						{
							$db->update('notify',array('_id'=>$c['_id']),array('$set'=>array('dr'=>NULL,'tt'=>mb_substr($msg,0,20,'utf-8'),'da'=>new MongoDate())));
							if($c['dr'])
							{
								if($uid=$user->get($cm_u[$i],true))
								{
									if(!is_array($uid['nf']))$uid['nf']=array('ot'=>0,'fr'=>0);
									$uid['nf']['ot']=(intval($uid['nf']['ot'])+1);
									$user->update($uid['_id'],array('$set'=>array('nf'=>$uid['nf'])));
								}
							}
						}
						else
						{
							$notify->insert($cm_u[$i],'cm',$id,mb_substr($msg,0,20,'utf-8'));
						}
					}
				}
				$ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
				$ajax->jquery('#getcomment','html',getcomment());
			}
			else
			{
				
			}
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}
?>