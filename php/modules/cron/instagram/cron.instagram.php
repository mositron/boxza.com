<?php


//https://api.instagram.com/v1/users/6453456/media/recent/?access_token=22051122.e6bf310.2cb342c345a5462d836897004a037b7a


$db=_::db();

if($instagram=$db->find('people',array('in_id'=>array('$exists'=>true,'$ne'=>''),'pl'=>1),array('_id'=>1,'in_id'=>1,'di'=>1),array('sort'=>array('di'=>1),'limit'=>1)))
{
	$star=$instagram[0];
	$tmp=_::http()->get('https://api.instagram.com/v1/users/'.$star['in_id'].'/media/recent/?access_token=22051122.e6bf310.2cb342c345a5462d836897004a037b7a');
	
	$db->update('people',array('_id'=>$star['_id']),array('$set'=>array('di'=>new mongodate())));
	
	$data=json_decode($tmp,true);
	//print_r($data);
	
	if($photo=$data['data'])
	{
		for($i=count($photo)-1;$i>=0;$i--)
		{	
			$v=$photo[$i];
			$arg=array(
									'iid'=>$v['id'],
									't'=>strval($v['caption']['text']),
									'tag'=>$v['tags'],
									'ty'=>$v['type'],
									'loc'=>$v['location'],
									'ds'=>new mongodate($v['created_time']),
									'link'=>$v['link'],
									'likes'=>$v['likes'],
									'comments'=>$v['comments'],
									'images'=>$v['images'],
			);
			if($v['type']=='image'&&$v['user']['id']==$star['in_id'])
			{
				if($pid=$db->findone('instagram',array('iid'=>$v['id'])))
				{
					$db->update('instagram',array('_id'=>$pid['_id'],array('$set'=>$arg)));
				}
				else
				{
					$db->insert('instagram',$arg);
				}
			}
			else
			{
				print_r($v);	
			}
		}
	}
}
?>