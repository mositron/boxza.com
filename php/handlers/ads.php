<?php
class ads
{
	public function __construct($key='default')
	{
		
	}


	public function fetch($v,$s='')
	{
		$u=array('i'=>$v['_id'],'l'=>$v['l'],'t'=>time(),'p'=>_::$type,'s'=>$s);
		$d = strtr(base64_encode(json_encode($u)), '+/', '-_');
		return 'http://boxza.com/ads/click/?__b='.urlencode($d);
	}
	
}

?>