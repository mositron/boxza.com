<?php
$status=['status'=>'FAIL','message'=>'กรุณากรอกข้อมูลให้ครบถ้วน'];
if(isset($_POST['email'])&&isset($_POST['password']))
{
	$db=_::db();
	$fields=_::user()->fields;
	$fields['pw']=1;
	if($u=$db->findOne('user',array('em'=>strtolower(trim($_POST['email']))),$fields))
	{
		if($u['pw']==md5(md5($_POST['password'])))
		{
			$u['aways']=1;
			unset($u['pw']);
			$status=['status'=>'OK','cookie'=>_::session()->set($u,false)];
		}
		else
		{
			$status=['status'=>'FAIL','message'=>'อีเมล์หรือรหัสผ่านไม่ถูกต้อง'];
		}
	}
	else
	{
		$status=['status'=>'FAIL','message'=>'อีเมล์หรือรหัสผ่านไม่ถูกต้อง'];
	}
}
elseif(isset($_POST['fblogin']))
{
	$arg = explode('#',aes256Decrypt('BoxZa24iOSforAppszxcvbnmasdfghjk',base64_decode($_POST['fblogin'])),3);
	if($arg[1])
	{
		$email=strtolower($arg[1]);
		$db=_::db();
		$fields=_::user()->fields;
		if($u=$db->findOne('user',array('em'=>$email),$fields))
		{
			$u['aways']=1;
			unset($u['pw']);
			$status=['status'=>'OK','cookie'=>_::session()->set($u,false)];
		}
		else
		{
			$status=['status'=>'FAIL','message'=>'ไม่มีอีเมล์นี้อยู่ใน BoxZa.com'];
		}	
	}
}
_::$content[] = array('method'=>'oauth','data'=>$status);


function aes256Decrypt($key, $data)
{
  if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
  $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
  $padding = ord($data[strlen($data) - 1]); 
  return substr($data, 0, -$padding); 
}

?>

