<?php

class user
{
	public $list=array();
	public $profile=array();
	public $fields=array('_id'=>1,'if'=>1,'em'=>1,'cd'=>1,'st'=>1,'sc'=>1,'nf'=>1,'pf'=>1,'op'=>1,'ct'=>1,'du'=>1,'ip'=>1,'am'=>1,'pet'=>1,'lionica'=>1,'ht'=>1,'fr'=>1,'sg'=>1,'da'=>1,'dm'=>1);
	
  	public function __construct()
	{
		$this->list=array();
	}
	public function get($uid,$full)
	{
		$uid=intval($uid);
		if(!isset($this->list[$uid]))
		{
			if(is_array($full)&&isset($full['nf']))
			{
				if($full['st']==-1)
				{
					return false;
				}
				$this->list[$uid]=$full;
				if(!$this->list[$uid]['name']=$full['if']['dp'])
				{
					$this->list[$uid]['name']=$full['if']['fn'].' '.$full['if']['ln'];
				}
				$this->list[$uid]['cname']=($full['if']['ch']['na']?$full['if']['ch']['na']:$this->list[$uid]['name']);
				$this->list[$uid]['himg']='//s1.boxza.com/profile/'.$full['if']['fd'].'/s.'.($full['pf']['av']?$full['pf']['av']:'jpg');
				$this->list[$uid]['nimg']='http://s1.boxza.com/profile/'.$full['if']['fd'].'/n.'.($full['pf']['av']?$full['pf']['av']:'jpg');
				$this->list[$uid]['img']='http:'.$this->list[$uid]['himg'];
				//$this->list[$uid]['hat']=strval($this->list[$uid]['ht']);
				$this->list[$uid]['link']=($full['if']['lk']?$full['if']['lk']:$full['_id']);
				$this->list[$uid]['class']=$this->getclass($full['am']);
				$this->list[$uid]['pet']=($full['pet']?$full['pet']:array('price'=>10,'own'=>0,'col'=>array()));
				if($this->list[$uid]['google']=($full['sc']&&$full['sc']['gg'])?$full['sc']['gg']:false)
				{
					unset($this->list[$uid]['google']['token']);
				}
				$full=false;
			}
			elseif($uid==0)
			{
				$this->list[$uid]['_id']=0;
				$this->list[$uid]['cname']=$this->list[$uid]['name']='ระบบ';
				$this->list[$uid]['himg']='//s1.boxza.com/profile/00/00/00/s.jpg';
				$this->list[$uid]['img']='http:'.$this->list[$uid]['himg'];
				$this->list[$uid]['link']='';
			}
			else
			{
				$cache=_::cache();
				if(!$this->list[$uid]=$cache->get('ca2','user-'.$uid))
				{
					if($this->list[$uid]=_::db()->findOne('user',array('_id'=>$uid),$this->fields))
					{
						if(!$this->list[$uid]['name']=$this->list[$uid]['if']['dp'])
						{
							$this->list[$uid]['name']=$this->list[$uid]['if']['fn'].' '.$this->list[$uid]['if']['ln'];
						}
						$this->list[$uid]['cname']=($this->list[$uid]['if']['ch']['na']?$this->list[$uid]['if']['ch']['na']:$this->list[$uid]['name']);
						$this->list[$uid]['himg']='//s1.boxza.com/profile/'.$this->list[$uid]['if']['fd'].'/s.'.($this->list[$uid]['pf']['av']?$this->list[$uid]['pf']['av']:'jpg');
						$this->list[$uid]['nimg']='http://s1.boxza.com/profile/'.$this->list[$uid]['if']['fd'].'/n.'.($this->list[$uid]['pf']['av']?$this->list[$uid]['pf']['av']:'jpg');
						$this->list[$uid]['img']='http:'.$this->list[$uid]['himg'];
						//$this->list[$uid]['hat']=strval($this->list[$uid]['ht']);
						$this->list[$uid]['link']=($this->list[$uid]['if']['lk']?$this->list[$uid]['if']['lk']:$this->list[$uid]['_id']);
						//$this->list[$uid]['sg']=_::bbcode()->get($this->list[$uid]['sg']);
						$this->list[$uid]['class']=$this->getclass($this->list[$uid]['am']);
						//$this->list[$uid]['accept']=$this->list[$uid]['if']['ac'];
						$this->list[$uid]['pet']=($this->list[$uid]['pet']?$this->list[$uid]['pet']:array('price'=>10,'own'=>0,'col'=>array()));
						if($this->list[$uid]['google']=($this->list[$uid]['sc']&&$this->list[$uid]['sc']['gg'])?$this->list[$uid]['sc']['gg']:false)
						{
							unset($this->list[$uid]['google']['token']);
						}
						
						
						$cache->set('ca2','user-'.$uid,$this->list[$uid],false,3600*24*30);
					}
					else
					{
						return false;
					}
				}
				
				if($this->list[$uid]['st']==-1)
				{
					return false;
				}
			}
		}
		elseif($this->list[$uid]['st']==-1)
		{
			return false;
		}
		return $this->list[$uid];
	}
	
