<?php
class session
{
	public static $name='boxza-base';
	public static $key='boxza.com/v3/';
  	public function __construct()
  	{
		if(!empty($_COOKIE[self::$name]))
		{
			list($s,$p) = explode('.', $_COOKIE[self::$name], 2);
			$sig = base64_decode(strtr($s, '-_', '+/'));
			$data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);
			
			if(strtoupper($data['algorithm']) == 'HMAC-SHA256')
			{
				if($sig == hash_hmac('sha256', $p, self::$key.$data['_id'], true))
				{
					$connect=false;
					$update=false;
					$ip=array();
					$user=_::user();
					if($my=$user->get($data['_id'],true))
					{
						$status=intval($my['st']);
						if($status<0||$status>1)
						{
							return false;	
						}
						if(isset($data['hidden'])&&$data['hidden'])
						{
							_::$my=$my;
							return true;
						}
						if(!is_array($my['ip']))
						{
							$my['ip']=array($my['ip']=>'');
						}
						$ip=$my['ip'];
						if(!$my['du'] || $my['du']->sec+900<time())
						{
							$connect=true;						
							$my['du']=new MongoDate();
						}
						if(!isset($ip[$_SERVER['REMOTE_ADDR']]))
						{
							$ip[$_SERVER['REMOTE_ADDR']]=$_SERVER['HTTP_USER_AGENT'];
							$update=true;
						}
					}
					if($my)
					{
						_::$my=$my;
						$my['ip']=$ip;
						if($connect || $update)
						{
							if($connect)
							{
								$user->update($my['_id'],array('$set'=>array('du'=>new MongoDate(),'ip'=>$_SERVER['REMOTE_ADDR'])));
							}
							_::cache()->set('ca2','user-'.$my['_id'],$my,false,3600*24);
						}
						$client=(array)(isset($_COOKIE['bz_client'])?explode(',',$_COOKIE['bz_client']):array());
						if(!in_array(_::$my['_id'],$client))
						{
							$client[]=_::$my['_id'];
							if(!is_array(_::$my['if']['cli']))
							{
								_::$my['if']['cli']=array();
							}
							for($i=0;$i<count($client);$i++)
							{
								if(is_numeric($client[$i]))
								{
									$client[$i]=intval($client[$i]);
									if(!in_array($client[$i],_::$my['if']['cli']))
									{
										$user->update(_::$my['_id'],array('$push'=>array('if.cli'=>$client[$i])));
									}
								}
							}
							setcookie('bz_client',implode(',',$client),time()+2592000,'/',_::$config['domain'],false,true);
						}
						return true;
					}
				}
			}
		}
		setcookie(self::$name,'',time()+86400,'/',_::$config['domain']);
	}
	
	public function logged()
	{
		if(!_::$my)
		{
			_::move(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode(URI)));
		}
	}
	
	public function logout()
	{
		setcookie(self::$name,'',time()+86400,'/',_::$config['domain']);
	}
	
	public function set($user,$redirect=true)
	{
		$status=intval($user['st']);
		if($status<0)
		{
			if($status==-1)
			{
				setcookie(_::$config['block'],'YES-'.$user['_id'],time()+2592000,'/',_::$config['domain'],false,true);
				$db=_::db();
				$p=trim((string)$_SERVER['REMOTE_ADDR']);
				if(substr($p,0,8)!='192.168.')
				{
					if($idp=$db->findone('block_ip',array('ip'=>$p)))
					{
						$db->update('block_ip',array('_id'=>$idp['_id']),array('$set'=>array('du'=>new mongodate()),'$push'=>array('us'=>array('u'=>$user['_id'],'t'=>new mongodate()))));
					}
					else
					{
						$db->insert('block_ip',array('du'=>new mongodate(),'ip'=>$p,'us'=>array(array('u'=>$user['_id'],'t'=>new mongodate()))));
					}
				}
				_::move('http://boxza.com/?error=-1');
			}
		}
		elseif($status<=1)
		{
			_::user()->reset($user['_id']);
			$data=array('_id'=>$user['_id'],'name'=>$user['if']['fn'].' '.$user['if']['ln'],'img'=>'http://s1.boxza.com/profile/'.$user['if']['fd'].'/s.'.($user['pf']['av']?$user['pf']['av']:'jpg'));
			if(isset($user['hidden'])&&$user['hidden'])
			{
				$data['hidden']=1;
			}
			$data['algorithm'] = 'HMAC-SHA256';
			$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
			$s = strtr(base64_encode(hash_hmac('sha256', $d, self::$key.$data['_id'], true)), '+/', '-_');
			setcookie(self::$name,$s.'.'.$d,time()+($user['aways']?2592000:86400),'/',_::$config['domain'],false,true);
			if($redirect)
			{
				_::move(URI);
			}
			return $s.'.'.$d;
		}
		return '';
	}
}
?>
