<?php

if(_::$my['_id'])
{
	if(is_numeric(_::$path[2]))
	{
		if($share=_::db()->findOne('line',array('_id'=>intval(_::$path[2]),'dd'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'tt'=>1,'ty'=>1,'sh'=>1,'ms'=>1,'at'=>1,'pt'=>1,'ms'=>1,'da'=>1,'ds'=>1)))
		{
			$share=_::profile()->expand(_::user(),$share,false,_::db());
			_::$content[] = array('method'=>'sh','data'=>$share);
		}
	}
}
else
{
	_::$content[] = array('method'=>'login');
}

?>