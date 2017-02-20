<?php
function comment($arg)
{
	$ajax=_::ajax();
	$name=strip_tags(trim(strval($arg['name'])));
	$msg=strip_tags(trim($arg['msg']));
	$msg=preg_replace('/http(s?)\:\/\/(\S+)/i','',$msg);
	$msg=mb_substr($msg,0,2000,'utf-8');
	$db=_::db();
	if(!_::$my)
	{
		$ajax->alert('กรุณาล็อคอินก่อนแสดงความคิดเห็น');
	}
	elseif($tmp=$db->findone('news',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'cm.c'=>1,'cm.i'=>1,'cm.d'=>1)))
	{
		if(mb_strlen($msg,'utf-8')<3)
		{
			$ajax->alert('ข้อความของคุณสั้นเกินไป');
		}
		else
		{
			$msg = htmlspecialchars($msg, ENT_QUOTES,'utf-8');
			$push=true;
			if(!is_array($tmp['cm']))
			{
				$tmp['cm']=array('c'=>0,'i'=>0,'d'=>array());
				$push = false;
			}
			$cm_i = intval($tmp['cm']['i'])+1;
			$cm_c = count($tmp['cm']['d'])+1;
			$arg2 = array('$set'=>array('cm.c'=>$cm_c),'$inc'=>array('cm.i'=>$cm_i),'$push'=>array('cm.d'=>array('i'=>$cm_i,'m'=>$msg,'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])));
			$db->update('news',array('_id'=>$tmp['_id']),$arg2);
			$ajax->alert('เพิ่มข้อความของคุณเรียบร้อยแล้ว กรุณารอซักครู่');
			$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
			//$ajax->script('$("#news-'._::$path[0].'-captcha").attr("src","http://bin.boxza.com/captcha/get.php?'._::$path[0].'.'.rand(1,99999).'");$("#news-form").get(0).reset();');
		}
	}
}


function delcomment($cid)
{
	_::session()->logged();
	$db=_::db();
	$ajax=_::ajax();
	if(!$cid)
	{
		$ajax->alert('ไอดีข้อความไม่ถูกต้อง');
	}
	elseif($topic=$db->findone('news',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'u'=>1,'cm.d'=>1,'cm.c'=>1)))
	{	
		$cm = false;
		for($i=0;$i<count($topic['cm']['d']);$i++)
		{
			if($topic['cm']['d'][$i]['i'] == $cid)
			{
				$cm = $topic['cm']['d'][$i];
				break;
			}
		}
		if($cm)
		{
			if(_::$my['am'])
			{
				$c = max(0,count($topic['cm']['d'])-1);
				$db->update('news',array('_id'=>$topic['_id']),array('$set'=>array('cm.c'=>$c),'$pull'=>array('cm.d'=>array('i'=>intval($cid))),'$push'=>array('cm.e'=>$cm)));
				_::move(URL);
			}
			else
			{
				$ajax->alert('คุณไม่มีสิทธิ์ลบข้อความนี้');
			}
		}
		else
		{
			$ajax->alert('ไม่มีข้อความดังกล่าว');
		}
	}
	else
	{
		$ajax->alert('กระทู้นี้ไม่มีอยู่ หรืออาจจะถุกลบไปแล้ว');
	}
}
?>