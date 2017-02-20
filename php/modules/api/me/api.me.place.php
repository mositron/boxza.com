<?php
if(_::$my)
{
	$u=array();
	$q=strtolower(trim(trim($_GET['q'])));
	if(!empty($q))
	{
		$qa = array_values(array_unique(array_filter(explode(' ',$q))));
		$s = array(array('ty'=>array('$in'=>array(-1,2))));
		for($i=0;$i<count($qa);$i++)
		{
			$s[] = array('$or'=>array(
																		array('n'=> new MongoRegex('/'.$qa[$i].'/i')),
																		array('q'=> new MongoRegex('/'.$qa[$i].'/i'))
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
		
		if($result=_::db()->find('place',$s,array('_id'=>1,'n'=>1,'fd'=>1,'lk'=>1,'sl'=>1),array('limit'=>10)))
		{
			foreach($result as $user)
			{
				$u[]=array(
									'_id'=>$user['_id'],
									'name'=>$user['n'],
									'img'=>'http://s3.boxza.com/place/'.$user['if']['fd'].'/s.jpg',
									'link'=>'http://'.$user['sl'].'.boxza.com/'
							);
			}
		}
	}
	_::$content[] = array('method'=>'place','data'=>$u);
}
?>