	public function reset($uid)
	{
		_::cache()->delete('ca2','user-'.$uid,0);
		_::cache()->delete('ca2','prof-'.$uid,0);
	}
	public function update($uid,$update)
	{
		_::db()->update('user',array('_id'=>intval($uid)),$update);
		_::cache()->delete('ca2','user-'.$uid,0);
		_::cache()->delete('ca2','prof-'.$uid,0);
		unset($this->list[$uid]);
		unset($this->profile[$uid]);
	}
	public function profile($uid,$allow=false)
	{
		$uid=intval($uid);
		if(!isset($this->profile[$uid]))
		{
			if(!$uid)
			{
				$this->profile[$uid]['_id']=0;
				$this->profile[$uid]['cname']=$this->profile[$uid]['name']='ระบบ';
				$this->profile[$uid]['himg']='//s1.boxza.com/profile/00/00/00/s.jpg';
				$this->profile[$uid]['img']='http:'.$this->profile[$uid]['himg'];
				$this->profile[$uid]['link']='';
				$this->profile[$uid]['st']=1;
				$this->profile[$uid]['class']='moderator';
			}
			elseif($this->list[$uid])
			{
				$this->profile[$uid]=array(
																			'_id'=>$this->list[$uid]['_id'],
																			'name'=>$this->list[$uid]['name'],
																			'cname'=>$this->list[$uid]['cname'],
																			'himg'=>$this->list[$uid]['himg'],
																			'nimg'=>$this->list[$uid]['nimg'],
																			'img'=>$this->list[$uid]['img'],
																			'link'=>$this->list[$uid]['link'],
																			'st'=>intval($this->list[$uid]['st']),
																			'fr'=>$this->list[$uid]['fr'],
																			'da'=>$this->list[$uid]['da'],
																			'sg'=>$this->list[$uid]['sg'],
																			//'pet'=>$this->list[$uid]['pet'],
																			'lionica'=>$this->list[$uid]['lionica'],
																			'cd'=>$this->list[$uid]['cd'],
																			'class'=>$this->list[$uid]['class'],
																			'google'=>$this->list[$uid]['google'],
																			'pet'=>($this->list[$uid]['pet']?$this->list[$uid]['pet']:array('price'=>10,'own'=>0,'col'=>array()))
																);
			}
			else
			{
				$cache=_::cache();
				if(!$this->profile[$uid]=$cache->get('ca2','prof-'.$uid))
				{
					if($tmp=_::db()->findOne('user',array('_id'=>$uid),array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1,'da'=>1,'sg'=>1,'pet'=>1,'lionica'=>1,'cd'=>1,'am'=>1,'sc'=>1)))
					{
						$this->profile[$uid]=array(
																						'_id'=>$tmp['_id'],
																						'name'=>($tmp['if']['dp']?$tmp['if']['dp']:$tmp['if']['fn'].' '.$tmp['if']['ln']),
																						'cname'=>($tmp['if']['ch']['na']?$tmp['if']['ch']['na']:$tmp['if']['fn'].' '.$tmp['if']['ln']),
																						'himg'=>'//s1.boxza.com/profile/'.$tmp['if']['fd'].'/s.'.($tmp['pf']['av']?$tmp['pf']['av']:'jpg'),
																						'nimg'=>'http://s1.boxza.com/profile/'.$tmp['if']['fd'].'/n.'.($tmp['pf']['av']?$tmp['pf']['av']:'jpg'),
																						'img'=>'http://s1.boxza.com/profile/'.$tmp['if']['fd'].'/s.'.($tmp['pf']['av']?$tmp['pf']['av']:'jpg'),
																						'link'=>($tmp['if']['lk']?$tmp['if']['lk']:$tmp['_id']),
																						'st'=>intval($tmp['st']),
																						//'pet'=>$tmp['pet'],
																						'lionica'=>$tmp['lionica'],
																						'fr'=>$tmp['fr'],
																						'da'=>$tmp['da'],
																						'cd'=>$tmp['cd'],
																						'sg'=>$tmp['sg'], //_::bbcode()->get($tmp['sg']),
																						'class'=>$this->getclass($tmp['am']),
																						'google'=>($tmp['sc']&&$tmp['sc']['gg'])?$tmp['sc']['gg']:false,
																						'pet'=>($tmp['pet']?$tmp['pet']:array('price'=>10,'own'=>0,'col'=>array()))
																						//'accept'=>$tmp['if']['ac']
																		);
						if($this->profile[$uid]['google'])
						{
							unset($this->profile[$uid]['google']['token']);
						}
						$cache->set('ca2','prof-'.$uid,$this->profile[$uid],false,3600*24*30);
						unset($tmp);
					}
					else
					{
						$this->profile[$uid]['st']=-9;
					}
				}
			}
		}
		if($this->profile[$uid]['st']>=0 || $allow)
		{
			return $this->profile[$uid];
		}
		else
		{
			return false;
		}
	}
	public function getclass($c)
	{
		if($c>=9)
		{
			return 'administrator';
		}
		elseif($c>=1)
		{
			return 'moderator';
		}
		else
		{
			return 'member';
		}
	}
}
?>