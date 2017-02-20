<?php

function checkout_nofollow($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(boxza|boxzacar|boxzaracing|doodroid|google|teededball|boxzafootball|autocar)\.(.*)$/',$arg[1]))
	{
		return 	'<a href="'.$arg[1].'" target="_blank">';
	}
	else
	{
		return 	'<a href="http://out.boxza.com/#'.base64_encode($arg[1]).'" target="_blank">';
	}
}

function checkout_iframe($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(youtube)\.com(.*)$/',$arg[2]))
	{
		return 	'<iframe'.$arg[1].'src="'.$arg[2].'"'.$arg[3].'>';
	}
	else
	{
		return 	'<iframe width="0" height="0">';
	}
}

$error=array();
$arg=array();
$arg['d']=trim($_POST['detail']);
# remove nofollow for link to boxza.com
//$arg['d']=preg_replace('/\<a href\="http\:\/\/([a-z0-9\.]+)?boxza\.com([^"]+)"([^\>]+)?"\>/i','<a href="http://\1boxza.com\2" target="_blank">',$arg['d']);
$arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['d']);
$arg['d']=preg_replace_callback('/\<iframe([^\>]+)src\="([^"]+)"([^\>]+)?"\>/i','checkout_iframe',$arg['d']);

$badword = '('.implode('|',require(HANDLERS.'boxza/badword.php')).')';
	
	
if(!$arg['d'])
{
	$error['detail']='กรุณากรอกรายละเอียดของกระทู้';	
}
elseif(preg_match('/'.$badword.'/i',$arg['d'],$bw))
{
	$error['detail']='ไม่สามารถใช้คำว่า "'.$bw[1].'" ในรายละเอียดกระทู้ได้';
}
elseif((mb_strlen($arg['d'],'utf-8')>5000) && (!_::$my['am']))
{
	$error['detail']='เนื้อหาของกระทู้มีความยาวมากเกินไป (สุงสุด 5,000ตัวอักษร)';	
}
elseif(preg_match('/\[([url|img|b|color]+)([^\]]*)\]/i',$arg['d']))
{
	$error['detail']='ไม่สามารถใช้งาน BBCode ได้';
}
elseif(preg_match('/\<(script|style)([^\>]*)\>/i',$arg['d']))
{
	$error['detail']='ไม่สามารถใช้งาน &lt;script&gt;, &lt;style&gt;, ได้';
}
else
{
	$db=_::db();
	//$arg['d'] = htmlspecialchars($arg['d'], ENT_QUOTES,'utf-8');
	$push=true;
	if(!is_array($tmp['cm']))
	{
		$tmp['cm']=array('c'=>0,'i'=>0,'u'=>array(),'l'=>array());
		$push = false;
	}
	$cm_u= (array)$tmp['cm']['u'];
	$cm_i = intval($tmp['cm']['i'])+1;
	$cm_c = count($tmp['cm']['d'])+1;
	if(!in_array(_::$my['_id'],$cm_u) && _::$my['_id']!=$tmp['u'] && _::$my['_id']!=$tmp['p'])
	{
		array_push($cm_u,_::$my['_id']);
	}
	if($push)
	{
		$arg2 = array('$set'=>array('cm.c'=>$cm_c,'cm.i'=>$cm_i,'cm.u'=>$cm_u),'$push'=>array('cm.d'=>array('i'=>$cm_i,'m'=>$arg['d'],'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])));
	}
	else
	{
		$arg2 = array('$set'=>array('cm'=>array('c'=>$cm_c,'i'=>$cm_i,'u'=>$cm_u,'d'=>array(array('i'=>$cm_i,'m'=>$arg['d'],'u'=>_::$my['_id'],'t'=>new MongoDate(),'p'=>$_SERVER['REMOTE_ADDR'])))));
	}
	$arg2['$set']['ds']=new MongoDate();
	$db->update('forum',array('_id'=>$tmp['_id']),$arg2);
	
	$frch=array(1);
	if(defined('FORUM_CHAT'))
	{
		$frch[]=FORUM_CHAT;
	}
	$cache=_::cache();
	foreach($frch as $_bzi)
	{
		$_bzcb=$cache->get('ca2','chatbox_text_'.$_bzi);
		if(!is_array($_bzcb) || !is_array($_bzcb['text']))
		{
			$_bzcb=array('text'=>array(),'wait'=>array(),'ban'=>array('_id'=>array(),'ip'=>array()),'bot'=>array());
		}
		$time=microtime(true);
		array_push($_bzcb['text'],array('ty'=>'ms','u'=>_::$my['_id'],'_id'=>$time,'_sn'=>str_replace('.','_',strval($time)),'t'=>date('H:i',$time),'p'=>'','m'=>'ตอบกระทู้ใน: "<a href="http://forum.boxza.com/topic/'.$tmp['_id'].'/last#last" target="_blank">'.$tmp['t'].'</a>"','mb'=>1,'c'=>21,'n'=>_::$my['name'],'l'=>_::$my['link'],'i'=>_::$my['img'],'am'=>0));
		$cache->set('ca2','chatbox_text_'.$_bzi,$_bzcb,false,3600*24*7);
	}
	
	
	$_rc=intval($tmp['c']);
	while($_rc && isset($cate[$_rc]))
	{
		$db->update('forum_cate',array('_id'=>$_rc),array('$inc'=>array('rp'=>1),'$set'=>array('ls'=>array('u'=>_::$my['_id'],'t'=>new MongoDate(),'f'=>$tmp['t'],'i'=>$tmp['_id'],'r'=>$cm_i))));
		if($cate[$_rc]['p'])
		{
			$_rc=$cate[$_rc]['p'];
		}
		else
		{
			$_rc=0;
		}
	}
		
		
	//$db->update('forum_cate',array('_id'=>$tmp['c']),array('$inc'=>array('rp'=>1),'$set'=>array('ls'=>array('u'=>_::$my['_id'],'t'=>new MongoDate(),'f'=>$tmp['t'],'i'=>$tmp['_id'],'r'=>$cm_i))));
	_::user()->update(_::$my['_id'],array('$inc'=>array('fr.rp'=>1)));
	_::move(FORUM_URL.'topic/'.$tmp['_id'].'/last');
}

?>