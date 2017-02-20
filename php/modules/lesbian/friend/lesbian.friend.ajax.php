<?php


function sendreport($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$template=_::template();
	if($f=$db->findone('msn',array('_id'=>intval($arg['friend']),'dd'=>array('$exists'=>false))))
	{
		 if(_::$my && ((_::$my['_id']==$f['u'])||(_::$my['am'] &&_::$my['am']>0)))
		 {
			 $db->update('msn',array('_id'=>$f['_id']),array('$set'=>array('dd'=>new MongoDate())));
			 _::upload()->send('s3','delete','msn/'.$f['fd'].'/'.$f['pt']);
			 $ajax->alert('ลบข้อความเรียบร้อยแล้ว');
		 }
		 elseif($arg['reason'])
		 {
			$mail=_::mail();
			$mail->to=$f['em'];
			$mail->subject = 'ลิ้งค์สำหรับลบข้อความ - iNet Friend หาเพื่อน หาแฟน หากิ๊ก หาคู่';
			$template->assign('f',$f);
			$template->assign('code',md5($f['_id'].'+d+'.$f['em']));
			$mail->message = $template->fetch('friend.report');
			$mail->send();
			$ajax->alert('ส่งลิ้งค์สำหรับการลบข้อความไปยัง '.$f['em'].' เรียบร้อยแล้ว');
		 }
		 else
		 {
			 $db->update('msn',array('_id'=>$f['_id']),array('$set'=>array('sp'=>intval($f['sp'])+1)));
			 $ajax->alert('รายงานข้อความนี้เรียบร้อยแล้ว');
		 }
		_::cache()->delete('ca1','lesbian_home',0);
		_::cache()->delete('ca1','lesbian_friend',0);
		_::cache()->delete('ca1','home',0);
	}
	
}

function setrec($id)
{
	$db=_::db();
	$ajax=_::ajax();
	$template=_::template();
	if($f=$db->findone('msn',array('_id'=>intval($id),'dd'=>array('$exists'=>false))))
	{
		if($f['fd']&&$f['pt'])
		{		
			$db->update('msn_rec',array('msn'=>intval($id)),array('$set'=>array('dd'=>new MongoDate())));
			$db->update('msn_rec',array('em'=>mb_strtolower($f['em'],'utf-8')),array('$set'=>array('dd'=>new MongoDate())));

			if($mid=$db->insert('msn_rec',array('em'=>mb_strtolower($f['em'],'utf-8'),'ty'=>$f['ty'],'ty2'=>$f['ty2'],'pr'=>$f['pr'],'ag'=>$f['ag'],'msn'=>intval($id))))
			{
				$_fd = _::folder()->fd($mid);
				$fd = substr($_fd,0,2).'/'.substr($_fd,2,2);
				$n=substr($_fd,4,2);
				$q=_::upload()->send('s3','thumb','msn/'.$f['fd'].'/'.$f['pt'],array('name'=>$n,'folder'=>'msn/rec/'.$fd,'width'=>120,'height'=>120,'fix'=>'bothtop','type'=>'jpg'));
				//if($pt=$photo->thumb($n,$file,'msn/rec/'.$fd,120,120,'bothtop','jpg'))
				if($q['status']=='OK')
				{
					$db->update('msn_rec',array('_id'=>$mid),array('$set'=>array('fd'=>$fd,'pt'=>$n.'.jpg')));
					$ajax->alert('เพิ่มเข้าเพื่อนแนะนำเรียบร้อยแล้ว');
					_::cache()->delete('ca1','lesbian_home',0);
					_::cache()->delete('ca1','lesbian_friend',0);
				}
			}
		}
	}
}
?>