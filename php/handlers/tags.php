<?php

class tags 
{
	public function __construct() 
	{
        
	}
	
	public function update($tag, $ct_type, $ct_id,$ct_title,$ct_detail,$ct_url,$ct_img,$ct_cate,$ct_time)
	{
		$db=_::db();
		$tag_id=array();
		$found=$this->remove($ct_type, $ct_id, false);	
		if(is_array($tag))
		{
			$tag=implode(',',$tag);
		}
		if($tags=$this->check(strval($tag)))
		{
			for($i=0;$i<count($tags);$i++)
			{
				if($tagc=mb_strtolower(trim(strval($tags[$i])),'utf-8'))
				{	
					$tag_id[]=$tagc;
					$db->update('tags',array('_id'=>$tagc),array('$inc'=>array('amount'=>1),'$set'=>array('du'=>new MongoDate())),array('upsert'=>true));
				}
			}
		}
		$db->update($ct_type,array('_id'=>$ct_id),array('$set'=>array('tags'=>$tag_id)));
		if(count($tag_id)>0)
		{
			$db->update('tags_link',array('ty'=>$ct_type,'ct'=>$ct_id),array('$set'=>array(
																																						'tags'=>$tag_id,
																																						't'=>trim($ct_title),
																																						'd'=>mb_substr(trim(strip_tags($ct_detail)),0,200,'utf-8'),
																																						'l'=>$ct_url,
																																						'i'=>$ct_img,
																																						'c'=>$ct_cate,
																																						'da'=>$ct_time,
																																					)),array('upsert'=>true));
		}
		elseif($found)
		{
			$db->remove('tags_link',array('ty'=>$ct_type,'ct'=>$ct_id));
		}
	}
	
	public function remove($ct_type, $ct_id, $delete=true)
	{	
		$db=_::db();
		$tag_id=array();
		$found=false;
		if($ct=$db->findone('tags_link',array('ty'=>$ct_type,'ct'=>$ct_id)))
		{
			$found=true;
			if($ct['tags'])
			{
				for($i=0;$i<count($ct['tags']);$i++)
				{
					$db->update('tags',array('_id'=>$ct['tags'][$i]),array('$inc'=>array('amount'=>-1)));
				}
			}
			
			if($delete)
			{
				$db->remove('tags_link',array('ty'=>$ct_type,'ct'=>$ct_id));
			}
		}
		return $found;
	}
	
	public function check($tags)
	{
		$tag =	array_values(array_filter(array_map(array($this,'splitword'),array_filter(array_unique(array_map('trim',explode(',',mb_strtolower($tags,'utf-8'))))))));
		return empty($tag)?array():$tag;	
	}
	
	
	public function splitword($tmp)
	{
		return preg_match("/^[a-zA-Z0-9\'ก-๙เแ\. ]+$/i",$tmp)?$tmp:false;
	}
	
}
?>