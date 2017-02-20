<?php
if(_::$my)
{
	$u=array();
	$q=strtolower(trim(trim($_GET['q'])));
	if(!empty($q))
	{
		if($result=_::db()->find('tags',array('_id'=>new MongoRegex('/'.$q.'/i')),array('_id'=>1,'amount'=>1),array('sort'=>array('amount'=>-1),'limit'=>10)))
		{
			foreach($result as $user)
			{
				$u[]=array(
									'_id'=>$user['_id'],
									'n'=>str_replace($q,'<strong>'.$q.'</strong>',$user['_id']),
									'amount'=>$user['amount'],
							);
			}
		}
	}
	_::$content[] = array('method'=>'tag','data'=>$u);
}
?>