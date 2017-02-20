<?php


class file
{
	public function __construct()
	{
		
	}
	public function upload($file,$service,$name=false,$rel_id=false,$rel_type=false,$type=false)
	{
		$ext=trim(strtolower(preg_replace('/^.*\./', '', $name)));
		$db=_::db();
		if(!$type)$type='file';
		
	
		$arg = array('site'=>_::$site['_id'],'serv'=>$service,'uid'=>_::$my['_id'],'ext'=>$ext,'type'=>$type);
		if($name) $arg['name'] = trim(strval($name));
		if($rel_id) $arg['rid'] = intval($rel_id);
		if($rel_type) $arg['rtype'] = trim(strval($rel_type));
		if($id = $db->insert('file',$arg))
		{
			$s = $id.'.'.$ext;
			_::folder()->mkdir($type);
			if(@copy($file,SITE_FILES.$type.'/'.$s))
			{
				$db->update('file',array('_id'=>$id,'site'=>_::$site['_id']),array('$set'=>array('file'=>$s,'size'=>@filesize($file))));
				return array('_id'=>$id,'rid'=>$arg['rid'],'rtype'=>$arg['rtype'],'file'=>$s,'type'=>$type);
			}
			else
			{
				$db->remove('file',array('_id'=>$id,'site'=>_::$site['_id']));
			}
		}
		return false;
	}
	public function delete($id)
	{
		$db=_::db();
		if($photo=$db->findOne('file',array('site'=>_::$site['_id'],'_id'=>intval($id))))
		{
			$db->remove('file', array('site'=>_::$site['_id'],'_id'=>intval($id)));
			if($photo['file']&&file_exists($path=SITE_FILES.$photo['type'].'/'.$photo['file']))@unlink($path);
			return true;
		}
		return false;
	}
	public function clear($relate,$type)
	{
		$photo=_::db()->find('file',array('site'=>_::$site['_id'],'rid'=>intval($relate),'type'=>$type),array('_id'=>1));
		for($i=0;$i<count($photo);$i++)
		{
			$this->delete($photo[$i]['_id']);
		}
		return true;
	}

}
?>