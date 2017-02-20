<?php


class point
{
	public function __construct()
	{
		
	}
	
	
	public function action($uid, $credit, $type, $detail)
	{
		$db=_::db();
		if($my = $db->findOne('user',array('_id'=>$uid),array('cd'=>1)))
		{
			if(!$my['cd'])
			{
				$before = array('p'=>0,'h'=>'');
			}
			else
			{
				$before = array('p'=>$my['cd']['p'],'h'=>$my['cd']['h']);
			}
			$p = $this->decode($before['h']);
			$s = intval($p)+$credit;
			if($s>=0)
			{
				$after = array('p'=>$s, 'h'=>$this->encode($s));
				_::user()->update($uid,array('$set'=>array('cd'=>$after)));
				$db->insert('point',array('u'=>$uid,'bf'=>$before,'af'=>$after,'ty'=>$type,'p'=>$credit,'m'=>$detail,'ip'=>$_SERVER['REMOTE_ADDR']));
				//$db->insert('line',array('u'=>$uid,'ty'=>'point','tt'=>$credit,'ms'=>$detail));
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			die('uid not found');
		}
	}
	
	protected function encode($code)
	{
		return base64_encode(json_encode($code));
	}
	
	protected function decode($code)
	{
		return json_decode(base64_decode($code), true);
	}
}


?>