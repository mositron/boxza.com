<?php
class upload
{
	public function __construct()
	{
		
	}
	public function getkey($url,$par)
	{
		if(_::$my && intval(_::$my['st'])>=0)
		{
			$data=array('_id'=>_::$my['_id'],'par'=>$par);
			$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
			$s = strtr(base64_encode(hash_hmac('sha256', $d, $data['_id'].'-up-to-'.trim($url,'/'), true)), '+/', '-_');
			return $s.'.'.$d;
		}
	}
	
	public function get($method,$file,$data='')
	{
		$tmp=json_encode($data);
		$key=md5($method.'-'.$tmp);
		return json_decode(_::http()->get('http://upload.boxza.com/json',array('key'=>$key,'method'=>$method,'file'=>$file,'data'=>$tmp)),true);
	}
	
	public function send($serv,$method,$file,$data='',$decode=true)
	{
		if(isset(_::$config['upload'][$serv]))
		{
			$tmp=json_encode($data);
			$key=md5($method.'-'.$tmp);
			$json=_::http()->get(_::$config['upload'][$serv],array('key'=>$key,'method'=>$method,'file'=>$file,'data'=>$tmp));
			return $decode?json_decode($json,true):$json;
		}
		else
		{
			return array('status'=>'FAIL','message'=>'no server');
		}
	}
}
?>