<?php
if(_::$my)
{
	$u=array();
	$q=strtolower(trim(trim($_GET['q'])));
	if(!empty($q))
	{
		$qa = array_values(array_unique(array_filter(explode(' ',$q))));
		$s = array();
		for($i=0;$i<count($qa);$i++)
		{
			$s[] = array('$or'=>array(
																		array('n'=> new MongoRegex('/'.$qa[$i].'/i')),
																		array('fn'=> new MongoRegex('/'.$qa[$i].'/i')),
																		array('ln'=> new MongoRegex('/'.$qa[$i].'/i')),
																		array('nn'=> new MongoRegex('/'.$qa[$i].'/i'))
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
		
		$s['dd']=array('$exists'=>false);
			
		if($result=_::db()->find('people',$s,array('_id'=>1,'n'=>1,'fn'=>1,'ln'=>1,'nn'=>1,'fd'=>1,'lk'=>1),array('limit'=>10)))
		{
			foreach($result as $user)
			{
				$u[]=array(
									'_id'=>$user['_id'],
									'name'=>($user['n']?$user['n']:trim($user['nn'].' '.$user['fn'].' '.$user['ln'])),
									'img'=>'http://s3.boxza.com/people/'.$user['if']['fd'].'/s.jpg',
									'link'=>'http://people.boxza.com/'.($user['lk']?$user['lk']:$user['_id'])
							);
			}
		}
	}
	_::$content[] = array('method'=>'people','data'=>$u);
}
?>