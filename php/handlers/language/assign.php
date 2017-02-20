<?php
class language_assign
{
	function assign($key,$value,$site,$code,$type='')
	{
		$db=_::db();
		if(!preg_match("/[a-z0-9_\-]/iU",$key,$path))return 'Key ไม่ถูกต้อง';
		if($code)
		{
			if($codeid=$db->GetOne('select id from language where code=?',array($code)))
			{
				if($langdata=$db->GetRow('select * from language_data where language_data.key=? and lang=? and site in (?,?)',array($key,$codeid,0,$site)))
				{
					if(!$langdata['data'])
					{
						$db->Execute('update language_data set data=?,type=? where id=?',array($value,$type,$langdata['id']));
					}
					else
					{
						$db->Execute('update language_data set type=? where id=?',array($type,$langdata['id']));
					}
				}
				else
				{
					$db->Execute('insert language_data set language_data.key=?,data=?,lang=?,type=?,site=?',array($key,$value,$codeid,$type,$site));
				}
				$clear=true;
			}
		}
		else
		{
			$lang=$db->GetAll('select id,code from language');
			for($i=0;$i<count($lang);$i++)
			{
				if($langdata=$db->GetRow('select * from language_data as d where d.key=? and d.lang=? and d.site in (?,?)',array($key,$lang[$i]['id'],0,$site)))
				{
					 if(!$langdata['data'])
					 {
						 $db->Execute('update language_data set data=?,type=? where id=?',array($value,$type,$langdata['id']));
					 }
					 else
					 {
						 $db->Execute('update language_data set type=? where id=?',array($type,$langdata['id']));
					 }
				}
				else
				{
					$db->Execute('insert language_data set language_data.key=?,data=?,lang=?,type=?,site=?',array($key,$value,$type,$lang[$i]['id'],$site));
				}
				$clear=true;
			}
		}
		if($clear)
		{
			_::cache()->clean('social','system_lang');
		}
	}
}
?>