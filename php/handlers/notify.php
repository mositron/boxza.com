<?php


class notify
{
	public static $get;
	public function __construct()
	{
	
	}
	public function insert($profile,$type,$relate=0,$title='',$detail='',$link='')
	{
		if(is_array($profile))
		{
			foreach($profile as $uid)$this->insert($uid,$type,$relate,$title,$detail,$link);
		}
		else
		{
			$user = _::user();
			if($uid=$user->get($profile,true))
			{
				$ins = array('ty'=>$type,'u'=>_::$my['_id'],'p'=>intval($profile));
				
				if($relate)$ins['rl']=$relate;
				if($title)$ins['tt']=$title;
				if($detail)$ins['ms']=mb_substr($detail,0,100,'utf-8');
				if($link)$ins['l']=mb_substr($link,0,30,'utf-8');
				
				if($id=_::db()->insert('notify',$ins))
				{
					if(!is_array($uid['nf']))
					{
						$uid['nf']=array();
					}
					$uid['nf']['ds']=new MongoDate();
					$type=($type=='friend'?'fr':'ot');
					$uid['nf'][$type]=(intval($uid['nf'][$type])+1);
					$user->update($profile,array('$set'=>array('nf'=>$uid['nf'])));
					return $id;
				}
			}
		}
	}
}
?>