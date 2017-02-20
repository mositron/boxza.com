<?php
class ads
{
	public function __construct($key='default')
	{
		
	}


	public function fetch($v)
	{
		$u=array('t'=>time(),'i'=>$v['_id'],'l'=>$v['l']);
		$d = strtr(base64_encode(json_encode($u)), '+/', '-_');
		$s = strtr(base64_encode(hash_hmac('sha256', $d,'__'.$v['_id'], true)), '+/', '-_');
		return 'http://boxza.com/ads/click/?__b='.$v['_id'].'.'.$s.'.'.$d;
	}
	
}

?>