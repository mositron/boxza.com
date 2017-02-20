<?php

list($type,$id)=explode('-',_::$path[2]);
$id=intval($id);

$db = _::db();

switch($type)
{
	case 'photo':
		if($photo=$db->findOne('line',array('_id'=>$id,'ty'=>array('$in'=>array('photo','cover','gif','draw')),'dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'pt'=>1,'ms'=>1,'sh'=>1,'lk'=>1,'ds'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-30))))
		{
			$user=_::user();
			if($photo['pt']['a'])
			{
				$photo['pt']['a']=$db->findOne('line',array('_id'=>$photo['pt']['a'],'ty'=>'album'),array('_id'=>1,'tt'=>1));
				if($photo['pt']['prev']=$db->find('line',array('_id'=>array('$lt'=>$photo['_id']),'u'=>$photo['u'],'ty'=>'photo','dd'=>array('$exists'=>false)),array('_id'=>1),array('sort'=>array('_id'=>-1),'limit'=>1)))
				{
					$photo['pt']['prev']=$photo['pt']['prev'][0]['_id'];
				}
				if($photo['pt']['next']=$db->find('line',array('_id'=>array('$gt'=>$photo['_id']),'u'=>$photo['u'],'ty'=>'photo','dd'=>array('$exists'=>false)),array('_id'=>1),array('sort'=>array('_id'=>1),'limit'=>1)))
				{
					$photo['pt']['next']=$photo['pt']['next'][0]['_id'];
				}
			}
			$photo['ds']=$photo['ds']->sec;
			$photo['u']=$user->profile($photo['u']);
			if($photo['cm'])
			{
				for($j=0;$j<count($photo['cm']['d']);$j++)
				{
					$photo['cm']['d'][$j]['u'] = $user->profile($photo['cm']['d'][$j]['u']);
					$photo['cm']['d'][$j]['t'] = $photo['cm']['d'][$j]['t']->sec;
					$photo['cm']['d'][$j]['lc'] = count($photo['cm']['d'][$j]['l']);
					$photo['cm']['d'][$j]['lm'] = (in_array(_::$my['_id'],(array)$photo['cm']['d'][$j]['l']));
				}
				unset($photo['last']);
			}
			if(!$photo['ms'])$photo['ms']='';
			_::$content[] = array('method'=>'pt','type'=>'photo','data'=>$photo);
		}
		break;
	case 'user':
		break;
	case 'album':
		break;
}

?>