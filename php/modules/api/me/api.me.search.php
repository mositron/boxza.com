<?php
if(_::$my)
{
	$q=strtolower(trim($_GET['q']));
	$friend=intval(trim($_GET['friend']));
	if(!empty($q))
	{
		$cache=_::cache();
		$md5=md5($q);
		#if(!$result=$cache->get('ca1','search-'.$md5))
		#{
			$qa = explode(' ',$q);
			$qa = array_values(array_unique(array_filter($qa)));
			$s = array();
			for($i=0;$i<count($qa);$i++)
			{
				$s[] = array('$or'=>array(
																			array('if.fn'=> new MongoRegex('/'.$qa[$i].'/i')),
																			array('if.ln'=> new MongoRegex('/'.$qa[$i].'/i'))
																		)
										);
			}
			if(count($s)==1)
			{
				$s=$s[0];
			}
			elseif(count($s)>1)
			{
				$a=array('$and'=>$s);
				$s=$a;
			}
			$s['st']=array('$gte'=>0);
			if($friend)
			{
				$s['_id']=array('$in'=>(array)_::$my['ct']['fr']);
				if($friend==2)
				{
					$s['if.lk']=array('$type'=>2);
				}
				elseif($friend==3)
				{
					$s['_id']=array('$in'=>array_merge((array)_::$my['ct']['fr'],(array)_::$my['ct']['fl']));
				}
			}
			$result=_::db()->find('user',$s,array('if'=>1),array('limit'=>10));
		#	$cache->set('ca1','search-'.$md5,$result,false,600);
		#}
		$u=array();
		if(is_array($result))
		{
			foreach($result as $user)
			{
				$l=array('_id'=>$user['_id'],'name'=>$user['if']['fn'].' '.$user['if']['ln'],'img'=>'http://s1.boxza.com/profile/'.$user['if']['fd'].'/s.jpg','link'=>$user['if']['lk']);
				if(in_array($user['_id'],(array)_::$my['ct']['fr']))
				{
					array_unshift($u,$l);
				}
				else
				{
					array_push($u,$l);
				}
			}
		}
		_::$content[] = array('method'=>'search','data'=>$u);
	}
}
?>