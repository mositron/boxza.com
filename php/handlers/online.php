<?php


class online
{
	public static $get;
	public function __construct()
	{
		$bot='';
		$bs=strtolower($_SERVER['HTTP_USER_AGENT']);
		if(preg_match('/(opera|chrome|msie|opera|firefox|safari)/',$bs,$c))
		{
			$type='browser';
			$browser=$c[1];
		}
		else
		{
			$type='bot';
			$browser='';
		}
			
		if(defined('MY_ID'))
		{
			$uid=MY_ID;
			$name=MY_FULLNAME;
			$type=defined('MY_ADMIN')?'admin':'user';
		}
		else
		{
			$uid=0;
			
			if(preg_match('/(msnbot|googlebot|google|yandex|yahoo|ia_archiver|bot)/',$bs,$c))
			{
				$type='bot';
				$browser=$c[1];
				if($c[1]=='msnbot')
				{
					$name='Windows Live';
				}
				elseif($c[1]=='googlebot')
				{
					$name='Google Bot';
				}
				elseif($c[1]=='ia_archiver')
				{
					$name='Alexa';
				}
				elseif($c[1]=='bot')
				{
					$name='Other Bot';
				}
				else
				{
					$name=ucfirst($c[1]);
				}
			}
			else
			{
				$name=$_SERVER['REMOTE_ADDR'];
				$type='guest';
			}
			
		}
		$db=_::db();
		
		if(defined('MY_ID'))
		{
			#$db->Execute('delete from online where uid=? and browser=?',array(MY_ID,strval($browser)));
		}
		if(!defined('MY_OFFLINE'))
		{
			$set='site=?,name=?,uid=?,ip=?,url=?,type=?,service=?,time=now(),browser=?';
			$val=array(_::$c['site']['_id'], strval($name), $uid, $_SERVER['REMOTE_ADDR'], URL,$type,strval(_::$c['service']['id']),strval($browser),strval(session_id()));
			/*if($db->GetRow('select sid from online where sid=?',array(session_id())))
			{
				$db->Execute('update online set '.$set.' where sid=?', $val);
			}
			else
			{
				$db->Execute('insert online set '.$set.',sid=?', $val);
			}*/
		}
	}
	public function get($tpl=false)
	{
		if(!isset(online::$get))
		{
			#online::$get=_::db()->GetAll('select uid,name,browser,type,url,ip from online where time > (NOW() - INTERVAL 5 MINUTE) order by type asc');
		}
		if($tmp)
		{
			$template=_::template();
		
		}
		else
		{
			return online::$get;
		}
	}
}
?>