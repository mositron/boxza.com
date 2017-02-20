<?php
$db = _::db();
$mail = _::mail();
$user = _::user();
$template = _::template();



$e = $db->find('emails',array(),array('_id'=>1,'email'=>1),array('sort'=>array('_id'=>1)));

for($i=0;$i<count($e);$i++)
{
	if($db->findOne('user',array('em'=>$e[$i]['email'])))
	{
		//$db->update('emails',array('_id'=>$e[$i]['_id']),array('$set'=>array('send'=>new MongoDate())));
		$db->remove('emails',array('_id'=>$e[$i]['_id']));
	}
}

echo db::$count;
/*
$col = 'email';
$e = $db->find($col,array('send'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>1),'limit'=>10));
for($i=0;$i<count($e);$i++)
{
	if(!$e[$i]['u'])$e[$i]['u']=1;
	$u = $user->get($e[$i]['u']);
	$mail->to=$e[$i]['email'];
	$mail->subject = $u['name'].' ชวนคุณมาเป็นเพื่อนใน BoxZa - โซเชียลเน็ทเวิร์คสัญชาติไทย';
	$template->assign('u',$u);
	$template->assign('email',$e[$i]['email']);
	$mail->message = $template->fetch('invite');
	
	$db->update($col,array('_id'=>$e[$i]['_id']),array('$set'=>array('send'=>new MongoDate())));
	echo '<br>-------------------------------<br>';
	echo $mail->to;
	echo '<br>';
	echo $mail->send()?'send':'fail';
	
	#echo $mail->subject;
	#echo '<br><br>';
	#echo $mail->message;
}

*/

/*
	$o=array(
	array('email'=>'positron.th@gmail.com','u'=>1),
	array('email'=>'pichit@inet-rev.co.th','u'=>1),
	array('email'=>'moo_tateeb@hotmail.com','u'=>1),
	array('email'=>'nut200sx@gmail.com','u'=>1),
	array('email'=>'deltaforce-x@hotmail.com','u'=>1),
	array('email'=>'supannee@inet-rev.co.th','u'=>1)
	);
	
	foreach($o as $a)
	{
		$u = $user->get($a['u'],false);
		$mail->to=$a['email'];
		$mail->subject = $u['name'].' ชวนคุณมาเป็นเพื่อนใน BoxZa - โซเชียลเน็ทเวิร์คสัญชาติไทย';
		$template->assign('u',$u);
		$template->assign('email',$a['email']);
		$template->assign('ref',getref($u['_id']));
		$mail->message = $template->fetch('invite');
		
		echo '<br>-------------------------------<br>';
		echo $mail->to;
		echo '<br>';
		echo $mail->send()?'send':'fail';
	}
*/
function getref($id)
{
	$u=array('t'=>time(),'u'=>$id);
	$d = strtr(base64_encode(json_encode($u)), '+/', '-_');
	$s = strtr(base64_encode(hash_hmac('sha256', $d,'invite.by.'.$id, true)), '+/', '-_');
	return $s.'.'.$d;
}
?>