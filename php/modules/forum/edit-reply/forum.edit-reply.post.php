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
	$error['detail']='กรุณากรอกข้อความที่ต้องการตอบ';
}
elseif(preg_match('/'.$badword.'/i',$arg['d'],$bw))
{
	$error['detail']='ไม่สามารถใช้คำว่า "'.$bw[1].'" ในรายละเอียดกระทู้ได้';
}
elseif(mb_strlen($arg['d'],'utf-8')>5000)
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
elseif(trim($arg['d']))
{
	//$arg['d'] = htmlspecialchars($arg['d'], ENT_QUOTES,'utf-8');
	$db->update('forum',array('_id'=>$tmp['_id'],'cm.d'=>array('$elemMatch'=>array('i'=>intval(_::$path[defined('FORUM_IN')?2:1])))),array('$set'=>array('cm.d.$.m'=>$arg['d']),'$push'=>array('cm.d.$.e'=>array('u'=>_::$my['_id'],'ip'=>$_SERVER['REMOTE_ADDR'],'t'=>new MongoDate()))));
	_::move(FORUM_URL.'topic/'.$tmp['_id']);
}
$template->assign('error',$error);
$template->assign('post',$_POST);
?>